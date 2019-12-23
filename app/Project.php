<?php

namespace App;

use App\Traits\ShareString;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use ShareString;
    /**
     * Get all of the tasks for the project.
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    /**
     * Get the team for the project.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    /**
     * Get all of the developers for the project.
     */
    public function developers()
    {
        return $this->belongsToMany('App\Developer');
    }
}
