<?php

namespace Tests\Api;

use App\Team;
use App\User;
use App\Developer;
use Tests\TestCase;
use App\Jobs\ProcessEmailJob;
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
    public function create_should_insert_and_redirect()
    {
        $this->expectsJobs([ProcessEmailJob::class]);
        $developer = factory(Developer::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/api/developer/create',
            [
                'name' => $developer->name,
                'email' => $developer->email,
                'personal_site' => $developer->personal_site
            ]
        );

        $newDevloper = collect(Developer::find($developer->id));
        $this->assertEquals($newDevloper['name'], $developer->name);
        $this->assertEquals($newDevloper['email'], $developer->email);
        $this->assertEquals($newDevloper['personal_site'], $developer->personal_site);

        $response->assertStatus(302);
    }

    /**
     * Developer create route fails with invalid name
     * and returns 422 status and custom error message.
     * @test
     * @return void
     */
    public function create_should_fail_and_return_custom_error_message()
    {
        $developer = factory(Developer::class)->create(['name' => 'DoesntPass']);


        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/api/developer/create',
            [
                'name' => $developer->name,
                'email' => $developer->email,
                'personal_site' => $developer->personal_site
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
    public function update_should_should_persist_and_redirect()
    {
        $developer = factory(Developer::class)->create();
        $newName = 'New Tester';
        $newEmail = 'newtest@test.com';

        $response = $this
            ->withHeaders([
                'X-Header' => 'Value',
            ])->json(
                'POST',
                '/api/developer/update',
                [
                    'name' => $newName,
                    'email' => $newEmail,
                    'id' => $developer->id
                ]
            );

        $updatedDevloper = collect(Developer::find($developer->id));
        $this->assertEquals($newName, $updatedDevloper['name']);
        $this->assertEquals($newEmail, $updatedDevloper['email']);   

        $response->assertStatus(302);
    }

    /**
     * Developer delete route returns 302 status.
     * @test
     * @return void
     */
    public function delete_should_remove_and_redirect()
    {
        $developer = factory(Developer::class)->create();

        $response = $this
            ->withHeaders(
                [
                    'X-Header' => 'Value',
                ]
            )->json(
                'POST',
                '/api/developer/delete',
                ['id' => $developer->id]
            );

        $deletedDeveloper = (Developer::find($developer->id));
        $this->assertEquals(null, $deletedDeveloper);

        $response->assertStatus(302);
    }

    /**
     * Developer assign team route returns 302 status.
     * @test
     * @return void
     */
    public function assign_team_persists_and_redirects()
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
                '/api/developer/assignTeam',
                [
                    'id' => $developer->id,
                    'team_ids' => [$team->id]
                ]
            );

        $updatedCount = \DB::table('developers_teams')
            ->where([
                ['developer_id', '=', $developer->id],
                ['team_id', '=', $team->id],
            ])->count();
        $this->assertEquals(1, $updatedCount);

        $response->assertStatus(302);
    }

    /**
     * Developer assign team route returns 302 status
     * when assigning many teams.
     * @test
     * @return void
     */
    public function assign_team_persist_when_multi_assigned_and_redirects()
    {
        $developer = factory(Developer::class)->create();
        $team1 = factory(Team::class)->create();
        $team2 = factory(Team::class)->create();
        $team3 = factory(Team::class)->create();
        $user = factory(User::class)->make(['user_role_id' => 1]);
        $team_ids = [$team1->id, $team2->id, $team3->id];

        $response = $this
            ->actingAs($user)
            ->withHeaders(
                [
                    'X-Header' => 'Value',
                ]
            )->json(
                'POST',
                '/api/developer/assignTeam',
                [
                    'id' => $developer->id,
                    'team_ids' => $team_ids
                ]
            );

        $response->assertStatus(302);

        $updatedCount = \DB::table('developers_teams')
            ->where([
                ['developer_id', '=', $developer->id],
            ])->count();
        $this->assertEquals(count($team_ids), $updatedCount);
    }
}
