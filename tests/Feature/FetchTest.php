<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FetchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function login()
    {
        $response = $this->post('/api/login', [
            'name' => 'admin',
            'password' => 'admin',
        ]);
        
        return $response->json('authorisation')['token'];
    }

    public function test_get_province_all()
    {
        $token = $this->login();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/search/provinces');
        
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'province_id',
                    'province',
                ],
            ],
        ]);
    }

    public function test_get_province_by_id()
    {
        $token = $this->login();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/search/provinces?id=1');
        
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'data' => [
                'province_id',
                'province',
            ],
        ]);
    }

    public function test_get_city_all()
    {
        $token = $this->login();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/search/cities');
        
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'city_id',
                    'province_id',
                    'type',
                    'city_name',
                    'postal_code',
                    'province' => [
                        'province_id',
                        'province',
                    ],
                ],
            ],
        ]);
    }

    public function test_get_city_by_id()
    {
        $token = $this->login();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/search/cities?id=1');
        
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'data' => [
                'city_id',
                'province_id',
                'type',
                'city_name',
                'postal_code',
                'province',
            ],
        ]);
    }
}
