<?php

namespace App\Http\Controllers;

use App\Team;
use App\Project;
use App\Developer;
use App\ProjectStatus;
use Illuminate\Http\Request;

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

    public function developerCreate()
    {
        $teamOptions = Team::all();
        return view('createDeveloper')->with('teamOptions', $teamOptions);
    }

    public function developerUpdate(Request $request)
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

    public function teamProject(Request $request)
    {
        $team = Team::find($request->query('id'));
        $projects = Project::all();
        return view('teamProject')->with('team', $team)->with('projects', $projects);
    }

    public function projects()
    {
        $projects = Project::all();
        return view('projects')->with('projects', $projects);
    }

    public function projectTeam(Request $request)
    {
        $project = Project::find($request->query('id'));
        $teams = Team::all();
        return view('projectTeam')->with('project', $project)->with('teams', $teams);
    }

    public function projectStatus(Request $request)
    {
        $project = Project::find($request->query('id'));
        $project_statuses = ProjectStatus::all();
        return view('projectStatus')->with('project', $project)->with('project_statuses', $project_statuses);
    }
}
