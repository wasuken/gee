<?php

namespace Tests\Unit;

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
    public function testCreateSeederUser()
    {
        $user = Helper::user_create_etc(0, [
            'name' => 'test',
            'email' => 'test@ttaamail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $user2 = User::find(1);
        self::assertUserPair($user, $user2);
    }
    public function testCreateCorpUser()
    {
        $user = Helper::user_create_etc(1, [
            'name' => 'test',
            'email' => 'test@ttaamail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);

        $user2 = User::find(1);
        self::assertUserPair($user, $user2);
    }
    public function assertUserPair(User $a, User $b)
    {
        $this->assertSame($a->name,  $b->name);
        $this->assertSame($a->email, $b->email);
        $this->assertSame($a->password, $b->password);
        $this->assertSame($a->pr, $b->pr);
    }
}
