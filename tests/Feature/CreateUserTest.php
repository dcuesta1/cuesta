<?php

namespace Tests\Feature;

use App\AuthToken;
use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    public function testCreateUser()
    {
        $token = AuthToken::find(1);

        $user = [
            'name' => 'juan david',
            'username' => 'jdavid',
            'email' => 'jdavid@website.com'
        ];

        $response = $this->withHeaders([
            'Authorization' => $token->value,
        ])->json('POST', '/api/users', $user);

        $response
            ->assertStatus(200)
            ->assertJson($user);
    }
}
