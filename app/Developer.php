<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Developer extends Model
{
    /**
     * Get all of the tasks for the developer.
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    /**
     * Get all of the teams for the developer.
     */
    public function teams()
    {
        return $this->belongsToMany('App\Team', 'developers_teams', 'developer_id', 'team_id');
    }

    public function create(array $attributes = [])
    {
        $developer = new Developer();
        $developer->name = $attributes['name'];
        $developer->email = $attributes['email'];
        $developer->save();
    }

    public function update(array $attributes = [], array $options = [])
    {
        $developer = Developer::find($attributes['id']);
        $developer->name = $attributes['name'];
        $developer->email = $attributes['email'];
        $developer->save();
    }
}
