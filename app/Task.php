<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function developer() {
        // belongs to developer
    }

    public function status() {
        // has one status
    }
}
