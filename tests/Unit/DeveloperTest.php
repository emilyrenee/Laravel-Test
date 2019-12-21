<?php

namespace Tests\Unit;

use App\Developer;
use Tests\TestCase;

class DeveloperTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Custom Developer Facade calls sayHello()
     * 
     * @test
     * @return void
     */
    public function say_hello_returns_correct_string()
    {
        $result = \App\Facades\Developer::sayHello();
        $this->assertEquals($result, "Hello World from Facade!");
    }
}