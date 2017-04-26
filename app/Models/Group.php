<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
   	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * Relationship: menuitems
     *
     * @return
     */
    public function menuItems()
    {
    	return $this->hasMany('App\Models\MenuItemGroup', 'group_id');
    }
}
