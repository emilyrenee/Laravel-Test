<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Team;

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

    public function create(Request $request)
    {
        $developer = new Developer();
        $developer->name = $request->input('name');
        $developer->email = $request->input('email');
        $developer->save();
    }

    public function update(Request $request)
    {
        $developer = Developer::find($request->input('id'));
        $developer->name = $request->input('name');
        $developer->email = $request->input('email');
        $developer->save();
        var_dump($developer);
    }
}
