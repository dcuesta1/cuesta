<?php

namespace Tests\Feature;

use App\AuthToken;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserNoPermTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUserNoPerm()
    {
        $token = AuthToken::find(2);
        $user = [
            'name' => 'juan david',
            'username' => 'jdavid',
            'email' => 'jdavid@website.com'
        ];

        $response = $this->withHeaders([
            'Authorization' => $token->value,
        ])->json('POST', '/api/users', $user);

        $response
            ->assertStatus(403);
    }
}