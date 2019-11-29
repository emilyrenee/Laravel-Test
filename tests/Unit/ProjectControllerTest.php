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
}
