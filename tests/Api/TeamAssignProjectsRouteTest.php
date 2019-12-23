<?php

namespace Tests\Api;

use App\Team;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamAssignProjectsTest extends TestCase
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
    public function assign_project_associates_project_with_team()
    {
        $project = factory(Project::class)->create();
        $team = factory(Team::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            'api/team/project',
            ['id' => $team->id, 'project_id' => $project->id]
        );

        $updatedProject = Project::find($project->id);

        $this->assertEquals($team->id, $updatedProject->team_id);
        $response->assertStatus(302);
    }
}
