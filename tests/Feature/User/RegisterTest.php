<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_success_register(): void
    {
        $data = [
            "name" => fake()->name,
            "email" => fake()->unique()->email,
            "login" => fake()->unique()->userName(),
            "password" => "12345678",
            "password_confirmation" => "12345678",
        ];

        $response = $this->post(route('user.register'), $data);

        $response->assertCreated();

        $id = $response->json('id');

        $this->assertDatabaseHas(User::class, [
            "id" => $id,
            "name" => Arr::get($data, 'name'),
            "email" => Arr::get($data, 'email'),
            "login" => Arr::get($data, 'login'),
//            "password" => Hash::check(Arr::get($data, 'password'), Arr::get($data, 'password')),
        ]);

    }

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
