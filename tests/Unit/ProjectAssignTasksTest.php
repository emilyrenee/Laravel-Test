<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Project;
use App\Task;

class ProjectAssignTasksTest extends TestCase
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
    public function assignTasksPasses()
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
}
