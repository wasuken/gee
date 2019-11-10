<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\JobOffer;
use \App\JobSeeker;
use \App\Corp;
use Illuminate\Support\Str;
use Helper;

class ScoutTest extends TestCase
{
    use RefreshDatabase;
    public function testCreateScout()
    {
        $pwd = Str::random(10);
        $user_corp = Helper::user_create_etc(1, [
            'name' => 'corp',
            'email' => 'corp@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $user_seeker = Helper::user_create_etc(0, [
            'name' => 'seeker',
            'email' => 'seeker@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $this->post('/login', [
            'email' => $user_corp->email,
            'password' => $pwd
        ]);
        $this->assertTrue(Auth::check());
        $contents = Str::random(100);
        $this->post('/scout', [
            'job_seeker_id' => JobSeeker::where('user_id', $user_seeker->id)->first()->id,
            'contents' => $contents,
        ]);
        $this->get('/scout')
            ->assertSee($contents);
    }
}
