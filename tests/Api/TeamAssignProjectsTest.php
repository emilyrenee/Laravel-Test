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
    public function assignProjectPasses()
    {
        $project = factory(Project::class)->create();
        $team = factory(Team::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/team/assignProject',
            ['id' => $team->id, 'project_id' => $project->id]
        );

        $response->assertStatus(302);
    }
}
