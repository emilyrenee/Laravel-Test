<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function developers() {
        // has many developers
    }

    public function projects() {
        // has many projects
    }
}
