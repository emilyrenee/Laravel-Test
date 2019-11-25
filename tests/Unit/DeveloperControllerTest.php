<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

// use to model factory for testable instances
class DeveloperControllerTest extends TestCase
{
    
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
    // public function createPasses()
    // {
    //     $response = $this->withHeaders([
    //         'X-Header' => 'Value',
    //     ])->json(
    //         'POST',
    //         '/developer/create',
    //         ['name' => 'Tester Testing', 'email' => 'test@test.com']
    //     );

    //     $response->assertStatus(302);
    // }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function createFails()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/create',
            ['name' => 'TesterTesting', 'email' => 'test@test.com']
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
    public function update()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/update',
            ['name' => 'New Tester', 'email' => 'newtest@test.com', 'id' => 9001]
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function delete()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/delete',
            ['id' => 9001]
        );

        $response->assertStatus(302);
    }
}
