<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Landlord;
use JavaScript;
use LaravelLocalization;
use App\Models\Companies;
use Modules\Module\Entities\Menu;
use Modules\Widget\Entities\Widget;
use Modules\Module\Entities\MenuItem;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && count(Landlord::getTenants()) > 0) {
                $userCompanyRoles = [];
                $companies = Auth::user()->companies()->where('settings->is_invitation_accepted', 1)->get();
                foreach($companies as $company) {
                    $userCompanyRoles[$company->id] = Auth::user()->roles->filter(function ($value, $key) use($company) {
                        if (explode('.', $value->name)[0] == $company->id) {
                            return $value;
                        }
                    })->values();
                }
                if (Landlord::getTenants()['company']->slug != 'www') {
                    $widgetsAccessArray = [];
                    $menuItemIdArray = [];
                    $role = null;

                    $currentRole = session('currentrole');
                    if($currentRole==''){
                        $userRoles = Auth::user()->roles()->first();
                        session('currentrole', $userRoles['id']);
                        $currentRole = $userRoles['id'];
                    }
                    $role = Auth::user()->roles()->where('id', $currentRole)->first();

                    if (!$role) {
                        return response()->json(['error' => 'not found'], 404);
                    }

                    $permissions = $role->permissions;

                    $userPermissions = Auth::user()->permissions;
                    $allPermissions = $userPermissions->merge($permissions);

                    $menuItemIds = $allPermissions->map(function ($item, $key) {
                        if (strpos($item->name, '.'.config('config-variables.menu_item_permission_identifier').'.') !== false) {
                            return explode('.', $item->name)[2];
                        }
                    })->unique()->toArray();
                    $menuItemIdArray = array_merge($menuItemIdArray, $menuItemIds);

                    $widgetsAccess = $allPermissions->map(function ($item, $key) {
                        if (strpos($item->name, '.'.config('config-variables.widget_permission_identifier').'.') !== false) {
                            return explode('.', $item->name)[2];
                        }
                    })->values()->toArray();
                    $widgetsAccessArray = array_merge($widgetsAccessArray, $widgetsAccess);

                    // code refactoring remaining here
                    $menuItemArray = MenuItem::whereIn('id', $menuItemIdArray)->get()->toArray();
                    $menuItemArray = Menu::buildMenuTree($menuItemArray, 0);

                    $widgetArray = Widget::whereIn('id', $widgetsAccessArray)->pluck('slug')->toArray();
                    $request->session()->put('widgetAccess', $widgetArray);

                    $currentCompany = Landlord::getTenants()['company'];

                    View::share('menu_items', $menuItemArray);
                    View::share('currentCompany', $currentCompany);
                }
                JavaScript::put([
                    'locale'     => LaravelLocalization::getCurrentLocale(),
                    'urlInitial' => '/' . LaravelLocalization::getCurrentLocale() . '/' . session('currentrole'),
                ]);
                View::share('userCompanyRoles', $userCompanyRoles);
                View::share('companies', $companies);
            }

            return $next($request);
        });
    }
}
