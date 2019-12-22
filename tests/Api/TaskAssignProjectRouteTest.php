<?php

namespace Tests\Api;

use App\Task;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskAssignProjectTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Task assign project route returns 302 status.
     * @test
     * @return void
     */
    public function assign_project_associates_task_with_project()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            'api/task/assignProject',
            ['id' => $task->id, 'project_id' => $project->id]
        );

        $updatedTask = Task::find($task->id);

        $this->assertEquals($project->id, $updatedTask->project_id);
        $response->assertStatus(302);
    }
}
