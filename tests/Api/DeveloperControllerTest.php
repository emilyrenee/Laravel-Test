<?php

namespace Tests\Api;

use App\Team;
use App\User;
use App\Developer;
use Tests\TestCase;
use App\Jobs\ProcessEmailJob;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
    public function create_should_dispatch_job_insert_and_redirect()
    {
        $this->expectsJobs([ProcessEmailJob::class]);
        $developer = factory(Developer::class)->create();
        $newName = $developer->name;
        $newEmail = $developer->email;
        $newSite = $developer->personal_site;

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/api/developer/create',
            [
                'name' => $newName,
                'email' => $newEmail,
                'personal_site' => $newSite
            ]
        );

        $newDevloper = collect(Developer::find($developer->id));
        
        $this->assertEquals($newName, $newDevloper['name']);
        $this->assertEquals($newEmail, $newDevloper['email']);
        $this->assertEquals($newSite, $newDevloper['personal_site']);

        $response->assertStatus(302);
    }

    /**
     * Developer create stores uploaded avatar image
     * and returns 302 status.
     * @test
     * @return void
     */
    public function create_should_store_uploaded_avatar()
    {
        Storage::fake('avatars');

        $developer = factory(Developer::class)->create();
        $avatarFile = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/api/developer/create',
            [
                'name' => $developer->name,
                'email' => $developer->email,
                'personal_site' => $developer->personal_site,
                'avatar' => $avatarFile
            ]
        );

        $filenameWithExt = $avatarFile->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $avatarFile->getClientOriginalExtension();

        $expectedUploadedName = 'avatars/' . $filename . '_' . time() . '.' . $extension;
        $expectedSmallThumbName = 'avatars/thumbnail/' . $filename . '_small_' . time() . '.' . $extension;
        $expectedMedThumbName = 'avatars/thumbnail/' . $filename . '_medium_' . time() . '.' . $extension;
        $expectedLgThumbName = 'avatars/thumbnail/' . $filename . '_large_' . time() . '.' . $extension;

        Storage::disk('public')->assertExists($expectedUploadedName);
        Storage::disk('public')->assertExists($expectedSmallThumbName);
        Storage::disk('public')->assertExists($expectedMedThumbName);
        Storage::disk('public')->assertExists($expectedLgThumbName);
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
        $avatar = UploadedFile::fake()->image('noimage.jpeg');

        $response = $this
            ->withHeaders([
                'X-Header' => 'Value',
            ])->json(
                'POST',
                '/api/developer/update',
                [
                    'id' => $developer->id,
                    'name' => $newName,
                    'avatar' => $avatar,
                    'email' => $newEmail,
                ]
            );

        $updatedDevloper = collect(Developer::find($developer->id));
        // \Log::info('in controller test');
        // \Log::info($updatedDevloper);
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

        $updatedCount = \DB::table('developers_teams')->where([
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

        $updatedCount = \DB::table('developers_teams')->where([
            ['developer_id', '=', $developer->id],
        ])->count();

        $this->assertEquals(count($team_ids), $updatedCount);
        $response->assertStatus(302);
    }
}
