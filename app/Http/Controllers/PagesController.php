<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;
use App\Team;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('welcome');
    }

    public function developers()
    {
        $developers = Developer::orderBy('updated_at', 'desc')->paginate(5);
        return view('developers')->with('developers', $developers);
    }

    public function createDeveloper()
    {
        $teamOptions = Team::all();
        return view('createDeveloper')->with('teamOptions', $teamOptions);
    }

    public function teams()
    {
        $teams = Team::all();
        return view('teams')->with('teams', $teams);
    }
}
