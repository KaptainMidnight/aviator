<?php

use App\Models\User;

test('authentication successfully', function () {
    $user = User::factory()->create();
    $response = $this->post(route('authenticate'), [
        'phone' => $user->phone->trim()->toString(),
        'password' => 'password',
    ]);
    $response->assertStatus(200);
    $response->assertJsonMissing(['message' => 'Неверный логин или пароль']);
});

test('user cannot login with invalid credentials', function () {
    $response = $this->post(route('authenticate'), [
        'phone' => '12345678910',
        'password' => '$secret'
    ]);
    $response->assertStatus(401);
    $response->assertJsonMissing(['token_type' => 'Bearer']);
});

test('authentication validation failed', function () {
    $response = $this->post(route('authenticate'), []);
    $response->assertStatus(302);
});
