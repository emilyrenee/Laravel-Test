<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function tasks() {
        // has many - tasks
    }

    public function team() {
        // belongs to team
    }

    public function developers() {
        // belongs to many developers
    }
 }
