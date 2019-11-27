<?php

namespace App\Http\Controllers;

use App\Developer;
use App\Repositories\DeveloperRepository;
use App\Mail\DeveloperCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Rules\FullName;
use Illuminate\Support\Facades\Log;

class DeveloperController extends Controller
{
    private $developer;
    protected $fillable = ['name', 'email', 'avatar', 'personal_site', 'is_local', 'timezone'];

    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developer = $developerRepository;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', new FullName],
            'email' => 'required|email|max:255',
            'avatar' => 'file',
            'timezone' => 'required_if:is_local,false'
        ]);

        if ($request->has('personal_site')) {
            $request->validate([
                'personal_site' => 'url',
            ]);
        }

        $developer = $this->developer->create($request, $validatedData);

        if ($request->get('team_ids')) {
            foreach ($request->get('team_ids') as $team_id) {
                $this->developer->assignTeam(['id' => $developer->id, 'team_id' => $team_id]);
            }
        }

        $this->sendMail($developer);
        return redirect('/developers');
    }

    public function sendMail(Developer $developer)
    {
        Mail::to('hagoodem@gmail.com')->send(new DeveloperCreated($developer));
    }

    public function update(Request $request)
    {
        Log::info($request);
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => ['required', 'string', 'max:255', new FullName],
            'email' => 'required|email|max:255',
            'personal_site' => 'url'
        ]);
        $this->developer->update($validatedData);
        return redirect('/developers');
    }

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric'
        ]);
        $this->developer->delete($validatedData);
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
            $this->developer->assignTeam(['id' => $id, 'team_id' => $team_id]);
        }


        return redirect('/developers');
    }
}
