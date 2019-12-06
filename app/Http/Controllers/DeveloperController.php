<?php

namespace App\Http\Controllers;

use App\Rules\FullName;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmailJob;
use App\Http\Controllers\Controller;
use App\Repositories\DeveloperRepository;

class DeveloperController extends Controller
{
    private $developerRepo;
    protected $fillable = ['name', 'email', 'avatar', 'personal_site', 'is_local', 'timezone'];

    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developerRepo = $developerRepository;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', new FullName],
            'email' => 'required|email|max:255',
            'avatar' => 'mimes:jpeg,png',
            'personal_site' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'timezone' => 'required_if:is_local,false'
        ]);

        $developer = $this->developerRepo->create($request, $validatedData);

        if ($request->get('team_ids')) {
            foreach ($request->get('team_ids') as $team_id) {
                $this->developerRepo->assignTeam(['id' => $developer->id, 'team_id' => $team_id]);
            }
        }
        dispatch(new ProcessEmailJob($developer->id));
        return redirect('/developers');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => ['required', 'string', 'max:255', new FullName],
            'email' => 'required|email|max:255',
            'personal_site' => 'url'
        ]);

        $developer = $this->developerRepo->update($validatedData);

        if ($request->get('team_ids')) {
            foreach ($request->get('team_ids') as $team_id) {
                $this->developerRepo->assignTeam(['id' => $developer->id, 'team_id' => $team_id]);
            }
        }

        return redirect('/developers');
    }

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric'
        ]);
        $this->developerRepo->delete($validatedData);
        return redirect('/developers');
    }

    public function assignTeam(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'team_ids' => 'required|array'
        ]);

        $id = $request->get('id');
        $team_ids = $request->get('team_ids');
        foreach ($team_ids as $team_id) {                
            $this->authorize('assignTeam');
            $this->developerRepo->assignTeam([
                'id' => $id,
                'team_id' => $team_id
            ]);
        }

        return redirect('/developers');
    }
}
