<?php

namespace App;

use Image;
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

            Log::info($filename);

            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            //small thumbnail name
            $smallthumbnail = $filename . '_small_' . time() . '.' . $extension;

            //medium thumbnail name
            $mediumthumbnail = $filename . '_medium_' . time() . '.' . $extension;

            //large thumbnail name
            $largethumbnail = $filename . '_large_' . time() . '.' . $extension;

            // Upload Images
            $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
            $request->file('avatar')->storeAs('public/avatars/thumbnail', $smallthumbnail);
            $request->file('avatar')->storeAs('public/avatars/thumbnail', $mediumthumbnail);
            $request->file('avatar')->storeAs('public/avatars/thumbnail', $largethumbnail);

            //create small thumbnail
            $smallthumbnailpath = public_path('storage/avatars/thumbnail/' . $smallthumbnail);
            $this->createThumbnail($smallthumbnailpath, 150, 93);

            //create medium thumbnail
            $mediumthumbnailpath = public_path('storage/avatars/thumbnail/' . $mediumthumbnail);
            $this->createThumbnail($mediumthumbnailpath, 300, 185);

            //create large thumbnail
            $largethumbnailpath = public_path('storage/avatars/thumbnail/' . $largethumbnail);
            $this->createThumbnail($largethumbnailpath, 550, 340);
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
        $user = Auth::user();
        $developer = new Developer();
        if ($user->can('assignTeam', $developer)) {
            $this->developer->assignTeam(
                [
                    'id' => $attributes['id'],
                    'team_id' => $attributes['team_id']
                ]
            );
        }
    }

    /**
     * Create a thumbnail of specified size
     *
     * @param string $path path of thumbnail
     * @param int $width
     * @param int $height
     */
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}
