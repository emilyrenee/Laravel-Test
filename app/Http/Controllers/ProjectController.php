<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
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
}