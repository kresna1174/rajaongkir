<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JwtAuthTest extends TestCase
{

    public function test_user_can_login_with_valid_credentials()
    {
        
        $response = $this->post('/api/login', [
            'name' => 'admin',
            'password' => 'admin',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'user', 'authorisation']);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/api/login', [
            'name' => 'admin',
            'password' => 'anonim',
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure(['status', 'message']);
    }
}
