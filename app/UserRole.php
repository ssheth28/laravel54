<?php 
namespace App;

use Auth;
use Spatie\Permission\Models\Role;

class UserRole
{
    public function setUserRole($role = null)
    {
    	// dd(Auth::user());
    	// $userRoles = Auth::user()->roles->pluck('id')->toArray();

        $allRoles = Role::all()->pluck('id')->toArray();

    	//to check
        if (empty($role) || !is_string($role)) {
            // If the role has not been passed through the function
            // it tries to get it from the first segment of the url
            $role = app()->request->segment(2);
        }

        if(in_array($role, $allRoles)) {

        } else {
        	$role = null;
        }

        return $role;
    }

    public function getRoleURL($company, $role)
    {
        $request = app()->request;
    	$allSegments = $request->segments();
        $redirection = $request->getScheme() . "://" . $company . "." . env('APP_DOMAIN') . "/" . $allSegments[0] . "/" . $role . "/admin/home";
        return $redirection;
    }
}