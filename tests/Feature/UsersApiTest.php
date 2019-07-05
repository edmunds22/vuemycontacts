<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersApiTest extends TestCase
{
    /**
     * Registration endpoint test
     *
     * @return void
     */
    public function testUserCanRegisterOk(){
        $response = $this->post('/api/register', [
            'email' => uniqid().'@gmail.com',
            'name' => 'testing',
            'password' => uniqid()
        ]);
        $response->assertStatus(200)->assertJson(
            [
                'status' => 'success',
            ]
        );
            
    }
}