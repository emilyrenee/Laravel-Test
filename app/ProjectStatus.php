<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $guarded = ['id'];

    /**
     * Get all of the projects that belong to the Project Status.
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }
}
