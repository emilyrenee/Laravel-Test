<?php

namespace App\Http\Controllers;

use App\Developer;
use App\Repositories\DeveloperRepository;
use App\Mail\DeveloperCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

// the repository is injected into the the controller
class DeveloperController extends Controller 
{
    private $developer;

    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developer = $developerRepository;
    }

    // (Illuminate\Http\Request $request, array $rules, array $messages = Array, array $customAttributes = Array)
    public function validate(Request $request, $rules = [], $messages = [], $customAttributes = []) {
        return $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'timezone' => 'required_if:is_local,true',
            'personal_site' => 'url'
        ]);
    }
    
    public function create(Request $request)
    {
        $validatedData = $this->validate($request);
        Log::info($validatedData);
        $developer = $this->developer->create($validatedData);
        Log::info($developer);
        $this->sendMail($developer);
        return redirect('/developers');
    }

    public function sendMail(Developer $developer)
    {
        Mail::to('hagoodem@gmail.com')->send(new DeveloperCreated($developer));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'id' => 'required|numeric'
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
}
