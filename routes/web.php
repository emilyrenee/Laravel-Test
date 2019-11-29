<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use App\Project;
use App\Task;

Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/developers', 'PagesController@developers');
Route::get('/developer/create', 'PagesController@developerCreate');
Route::get('/developer/update', 'PagesController@developerUpdate');
Route::get('/teams', 'PagesController@teams');
Route::get('/team/assignProject', 'PagesController@teamAssignProject');
Route::get('/projects', 'PagesController@projects');
Route::get('/project/assignTeam', 'PagesController@projectAssignTeam');
Route::get('/tasks', 'PagesController@tasks');

Route::post('/developer/create', 'DeveloperController@create');
Route::post('/developer/update', 'DeveloperController@update');
Route::post('/developer/delete', 'DeveloperController@delete');
Route::post('/developer/assignTeam', 'DeveloperController@assignTeam');

Route::post('/project/assignTeam', 'ProjectController@team');
Route::post('/project/assignTask', 'ProjectController@task');

Route::post('/team/assignProject', function (Request $request) {
    $request->validate([
        'id' => 'required|numeric',
        'project_id' => 'required|numeric',
    ]);
    $project = Project::find($request->get('project_id'));
    $project->team_id = $request->get('id');
    $project->save();
    return redirect('/teams');
});
Route::post('/task/assignProject', function (Request $request) {
    $request->validate([
        'id' => 'required|numeric',
        'project_id' => 'required|numeric',
    ]);
    $task = Task::find($request->get('id'));
    $task->project_id = $request->get('project_id');
    $task->save();
    return redirect('/tasks');
});


