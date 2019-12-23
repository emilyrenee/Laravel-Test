<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $guarded = ['id'];

    /**
     * Get all of the tasks for the project.
     */
    public function project()
    {
        return $this->belongsToMany('App\Project');
    }
}
