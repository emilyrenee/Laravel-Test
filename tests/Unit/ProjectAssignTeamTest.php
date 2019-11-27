<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Project;
use App\Team;

class ProjectAssignTeamTest extends TestCase
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
    public function assignTeamPasses()
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
