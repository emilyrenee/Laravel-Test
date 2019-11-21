<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

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
    public function testGetDevelopersCreate()
    {
        $response = $this->get('/developer/create');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostDevelopersCreate()
    {
        $this->withoutMiddleware();
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
    public function testPostDevelopersUpdate()
    {
        $this->withoutMiddleware();
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/developer/update',
            ['name' => 'New Tester', 'email' => 'newtest@test.com', 'id' => 5]
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
