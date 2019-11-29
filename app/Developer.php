<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function create($request, array $attributes = [])
    {
        // Handle File Upload
        if ($request->hasFile('avatar')) {
            // Get filename with extension            
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $developer = new Developer();
        $developer->name = $attributes['name'];
        $developer->email = $attributes['email'];
        $developer->avatar = $fileNameToStore;
        $developer->save();
        return $developer;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $developer = Developer::find($attributes['id']);
        $developer->name = $attributes['name'];
        $developer->email = $attributes['email'];
        $developer->save();
        return $developer;
    }

    public function assignTeam(array $attributes = [], array $options = [])
    {
        $this->developer->assignTeam(
            [
                'id' => $attributes['id'],
                'team_id' => $attributes['team_id']
            ]
        );
    }
}
