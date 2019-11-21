<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;

class DeveloperController extends Controller
{
    private $developer;

    public function __construct()
    {
        $this->developer = new Developer;
    }
    
    public function create(Request $request)
    {
        $this->developer->create($request);
        return redirect('/developers');
    }

    public function update(Request $request)
    {
        $this->developer->update($request);
        return redirect('/developers');
    }
}
