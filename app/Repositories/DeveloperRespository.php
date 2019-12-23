<?php

namespace App\Repositories;

use App\Developer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

// model is injected in
class DeveloperRepository
{
    protected $developer;

    public function __construct(Developer $developer)
    {
        $this->developer = $developer;
    }

    public function create(array $attributes = [], array $options = [])
    {
        return $this->developer->create($attributes);
    }

    public function update(array $attributes = [], array $options = [])
    {
        return $this->developer->update($attributes);
    }

    public function delete(array $attributes = [])
    {
        $developer = Developer::find($attributes['id']);
        return $developer->delete($attributes['id']);
    }

    public function team(array $attributes = [])
    {
        $developer = Developer::find($attributes['id']);
        $developer_team = $developer->teams()->where('team_id', $attributes['team_id'])->count();

        if ($developer_team === 0) {
            $developer->teams()->attach($attributes['team_id']);
        }
        
        return $developer;
    }
}
