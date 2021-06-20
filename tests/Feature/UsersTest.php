<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /**
     * Set Up
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createValidUserAccount();
    }

    /**
     * Index test
     */
    public function testIndex(): void
    {
        $loginParams = [
            'mail_address' => $this->user->mail_address,
            'password' => 'password',
        ];
        $loginResponse = $this->json('POST', route('users.login'), $loginParams);
        $loginResponse->assertStatus(200)->assertJson([
            'status' => true,
        ]);

        $indexParams = [
            'page' => 1,
            'per_page' => 5
        ];
        $header = [
            'headers' => [
                'Authorization' => 'Bearer ' . $loginResponse['data']['access_token'],
                'Accept' => 'application/json',
            ],
        ];
        $response = $this->json('GET', route('users.index'), [$header, $indexParams]);
        $response->assertStatus(200)->assertJson([
            'status' => true,
        ]);
    }

    public function testLogin(): void
    {
        $loginParams = [
            'mail_address' => $this->user->mail_address,
            'password' => 'password',
        ];
        $loginResponse = $this->json('POST', route('users.login'), $loginParams);
        $loginResponse->assertStatus(200)->assertJson([
            'status' => true,
        ]);
    }
}
