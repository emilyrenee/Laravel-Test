<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;
use App\Team;
use Illuminate\Support\Facades\Log;

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

    public function updateDeveloper(Request $request)
    {
        $developer = Developer::find($request->query('id'));
        $teamOptions = Team::all();
        return view('updateDeveloper')->with('teamOptions', $teamOptions)->with('developer', $developer);
    }

    public function teams()
    {
        $teams = Team::all();
        return view('teams')->with('teams', $teams);
    }
}
