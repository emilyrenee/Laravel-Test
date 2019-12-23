<?php

namespace App;

use App\Traits\ShareString;
use App\Scopes\IsLocalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Developer extends Model
{
    use ShareString;

    protected $guarded = ['id'];
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsLocalScope);
    }

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

    public function create(array $attributes = [], array $options = [])
    {
        $developer = new Developer();

        $developer->name = $attributes['name'];
        $developer->email = $attributes['email'];

        if (array_key_exists('avatar', $attributes)) {
            $developer->avatar = $attributes['avatar'];
        }
        if (array_key_exists('personal_site', $attributes)) {
            $developer->personal_site = $attributes['personal_site'];
        }

        $developer->save();

        return $developer;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $developer = Developer::find($attributes['id']);

        $developer->name = $attributes['name'];
        $developer->email = $attributes['email'];

        if (array_key_exists('avatar', $attributes)) {
            $developer->avatar = $attributes['avatar'];
        }
        if (array_key_exists('personal_site', $attributes)) {
            $developer->personal_site = $attributes['personal_site'];
        }

        $developer->save();

        return $developer;
    }

    public function team(array $attributes = [], array $options = [])
    {
        $user = Auth::user();
        $developer = new Developer();

        if ($user->can('assignTeam', $developer)) {
            $this->developer->team(
                [
                    'id' => $attributes['id'],
                    'team_id' => $attributes['team_id']
                ]
            );
        }
    }

    public function sayHello()
    {
        return "Hello World from Facade!";
    }
}
