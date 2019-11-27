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

use App\Project;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/developers', 'PagesController@developers');
Route::get('/developer/create', 'PagesController@createDeveloper');
Route::post('/developer/create', 'DeveloperController@create');
Route::get('/developer/update', 'PagesController@updateDeveloper');
Route::post('/developer/update', 'DeveloperController@update');
Route::post('/developer/delete', 'DeveloperController@delete');
Route::post('/developer/assignTeam', 'DeveloperController@assignTeam');

Route::get('/teams', 'PagesController@teams');

Route::get('/projects', 'PagesController@projects');
Route::get('/project/assignTeam', function (Request $request) {
    $project = Project::find($request->query('id'));
    return view('assignProject')->with('project', $project);
});
Route::post('/project/assignTeam', function (Request $request) {
    $request->validate([
        'id' => 'required|numeric',
        'team_id' => 'required|numeric',
    ]);
    $project = Project::find($request->get('id'));
    $project->team_id = $request->get('team_id');
    $project->save();
    return redirect('/projects');
});
Route::get('/tasks', 'PagesController@tasks');
