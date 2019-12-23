<?php

namespace Tests\Web;

use App\Project;
use App\Developer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Index route returns 200 status code.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Developers route returns 200 status code.
     *
     * @return void
     */
    public function testDevelopersIndex()
    {
        $response = $this->get('/developers');
        $response->assertStatus(200);
    }

    /**
     * Get developer create route returns 200 status code.
     *
     * @return void
     */
    public function testDeveloperCreate()
    {
        $response = $this->get('/developer/create');
        $response->assertStatus(200);
    }

    /**
     * Get developer update route returns 200 status code.
     *
     * @return void
     */
    public function testDeveloperUpdate()
    {
        $developer = factory(Developer::class)->create();
        $response = $this->get('/developer/update?id=' . $developer->id);
        $response->assertStatus(200);
    }

    /**
     * Get teams route returns 200 status code.
     *
     * @return void
     */
    public function testTeamsIndex()
    {
        $response = $this->get('/teams');
        $response->assertStatus(200);
    }

    /**
     * Get projects route returns 200 status code.
     *
     * @return void
     */
    public function testProjectsIndex()
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }

    /**
     * Get project assign team route returns 200 status code.
     *
     * @return void
     */
    public function testProjectsAssignTeam()
    {
        $project = factory(Project::class)->create();
        $response = $this->get('/project/team?id=' . $project->id);
        $response->assertStatus(200);
    }

    /**
     * Get teams route returns 200 status.
     *
     * @return void
     */
    public function testTasksIndex()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }
}
