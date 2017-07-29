<?php

namespace Modules\Module\Services;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Landlord;
use Modules\Module\Entities\Menu;
use Modules\Module\Entities\MenuItem;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MenuItemService
{
	public $menuId;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menuId = null;
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
     * Get menu item data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenuItemData($request)
    {
        $this->init();
        $modules = DB::table('menu_items')
                ->leftjoin('menu_items as parent', 'menu_items.parent_id', 'parent.id')
                ->leftjoin('menu_items as mainparent', 'parent.parent_id', 'mainparent.id')
                ->where('menu_items.type', $request['module_type'])
                ->where('menu_items.menu_id', $this->menuId)
                ->select('menu_items.*', DB::raw('DATE_FORMAT(menu_items.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'),
                    DB::raw('parent.name as parentMenuName'),
                    DB::raw('mainparent.name as mainParentMenuName'));

        $sortby = 'menu_items.id';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $modules->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $modules->where('menu_items.id', $request['name']);
        }

        if (isset($request['parent_module']) && trim($request['parent_module']) !== '') {
            $modules->where('menu_items.parent_id', $request['parent_module']);
        }

        if (isset($request['public_visible']) && trim($request['public_visible']) !== '') {
            $modules->where('menu_items.is_publicly_visible', '=', $request['public_visible']);
        }

        if (isset($request['status']) && trim($request['status']) !== '') {
            $modules->where('menu_items.is_active', '=', $request['status']);
        }     

        $modulesList = [];

        if (!array_key_exists('pagination', $request)) {
            $modules = $modules->paginate($request['pagination_length']);
            $modulesList = $modules;
        } else {
            $modulesList['total'] = $modules->count();
            $modulesList['data'] = $modules->get();
        }

        $response = $modulesList;

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function storeMenuItem($request)
    {
        $this->init();
        $module = new MenuItem();
        $module = $this->setVariables($module, $request);
        $module->save();

        $companyId = Landlord::getTenants()['company']->id;
        $permission = new Permission();
        $permission->name = $companyId.'.'.(config('config-variables.menu_item_permission_identifier')).'.'.$module->id;
        $permission->save();

        $role = Role::find(session('currentrole'));
        $role->givePermissionTo($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateMenuItem($request, $moduleId)
    {
        $this->init();
        $module = MenuItem::findOrFail($moduleId);
        $module = $this->setVariables($module, $request);
        $module->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function deleteMenuItem($moduleId)
    {
        $this->init();
        $message = config('config-variables.flash_messages.dataDeleted');
        $type = 'success';
        $companyId = Landlord::getTenants()['company']->id;

        Permission::where('name', $companyId.'.'.(config('config-variables.menu_item_permission_identifier')).'.'.$moduleId)->delete();

        $childMenuItems = MenuItem::where('parent_id', $moduleId)->get();

        foreach ($childMenuItems as $menuItem) {
            Permission::where('name', $companyId.'.'.(config('config-variables.menu_item_permission_identifier')).'.'.$menuItem->id)->delete();
            $menuItem->delete();
        }

        if (!MenuItem::where('id', $moduleId)->delete()) {
            $message = config('config-variables.flash_messages.dataNotDeleted');
            $type = 'danger';
        }
        
        return ['message' => $message, 'type' => $type];
    }

    /**
     * @param object $module
     * @param object $request
     */
    private function setVariables($module, $request)
    {
        $this->init();
        $module->menu_id = $this->menuId;
        $module->name = $request->name;
        $module->description = $request->description;
        $module->url = $request->url;
        $module->type = $request->type;
        $module->parent_id = $request->parent_id ? $request->parent_id : null;
        $module->order = $request->order;
        $module->icon = $request->icon;
        $module->is_active = $request->is_active ? 1 : 0;
        $module->is_shown_on_menu = $request->is_shown_on_menu ? 1 : 0;
        $module->is_publicly_visible = $request->is_publicly_visible ? 1 : 0;

        return $module;
    }
}