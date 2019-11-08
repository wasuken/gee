<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\User;
use \App\Corp;
use Illuminate\Support\Str;
use Helper;

class CorpTest extends TestCase
{
    use RefreshDatabase;
    public function testCorpCreate()
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
        $this->assertUserPair($user, $user2);
        $corp = Corp::all()->where('user_id', $user->id)->first();
        $this->assertDatabaseHas('corps', [
            'user_id' => $user->id
        ]);
    }
}
