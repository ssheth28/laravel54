<?php

namespace Modules\Widget\Http\Controllers;

use DB;
use View;
use Auth;
use Landlord;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Module\Entities\Menu;
use Spatie\Permission\Models\Role;
use Modules\Widget\Entities\Widget;
use App\Http\Controllers\Controller;
use Modules\Module\Entities\MenuItem;
use Modules\Widget\Entities\WidgetType;
use Spatie\Permission\Models\Permission;


class WidgetController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->menuId = null;
        $this->title = 'Widget';
        $this->request = $request;
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
        return view('widget::index');
    }

    /**
     * Get widget data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWidgetData()
    {
        $request = $this->request->all();
        $widgets = DB::table('widgets')
                    ->leftjoin('widget_type', 'widget_type.id', 'widgets.id')
                    ->select('widgets.*', DB::raw('DATE_FORMAT(widgets.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'), DB::raw('widget_type.name as widgetName'));

        $sortby = 'widgets.created_datetime';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $widgets->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $widgets->where('widgets.name', 'like', '%'.$request['name'].'%');
        }

        if (isset($request['status']) && trim($request['status']) !== '') {
            $widgets->where('widgets.status', '=', $request['status']);
        }

        $widgetsList = [];

        if (!array_key_exists('pagination', $request)) {
            $widgets = $widgets->paginate($request['pagination_length']);
            $widgetsList = $widgets;
        } else {
            $widgetsList['total'] = $widgets->count();
            $widgetsList['data'] = $widgets->get();
        }

        $response = $widgetsList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->init();
        $WidgetTypes = WidgetType::generate();
        $WidgetTree = Widget::generate();
        $menuItems = MenuItem::where('menu_id', $this->menuId)->get()->toArray();
        $allWidgetControllers = Menu::buildMenuTree($menuItems);

        return view('widget::create', compact('WidgetTypes', 'WidgetTree', 'allWidgetControllers'));
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
        $this->init();

        $request = $this->request;
        $widget = new Widget();
        $widget->icon = $request->widget_icon;
        $widget->name = $request->widget_name;
        // $widget->slug = $request->widget_slug;
        $widget->description = $request->description;
        $widget->width = $request->widget_width;
        $widget->status = $request->status ? 1 : 0;
        $widget->widget_type_id = $request->widget_type;
        $widget->parent_id = $request->widget_parent;
        $widget->menu_item_id = $request->widget_controller;
        $widget->is_publicly_visible = $request->is_publicly_visible;
        $widget->company_id = 1;
        $widget->save();

        $companyId = Landlord::getTenants()['company']->id;
        $permission = new Permission();
        $permission->name = $companyId.'.'.(config('config-variables.widget_permission_identifier')).'.'.$widget->id;
        $permission->save();

        $role = Role::find(session('currentrole'));
        $role->givePermissionTo($permission);

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('widgets.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    // /**
    //  * Show the specified resource.
    //  *
    //  * @return Response
    //  */
    public function show($company, $widgetId)
    {
        $this->init();
        $widget = Widget::find($widgetId);
        $widgetDetailHtml = view('modules.widget.widget_detail_show', ['widget' => $widget])->render();

        return array('widgetDetailHtml' => $widgetDetailHtml);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit($company, $id)
    {
        $this->init();
        $widget = Widget::find($id);
        $WidgetTypes = WidgetType::generate();
        $WidgetTree = Widget::generate();
        $menuItems = MenuItem::where('menu_id', $this->menuId)->get()->toArray();
        $allWidgetControllers = Menu::buildMenuTree($menuItems);

        return view('widget::edit', compact('widget', 'WidgetTypes', 'WidgetTree', 'menuItems', 'allWidgetControllers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request, $company, $id)
    {
        $widget = Widget::findOrFail($id);
        $widget->icon = $request->widget_icon;
        $widget->name = $request->widget_name;
        // $widget->slug = $request->widget_slug;
        $widget->description = $request->description;
        $widget->width = $request->widget_width;
        $widget->status = $request->status ? 1 : 0;
        $widget->widget_type_id = $request->widget_type;
        $widget->parent_id = $request->widget_parent;
        $widget->menu_item_id = $request->widget_controller;
        $widget->is_publicly_visible = $request->is_publicly_visible;
        $widget->company_id = 1;
        $widget->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('widgets.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy($company, $id)
    {
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        if (!Widget::where('id', $id)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        flash()->message($message, $type);

        return redirect()->route('widgets.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    public function delete($company,$id) {
        echo '123';exit;
    }
}
