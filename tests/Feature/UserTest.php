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
    public function testCreateLoginSeeker()
    {
        $pwd = Str::random(10);
        $name = 'aaaaa';
        $email = 'aaaaa@test.com';
        $pr = Str::random(100);
        $password = $pwd;
        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'pr' => $pr,
            'password' => $pwd,
            'password_confirm' => $pwd,
            'user_type' => '0'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'pr' => $pr
        ]);
        $response->assertRedirect('/');
        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password
        ]);
        $user = User::all()->where('email', $email)->first();
        $this->assertDatabaseHas('job_seekers', [
            'user_id' => $user->id
        ]);
        $this->assertTrue(Auth::check());
    }
    public function testCreateLoginCorp()
    {
        $pwd = Str::random(10);
        $name = 'aaaaa';
        $email = 'aaaaa@test.com';
        $pr = Str::random(100);
        $password = $pwd;
        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'pr' => $pr,
            'password' => $pwd,
            'password_confirm' => $pwd,
            'user_type' => '1',
        ]);
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'pr' => $pr
        ]);
        $user = User::where('email', $email)->first();
        $this->assertDatabaseHas('corps', [
            'user_id' => $user->id
        ]);
        $response->assertRedirect('/');
        $response = $this->post('/login', [
            'email' => $email,
            'password' => $password
        ]);
        $user = User::all()->where('email', $email)->first();
        $this->assertDatabaseHas('corps', [
            'user_id' => $user->id
        ]);
        $this->assertTrue(Auth::check());
    }
}
