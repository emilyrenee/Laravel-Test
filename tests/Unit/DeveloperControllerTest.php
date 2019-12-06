<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use App\Developer;
use Tests\TestCase;
use App\Jobs\ProcessEmailJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeveloperControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Developer create route dispatches email job
     * and returns 302 status.
     * @test
     * @return void
     */
    public function createPasses()
    {
        $this->expectsJobs([ProcessEmailJob::class]);
        $developer = factory(Developer::class)->create();
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/create',
            [
                'name' => $developer->name,
                'email' => $developer->email
            ]
        );
        $response->assertStatus(302);
    }

    /**
     * Developer create route fails with invalid name
     * and returns 422 status and custom error message.
     * @test
     * @return void
     */
    public function createFails()
    {
        $developer = factory(Developer::class)->create(['name' => 'DoesntPass']);


        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/create',
            [
                'name' => $developer->name,
                'email' => $developer->email
            ]
        );

        $json = json_decode($response->getContent(), true);
        $customMessage = $json['errors']['name'][0];
        $expectedCustomMessage = 'Name should include a captitalized First Name and Last Name with a space between.';

        $this->assertEquals($customMessage, $expectedCustomMessage);
        $response->assertStatus(422);
    }

    /**
     * Developer update route returns 302 status.
     * @test
     * @return void
     */
    public function updatePasses()
    {
        $developer = factory(Developer::class)->create();

        $response = $this
            ->withHeaders([
                'X-Header' => 'Value',
            ])->json(
                'POST',
                '/developer/update',
                [
                    'name' => 'New Tester',
                    'email' => 'newtest@test.com',
                    'id' => $developer->id
                ]
            );

        $response->assertStatus(302);
    }

    /**
     * Developer delete route returns 302 status.
     * @test
     * @return void
     */
    public function deletePasses()
    {
        $developer = factory(Developer::class)->create();

        $response = $this
            ->withHeaders(
                [
                    'X-Header' => 'Value',
                ]
            )->json(
                'POST',
                '/developer/delete',
                ['id' => $developer->id]
            );

        $response->assertStatus(302);
    }

    /**
     * Developer assign team route returns 302 status.
     * @test
     * @return void
     */
    public function assignTeamPasses()
    {
        $developer = factory(Developer::class)->create();
        $team = factory(Team::class)->create();
        $user = factory(User::class)->make(['user_role_id' => 1]);


        $response = $this
            ->actingAs($user)
            ->withHeaders(
                [
                    'X-Header' => 'Value',
                ]
            )
            ->json(
                'POST',
                '/developer/assignTeam',
                [
                    'id' => $developer->id,
                    'team_ids' => [$team->id]
                ]
            );

        $response->assertStatus(302);
    }

    /**
     * Developer assign team route returns 302 status
     * when assigning many teams.
     * @test
     * @return void
     */
    public function assignTeamPassesMuliAssign()
    {
        $developer = factory(Developer::class)->create();
        $team1 = factory(Team::class)->create();
        $team2 = factory(Team::class)->create();
        $team3 = factory(Team::class)->create();
        $user = factory(User::class)->make(['user_role_id' => 1]);

        $response = $this
            ->actingAs($user)
            ->withHeaders(
                [
                    'X-Header' => 'Value',
                ]
            )->json(
                'POST',
                '/developer/assignTeam',
                [
                    'id' => $developer->id,
                    'team_ids' => [$team1->id, $team2->id, $team3->id]
                ]
            );

        $response->assertStatus(302);
    }
}
