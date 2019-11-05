<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\JobOffer;
use \App\Corp;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    public function index()
    {
        $offers = JobOffer::all();
        $user = Auth::user();
        return view('job_offer/index', ['offers' => $offers, 'user' => $user]);
    }
}
