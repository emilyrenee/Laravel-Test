<?php

namespace Tests\Unit;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->project = factory(Project::class)->create();
    }

    /**
     * Project can use ShareString Trait
     * 
     * @test
     * @return void
     */
    public function share_string_should_return_correct_string()
    {
        $result = $this->project->share();
        $this->assertEquals($result, "Share this string!");
    }
}
