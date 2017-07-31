<?php

namespace Modules\Module\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Landlord;
use Modules\Module\Entities\Menu;
use Modules\Module\Entities\MenuItem;
use Modules\Module\Services\MenuItemService;
use View;
use Auth;

class ModuleController extends Controller
{
    public $title;
    public $uniqueUrl;
    public $menuId;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, MenuItemService $menuItemService)
    {
        $this->menuId = null;
        $this->title = 'Module';
        $this->request = $request;
        $this->menuItemService = $menuItemService;
        View::share('title', $this->title);
        parent::__construct();
    }

    /**
     * Destory/Unset object variables.
     *
     * @return void
     */
    public function __destruct()
    {
        unset($this->title);
        unset($this->menuId);
        unset($this->menuItemService);
    }

    /**
     * Initialize variables.
     *
     * @return void
     */
    public function init()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $menu = Menu::where('company_id', $companyId)->where('name', 'Sidebar')->first();
        $this->menuId = $menu->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->init();
        $byParentModule = MenuItem::where('menu_id', $this->menuId)->where('type', 'Module')->where('parent_id', null)->get()->pluck('name', 'id');
        $byModuleName = MenuItem::where('menu_id', $this->menuId)->where('type', 'Module')->where('parent_id', '!=' ,null)->get()->pluck('name', 'id');
        return view('module::module.index', compact('byParentModule', 'byModuleName'));
    }

    /**
     * Get module data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getModuleData()
    {
        $responseData = $this->menuItemService->getMenuItemData($this->request->all());
        return $responseData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->init();
        $menuItems = MenuItem::where('menu_id', $this->menuId)->where('type', 'Module')->where('parent_id', null)->get()->toArray();
        $allModules = Menu::buildMenuTree($menuItems);

        return view('module::module.create', compact('allModules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->menuItemService->storeMenuItem($request);
        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('modules.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($company, $moduleId)
    {
        $this->init();
        $module = DB::table('menu_items')
                ->leftjoin('menu_items as parent', 'menu_items.parent_id', 'parent.id')
                ->where('menu_items.id', $moduleId)
                ->select('menu_items.*', DB::raw('DATE_FORMAT(menu_items.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'),
                    DB::raw('parent.name as parentMenuName'))->first();
        $moduleDetailHtml = view('modules.module.module_detail_show', ['module' => $module])->render();

        return array('moduleDetailHtml' => $moduleDetailHtml);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit($company, $moduleId)
    {
        $this->init();
        $module = MenuItem::find($moduleId);
        $menuItems = MenuItem::where('menu_id', $this->menuId)->where('type', 'Module')->where('parent_id', null)->get()->toArray();
        $allModules = Menu::buildMenuTree($menuItems);

        return view('module::module.edit', compact('module', 'allModules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request, $company, $moduleId)
    {
        $this->menuItemService->updateMenuItem($request, $moduleId);
        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('modules.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy($company, $moduleId)
    {
        $response = $this->menuItemService->deleteMenuItem($moduleId);
        flash()->message($response['message'], $response['type']);
        return redirect()->route('modules.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Generete Module URL.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateModuleUrl(Request $request)
    {
        $moduleType = $request->module_type;
        $moduleName = $request->module_name;
        $moduleUrl = str_slug($moduleName, '-');
        $parent = $request->parent_id ? MenuItem::find($request->parent_id) : null;
        if ($parent) {
            $moduleUrl = $parent->url.'/'.$moduleUrl;
        }
        // if (($parent && $parent->is_publicly_visible == 1) && $request->is_publicly_visible == 0) {
        //     $moduleUrl = '/admin/'.$moduleUrl;
        // }
        if (!$parent) {
            $moduleUrl = '/admin/'.$moduleUrl;
        }
        $moduleUrl = $this->generateUniqueUrl($moduleUrl, '');

        return ['moduleUrl' => $this->uniqueUrl];
    }

    /**
     * Get unique module url.
     */
    public function generateUniqueUrl($url, $extra)
    {
        $moduleUrlExp = explode('/', $url);
        $moduleUrlTemp = str_slug($moduleUrlExp[count($moduleUrlExp) - 1].'-'.$extra);
        $moduleUrlExp[count($moduleUrlExp) - 1] = $moduleUrlTemp;
        $uniqueUrl = implode('/', $moduleUrlExp);
        if (MenuItem::where('url', $uniqueUrl)->exists()) {
            $this->generateUniqueUrl($url, $extra + 1);

            return;
        }
        $this->uniqueUrl = $uniqueUrl;
    }
}
