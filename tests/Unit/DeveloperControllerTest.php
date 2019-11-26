<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Developer;

class DeveloperControllerTest extends TestCase
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
    public function createPasses()
    {
        $developer = factory(Developer::class)->create();
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/create',
            ['name' => $developer->name, 'email' => $developer->email]
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
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
            ['name' => $developer->name, 'email' => $developer->email]
        );

        $json = json_decode($response->getContent(), true);
        $customMessage = $json['errors']['name'][0];
        $expectedCustomMessage = 'Name should include a captitalized First Name and Last Name with a space between.';

        $this->assertEquals($customMessage, $expectedCustomMessage);
        $response->assertStatus(422);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function updatePasses()
    {
        $developer = factory(Developer::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/update',
            ['name' => 'New Tester', 'email' => 'newtest@test.com', 'id' => $developer->id]
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function deletePasses()
    {
        $developer = factory(Developer::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/delete',
            ['id' => $developer->id]
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function assignTeamPasses()
    {
        $developer = factory(Developer::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/assignTeam',
            ['id' => $developer->id, 'team_ids' => [4]]
        );

        $response->assertStatus(302);
    }

      /**
     * A basic test example.
     * @test
     * @return void
     */
    public function assignTeamPassesMuliAssign()
    {
        $developer = factory(Developer::class)->create();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/assignTeam',
            ['id' => $developer->id, 'team_ids' => [4, 5, 6]]
        );

        $response->assertStatus(302);
    }
}
