<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_is_available()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertOk();
        $response->assertSeeText(env('APP_NAME'));
        $response->assertDontSeeText('Error');
        $response->assertDontSeeText('Exception');
        $response->assertLocation(env('APP_URL'));
    }

    public function test_users_page_get_request()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
}
