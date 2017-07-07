<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'country',
        'dob',
        'contact_no',
        'skype_address',
        'company_email',
        'client_residence_address',
        'client_company_name',
        'website',
        'industry',
        'client_company_address',
        'other_details',
        'fb_id',
        'linkedin_id',
        'twitter_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dob',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
