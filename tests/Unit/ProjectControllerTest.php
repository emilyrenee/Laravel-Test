<?php

namespace Tests\Feature;

use App\Task;
use App\Team;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Team assign project route returns 302 status.
     * @test
     * @return void
     */
    public function taskPasses()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/project/assignTask',
            ['id' => $project->id, 'task_id' => $task->id]
        );

        $response->assertStatus(302);
    }

     /**
     * Project assign team route returns 302 status.
     * @test
     * @return void
     */
    public function teamPasses()
    {
        $project = factory(Project::class)->create();
        $team = factory(Team::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/project/assignTeam',
            ['id' => $project->id, 'team_id' => $team->id]
        );

        $response->assertStatus(302);
    }

    /**
     * Project create route returns 201 status.
     * @test
     * @return void
     */
    public function createPasses()
    {
        $project = factory(Project::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/project/create',
            ['name' => $project->name]
        );

        $response->assertStatus(201);
    }

    /**
     * Project update route returns 200 status.
     * @test
     * @return void
     */
    public function updatePasses()
    {
        $project = factory(Project::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/project/update',
            ['name' => $project->name, 'team_id' => 4, 'id' => $project->id]
        );

        $response->assertStatus(200);
    }

     /**
     * Project delete route returns 200 status.
     * @test
     * @return void
     */
    public function deletePasses()
    {
        $project = factory(Project::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/project/delete',
            ['id' => $project->id]
        );

        $response->assertStatus(200);
    }
}
