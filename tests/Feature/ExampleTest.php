<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // public function setUp(): void 
    // {
    //     parent::setUp();
    // }

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

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function testDevelopersIndex()
    // {
    //     $response = $this->get('/developers');

    //     $response->assertStatus(200);
    // }

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function testGetDevelopersCreate()
    // {
    //     $response = $this->get('/developers/create');

    //     $response->assertStatus(200);
    // }

    //  /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function testTeamsIndex()
    // {
    //     $response = $this->get('/teams');

    //     $response->assertStatus(200);
    // }
}
