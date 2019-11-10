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
    public function testLogin()
    {
        $pwd = Str::random(10);
        $user = new User();
        $user->name = 'aaaaa';
        $user->email = 'aaaaa@test.com';
        $user->pr = Str::random(100);
        $user->password = $pwd;
        $user->password_confirm = $pwd;
        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'pr' => $user->pr,
            'password' => $pwd,
            'password_confirm' => $pwd,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'pr' => $user->pr
        ]);
        $response->assertRedirect('/');
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password
        ]);
        $this->assertTrue(Auth::check());
    }
}
