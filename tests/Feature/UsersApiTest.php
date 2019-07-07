<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersApiTest extends TestCase
{

    /**
     * Registration endpoint test
     */
    public function testUserCanRegisterOk(){

        $testingId = uniqid();

        $response = $this->post('/api/register', [
            'email' => $testingId.'@gmail.com',
            'name' => 'testing',
            'password' => $testingId
        ]);
        $response->assertStatus(200)->assertJson(
            [
                'status' => 'success',
            ]
        );

        return $testingId;
            
    }

    /**
     * Login and key assignment functionality
     * 
     * @depends testUserCanRegisterOk
     */
    public function testUserCanLoginOkAndGetsToken($testingId) {

        $response = $this->post('/api/login', [
            'email' => $testingId.'@gmail.com',
            'password' => $testingId
        ]);

        $response->assertStatus(200)->assertJson(
            [
                'success' => true
            ]
        );

        $responseJson = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('token', $responseJson);

    }

    /**
     * Login functionality fails in the correct manner
     */
    public function testUserLoginFailsWithoutEmailOrPassword(){

        $response = $this->post('/api/login', [
            'password' => 'testing'
        ]);

        $response->assertStatus(200)->assertJson(
            [
                'success' => false
            ]
        );


        $response = $this->post('/api/login', [
            'email' => 'testing@gmail.com',
        ]);

        $response->assertStatus(200)->assertJson(
            [
                'success' => false
            ]
        );

        
        $response = $this->post('/api/login', [
        ]);

        $response->assertStatus(200)->assertJson(
            [
                'success' => false
            ]
        );

    }
}