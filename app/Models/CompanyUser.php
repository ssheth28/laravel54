<?php

namespace App\Models;

use App\Models\Basemodel as Model;
use App\Traits\MySQLJSONColumnManager;

class CompanyUser extends Model
{
    use MySQLJSONColumnManager;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_user';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'settings',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
    ];
}
