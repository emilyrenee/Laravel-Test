<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
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

    public function task(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'task_id' => 'required|numeric',
        ]);
        $task = Task::find($request->get('task_id'));
        $task->project_id = $request->get('id');
        $task->save();
        return redirect('/projects');
    }

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


}