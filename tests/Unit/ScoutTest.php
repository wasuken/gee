<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Helper;
use \App\Scout;
use \App\JobSeeker;
use \App\Corp;

class ScoutTest extends TestCase
{
    use RefreshDatabase;
    public function testCreateScout()
    {
        $user_seeker = Helper::user_create_etc(0, [
            'name' => 'test',
            'email' => 'test@ttaamail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $user_corp = Helper::user_create_etc(1, [
            'name' => 'corp',
            'email' => 'corp@ttaamail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $scout = Scout::create([
            'corp_id' => Corp::where('user_id', $user_corp->id)->first()->id,
            'job_seeker_id' => JobSeeker::where('user_id', $user_seeker->id)->first()->id,
            'contents' => Str::random(100)
        ]);
        $this->assertDatabaseHas('scouts', [
            'corp_id' => Corp::where('user_id', $user_corp->id)->first()->id,
            'job_seeker_id' => JobSeeker::where('user_id', $user_seeker->id)->first()->id
        ]);
    }
}
