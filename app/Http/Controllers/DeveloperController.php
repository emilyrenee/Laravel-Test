<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DeveloperRepository;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255'
        ]);

        $this->developer->create($validatedData);
        return redirect('/developers');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'id' => 'required'
        ]);

        $this->developer->update($validatedData);
        return redirect('/developers');
    }

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required'
        ]);
        $this->developer->delete($validatedData);
        return redirect('/developers');
    }
}
