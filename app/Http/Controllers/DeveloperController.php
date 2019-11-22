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
        $attributes = [
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ];
        $this->developer->create($attributes);
        return redirect('/developers');
    }

    public function update(Request $request)
    {
        $attributes = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'id' => $request->input('id')
        ];
        $this->developer->update($attributes);
        return redirect('/developers');
    }

    public function delete(Request $request)
    {
        $attributes = [
            'id' => $request->input('id')
        ];
        $this->developer->delete($attributes);
        return redirect('/developers');
    }
}
