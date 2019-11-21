<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    public function tasks()
    {
        // hasMany - Tasks
    }
    
    public function teams()
    {
        // belongsToMany - Teams
    }
}
