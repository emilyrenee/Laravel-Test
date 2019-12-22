<?php

namespace Tests\Unit;

use App\Developer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeveloperTest extends TestCase 
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->developer = factory(Developer::class)->create();
    }

    /**
     * Custom Developer Facade calls sayHello()
     * 
     * @test
     * @return void
     */
    public function say_hello_should_return_correct_string()
    {
        $result = \App\Facades\Developer::sayHello();
        $this->assertEquals($result, "Hello World from Facade!");
    }
}