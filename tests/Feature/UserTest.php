<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_login_screen_returns_a_successful_response()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_registration_page_returns_a_successful_response() {

        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
