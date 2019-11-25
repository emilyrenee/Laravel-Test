<?php

namespace App\Http\Controllers;

use App\Developer;
use App\Repositories\DeveloperRepository;
use App\Mail\DeveloperCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Rules\FullName;

// the repository is injected into the the controller
class DeveloperController extends Controller
{
    private $developer;

    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developer = $developerRepository;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', new FullName],
            'email' => 'required|email|max:255',
            'timezone' => 'required_if:is_local,true',
            'personal_site' => 'url'
            // TODO: avatar -> customer rule and message
        ]);
        $developer = $this->developer->create($validatedData);
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
            'id' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'timezone' => 'required_if:is_local,true',
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
}
