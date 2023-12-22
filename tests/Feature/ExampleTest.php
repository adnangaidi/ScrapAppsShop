<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertSame;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertSee('laravel');
        $response->assertStatus(200);
    }
    public function test_visit_home_page(){
        $response= $this->get("/");
        $response->assertStatus(200);
    }
}
