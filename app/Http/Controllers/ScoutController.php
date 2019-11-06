<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Scout;
use \App\JobSeeker;
use \App\Corp;
use Illuminate\Support\Facades\Auth;

class ScoutController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $corp_if = Corp::all()->where('user_id', $user->id)->first();
        $job_seeker_if = JobSeeker::all()->where('user_id', $user->id)->first();
        $scouts = [];
        $view = '';
        if($corp_if !== null){
            $scouts = Scout::all()->where('corp_id', $corp_if->id);
            $view = 'scout/corp';
        }else if($job_seeker_if !== null){
            $scouts = Scout::all()->where('job_seeker_id', $job_seeker_if->id);
            $view = 'scout/job_seeker';
        }
        return view($view, ['scouts' => $scouts, 'user' => $user]);
    }
}
