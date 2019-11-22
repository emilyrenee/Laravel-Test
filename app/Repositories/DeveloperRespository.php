<?php

namespace App\Repositories;

use App\Developer;

// model is injected in
class DeveloperRepository
{
    protected $developer;

    public function __construct(Developer $developer)
    {
        $this->developer = $developer;
    }

    public function create(array $attributes = [])
    {
        $this->developer->create($attributes);
    }

    public function update(array $attributes = [])
    {
        $this->developer->update($attributes);
    }

    public function delete(array $attributes = [])
    {
        $developer = Developer::find($attributes['id']);
        $developer->delete($attributes['id']);
    }
}