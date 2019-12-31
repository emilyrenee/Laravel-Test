<?php

namespace App;

use App\Traits\ShareString;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use ShareString;

    protected $guarded = ['id'];
    
    /**
     * Get the status for the project.
     */
    public function status()
    {
        return $this->hasOne('App\ProjectStatus', 'id', 'project_status_id');
    }

    /**
     * Get the team for the project.
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

}
