<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function create(Request $request)
    {
        $project = new Project();
        $project->name = $request->get('name');

        $project->save();

        return $project;
    }

    public function update(Request $request)
    {
        $project = Project::find($request->get('id'));

        $project->name = $request->get('name');
        $project->team_id = $request->get('team_id');

        $project->save();

        return $project;
    }

    public function delete(Request $request)
    {
        $project = Project::find($request->get('id'));

        $success = $project->delete($request->get('id'));

        if ($success) {
            return response('Hello World', 200);
        } else {
            return response('Hello World', 500);
        }
    }
    public function team(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'team_id' => 'required|numeric',
        ]);

        $project = Project::find($request->get('id'));
        $project->team_id = $request->get('team_id');

        $project->save();

        return redirect('/projects');
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'project_status_id' => 'required|numeric',
        ]);

        $project = Project::find($request->get('id'));
        $project->project_status_id = $request->get('project_status_id');

        $project->save();

        return redirect('/projects');
    }
}
