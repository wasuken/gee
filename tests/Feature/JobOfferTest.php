<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\JobOffer;
use \App\Corp;
use Illuminate\Support\Str;
use Helper;

class JobOfferTest extends TestCase
{
    use RefreshDatabase;
    public function testOffer()
    {
        $pwd = Str::random(10);
        $user = Helper::user_create_etc(1, [
            'name' => 'corp',
            'email' => 'corp@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $this->post('/login', [
            'email' => $user->email,
            'password' => $pwd
        ]);
        $this->assertTrue(Auth::check());
        $title = Str::random(30);
        $occupation = Str::random(30);
        $presentation_annual_income = rand(0, 3000000);
        $work_location = Str::random(30);
        $contents = Str::random(30);
        $this->post('/job_offer', [
            'title' => $title,
            'occupation' => $occupation,
            'presentation_annual_income' => $presentation_annual_income,
            'work_location' => $work_location,
            'contents' => $contents
        ]);

        $this->get('/job_offer')
            ->assertSee($title)
            ->assertSee($occupation)
            ->assertSee(number_format($presentation_annual_income))
            ->assertSee($work_location)
            ->assertSee($contents);
        $this->assertDatabaseHas('job_offers', [
            'title' => $title,
            'occupation' => $occupation
        ]);
    }
    // 求職者ユーザで求人票を登録(失敗)
    public function testOfferFail()
    {
        $pwd = Str::random(10);
        $user = Helper::user_create_etc(0, [
            'name' => 'corp',
            'email' => 'corp@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $this->post('/login', [
            'email' => $user->email,
            'password' => $pwd
        ]);
        $this->assertTrue(Auth::check());
        $title = Str::random(30);
        $occupation = Str::random(30);
        $presentation_annual_income = rand(0, 300000000000);
        $work_location = Str::random(30);
        $contents = Str::random(30);
        $this->post('/job_offer', [
            'title' => $title,
            'occupation' => $occupation,
            'presentation_annual_income' => $presentation_annual_income,
            'work_location' => $work_location,
            'contents' => $contents
        ]);
        $this->get('/job_offer')
            ->assertDontSee($title)
            ->assertDontSee($occupation)
            ->assertDontSee($presentation_annual_income)
            ->assertDontSee($work_location)
            ->assertDontSee($contents);
        $this->assertDatabaseMissing('job_offers', [
            'title' => $title,
            'occupation' => $occupation
        ]);
    }
    public function testOfferValidationFail()
    {
        $pwd = Str::random(10);
        $user = Helper::user_create_etc(1, [
            'name' => 'corp',
            'email' => 'corp@ttaamail.com',
            'email_verified_at' => now(),
            'password' => $pwd,
            'pr' => Str::random(100),
            'remember_token' => Str::random(10),
        ]);
        $this->post('/login', [
            'email' => $user->email,
            'password' => $pwd
        ]);
        $this->assertTrue(Auth::check());
        $title = Str::random(4000);
        $occupation = Str::random(10000);
        $presentation_annual_income = rand(3000000000, 300000000000300);
        $work_location = Str::random(10000);
        $contents = Str::random(10000);
        $this->post('/job_offer', [
            'title' => $title,
            'occupation' => $occupation,
            'presentation_annual_income' => $presentation_annual_income,
            'work_location' => $work_location,
            'contents' => $contents
        ]);
        $this->get('/job_offer')
            ->assertDontSee($title);
        $this->assertDatabaseMissing('job_offers', [
            'title' => $title,
            'occupation' => $occupation
        ]);
    }
}
