<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;

class DeveloperController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
    }
}
