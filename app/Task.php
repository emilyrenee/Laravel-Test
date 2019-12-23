<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    
    /**
     * Get the developer for the task.
     */
    public function developer()
    {
        return $this->belongsTo('App\Developer');
    }

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
