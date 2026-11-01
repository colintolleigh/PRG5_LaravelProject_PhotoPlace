<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'username' => 'test_user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('new users can register with a profile picture and gear', function () {
    Storage::fake('public');

    $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'username' => 'test_user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'profile_picture' => UploadedFile::fake()->image('me.jpg'),
        'gear' => "Fujifilm X-T5\n XF 23mm f/1.4 \n\n",
    ]);

    $user = User::where('username', 'test_user')->firstOrFail();

    expect($user->gear)->toBe(['Fujifilm X-T5', 'XF 23mm f/1.4'])
        ->and($user->role)->toBe(0);

    Storage::disk('public')->assertExists($user->profile_picture);
});

test('username must be unique', function () {
    User::factory()->create(['username' => 'taken']);

    $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'username' => 'taken',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertSessionHasErrors('username');

    $this->assertGuest();
});
