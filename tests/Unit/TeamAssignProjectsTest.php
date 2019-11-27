<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Project;
use App\Team;

class TeamAssignProjectsTest extends TestCase
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
