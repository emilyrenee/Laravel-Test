<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;
use App\Team;

class PagesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function developers()
    {
        $developers = Developer::all();
        return view('developers')->with('developers', $developers);
    }

    public function teams()
    {
        $teams = Team::all();
        return view('teams')->with('teams', $teams);
    }
}
