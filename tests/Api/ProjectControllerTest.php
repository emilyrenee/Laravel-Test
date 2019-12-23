<?php

namespace Tests\Api;

use App\Task;
use App\Team;
use App\Project;
use Tests\TestCase;
use App\ProjectStatus;
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
    public function assign_task_relates_task_to_project_and_redirects()
    {
        $project = factory(Project::class)->create();
        $task = factory(Task::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/api/project/assignTask',
            [
                'id' => $project->id,
                'task_id' => $task->id
            ]
        );

        $updatedTask = collect(Task::find($task->id));

        $this->assertEquals($project->id, $updatedTask['project_id']);
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
            '/api/project/assignTeam',
            [
                'id' => $project->id,
                'team_id' => $team->id
            ]
        );

        $updatedProject = collect(Project::find($project->id));

        $this->assertEquals($team->id, $updatedProject['team_id']);
        $response->assertStatus(302);
    }

    /**
     * Project can be given one status
     * 
     * @test
     * @return void
     */
    public function project_status_should_assign_and_redirect()
    {
        $project = factory(Project::class)->create();
        $projectStatus = factory(ProjectStatus::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/api/project/status',
            [
                'id' => $project->id,
                'project_status_id' => $projectStatus->id
            ]
        );

        $updatedProject = Project::find($project->id);

        $this->assertEquals($projectStatus->id, $updatedProject->project_status_id);
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
            '/api/project/create',
            ['name' => $project->name]
        );

        $newProject = collect(Project::find($project->id));

        $this->assertEquals($project->name, $newProject['name']);
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
            '/api/project/update',
            [
                'name' => $project->name,
                'team_id' => 4,
                'id' => $project->id
            ]
        );

        $updatedProject = collect(Project::find($project->id));

        $this->assertEquals($project->name, $updatedProject['name']);
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
            '/api/project/delete',
            ['id' => $project->id]
        );

        $deletedProject = Project::find($project->id);

        $this->assertEquals(null, $deletedProject);
        $response->assertStatus(200);
    }
}
