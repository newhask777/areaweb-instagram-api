<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register_validation(): void
    {
        $response = $this->post(route('user.register'), [
            'name' => null,
            'email' => 'testtest.com',
            'login' => null,
            // 'avatar' => 'test',
            'password' => '12345678',
            'password_confirmation' => '1234',
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name', 'email', 'login', 'password']);
    }
}
