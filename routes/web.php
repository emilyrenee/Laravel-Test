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

// web
Route::get('/', 'PagesController@index');
Route::get('/developers', 'PagesController@developers');
Route::get('/developer/create', 'PagesController@developerCreate');
Route::get('/developer/update', 'PagesController@developerUpdate');
Route::get('/teams', 'PagesController@teams');
Route::get('/team/project', 'PagesController@teamProject');
Route::get('/projects', 'PagesController@projects');
Route::get('/project/team', 'PagesController@projectTeam');
Route::get('/project/status', 'PagesController@projectStatus');

// api
Route::prefix('api')->group(function () {
    // developer
    Route::post('/developer/create', 'DeveloperController@create');
    Route::post('/developer/update', 'DeveloperController@update');
    Route::post('/developer/delete', 'DeveloperController@delete');
    Route::post('/developer/team', 'DeveloperController@team');

    // project
    Route::post('/project/create', 'ProjectController@create');
    Route::post('/project/update', 'ProjectController@update');
    Route::post('/project/delete', 'ProjectController@delete');
    Route::post('/project/status', 'ProjectController@status');
    Route::post('/project/team', 'ProjectController@team');

    // misc
    Route::post('/team/project', function (Request $request) {
        $request->validate([
            'id' => 'required|numeric',
            'project_id' => 'required|numeric',
        ]);
        $project = Project::find($request->get('project_id'));
        $project->team_id = $request->get('id');
        $project->save();
        return redirect('/teams');
    });
});
