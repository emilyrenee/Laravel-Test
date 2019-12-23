<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Team extends Model
{
    protected $guarded = ['id'];
    
    /**
     * Get all of the developers that are assigned this team.
     */
    public function developers()
    {
        return $this->belongsToMany('App\Developer', 'developers_teams', 'team_id', 'developer_id');
    }

    /**
     * Get all of the projects that are assigned this team.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
