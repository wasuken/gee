<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\User;
use \App\JobApplication;
use \App\JobSeeker;
use \App\JobOffer;
use \App\Corp;
use Illuminate\Support\Str;
use Helper;

class JobApplicationTest extends TestCase
{
    use RefreshDatabase;
    // 求職者からの求人申し込み
    public function testCreateApplicationFromJobSeeker()
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
        $offer = JobOffer::create([
            'corp_id' => Corp::where('user_id', $user_corp->id)->first()->id,
            'title' => Str::random(10),
            'presentation_annual_income' => rand(0,100000000),
            'work_location' => Str::random(10),
            'occupation' => Str::random(10),
            'contents' => Str::random(100)
        ]);
        $seeker_id = JobSeeker::where('user_id', $user_seeker->id)->first()->id;

        $app = JobApplication::create([
            'job_offer_id' => $offer->id,
            'job_seeker_id' => $seeker_id,
        ]);
        $this->assertDatabaseHas('job_applications', [
            'job_offer_id' => $offer->id,
            'job_seeker_id' => $seeker_id,
        ]);
    }
}
