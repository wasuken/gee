<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\User;
use \App\JobSeeker;
use Illuminate\Support\Str;
use Helper;

class JobSeekerTest extends TestCase
{
    use RefreshDatabase;
    public function testJobSeekerCreate()
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
        $this->assertUserPair($user, $user2);
        $corp = JobSeeker::all()->where('user_id', $user->id)->first();
        $this->assertDatabaseHas('job_seekers', [
            'user_id' => $user->id
        ]);
    }
}
