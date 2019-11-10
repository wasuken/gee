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

class JobApplicationTest extends TestCase
{
    use RefreshDatabase;
    public function testCreateApplication()
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
            'email' => $user_seeker->email,
            'password' => $pwd
        ]);
        $this->assertTrue(Auth::check());
        $title = Str::random(30);
        $occupation = Str::random(30);
        $presentation_annual_income = rand(0, 300000000000);
        $work_location = Str::random(30);
        $contents = Str::random(30);
        $offer = JobOffer::create([
            'corp_id' => Corp::all()->where('user_id', $user_corp->id)->first()->id,
            'title' => $title,
            'occupation' => $occupation,
            'presentation_annual_income' => $presentation_annual_income,
            'work_location' => $work_location,
            'contents' => $contents,
        ]);
        $response = $this->post('/job_application', [
            'job_offer_id' => $offer->id,
        ]);
        $this->assertDatabaseHas('job_applications', [
            'job_offer_id' => $offer->id,
            'job_seeker_id' => JobSeeker::all()->where('user_id', $user_seeker->id)->first()->id,
        ]);
    }
    public function testCreateApplicationFail()
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
        $title = Str::random(30);
        $occupation = Str::random(30);
        $presentation_annual_income = rand(0, 300000000000);
        $work_location = Str::random(30);
        $contents = Str::random(30);
        $offer = JobOffer::create([
            'corp_id' => Corp::all()->where('user_id', $user_corp->id)->first()->id,
            'title' => $title,
            'occupation' => $occupation,
            'presentation_annual_income' => $presentation_annual_income,
            'work_location' => $work_location,
            'contents' => $contents,
        ]);
        $response = $this->post('/job_application', [
            'job_offer_id' => $offer->id,
        ]);
        $this->assertDatabaseMissing('job_applications', [
            'job_offer_id' => $offer->id,
            'job_seeker_id' => JobSeeker::all()->where('user_id', $user_seeker->id)->first()->id,
        ]);
    }
}
