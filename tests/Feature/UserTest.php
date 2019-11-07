<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use \App\User;
use Illuminate\Support\Str;
use Helper;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private $pwd = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
    public function testCreateSeederUser()
    {
        $user = Helper::user_create_etc(0, [
            'name' => 'test',
            'email' => 'test@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $this->pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => $this->pwd,
        ]);
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/');
    }
    public function testCreateCorpUser()
    {
        $user = Helper::user_create_etc(1, [
            'name' => 'test',
            'email' => 'test@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $this->pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => $this->pwd,
        ]);
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/');
    }
}
