<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';


    /**
     * Relationship: user.
     *
     * @return
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\Project', 'project_user', 'project_id', 'user_id');
    }

    /**
     * Relationship: technology.
     *
     * @return
     */
    public function technology()
    {
        return $this->belongsTo('App\Models\Technology', 'technology_id');   
    }

    /**
     * Relationship: client.
     *
     * @return
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');      
    }
}
