<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDevelopersIndex()
    {
        $response = $this->get('/developers');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetDeveloperCreate()
    {
        $response = $this->get('/developer/create');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostDeveloperCreate()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/create',
            ['name' => 'Tester', 'email' => 'test@test.com']
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostDeveloperUpdate()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/update',
            // TODO: make seed file that ensure dev with this id exists
            ['name' => 'New Tester', 'email' => 'newtest@test.com', 'id' => 24]
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostDeveloperDelete()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/delete',
            // TODO: make seed file that ensure dev with this id exists
            ['id' => 45]
        );

        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTeamsIndex()
    {
        $response = $this->get('/teams');
        $response->assertStatus(200);
    }
}
