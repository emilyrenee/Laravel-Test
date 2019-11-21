<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Get the developer for the task.
     */
    public function developer()
    {
        return $this->belongsTo('App\Developer');
    }

    // /**
    //  * Get the team for the task.
    //  */
    // public function team()
    // {
    //     return $this->morphOne('App\Team', 'teamable');
    // }

    /**
     * Get the project for the task.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Get the status for the task.
     */
    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }
}
