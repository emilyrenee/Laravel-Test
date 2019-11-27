<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Project;
use App\Task;

class TaskAssignProjectTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function assignProjectPasses()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/task/assignProject',
            ['id' => $task->id, 'project_id' => $project->id]
        );

        $response->assertStatus(302);
    }
}
