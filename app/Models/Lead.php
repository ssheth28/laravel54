<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leads';

    /**
     * country relationship
     *
     * @var string
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
