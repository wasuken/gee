<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Scout;
use \App\JobSeeker;
use \App\Corp;
use Illuminate\Support\Facades\Auth;

class ScoutController extends Controller
{
    public function check(string $user_id)
    {
        $corp_if = Corp::all()->where('user_id', $user_id)->first();
        $seeker_if = JobSeeker::all()->where('user_id', $user_id)->first();
        if($corp_if === null && $job_seeker_if === null) abort('500', '不整合なユーザです。');
        if($corp_if === null) return redirect('/');
    }
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
    public function store(Request $request)
    {
        $user = Auth::user();
        self::check($user->id);

        $validatedData = $request->validate([
            'contents' => 'required|string|between:0,3000'
        ]);

        $corp = Corp::all()->where('user_id', $user->id)->first();
        $scout = Scout::create([
            'job_seeker_id' => $request->job_seeker_id,
            'corp_id' => $corp->id,
            'contents' => $request->contents
        ]);
        return redirect('/scout');
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        self::check($user->id);
        return view('scout/create', ['user' => $user, 'job_seeker_id' => $request->job_seeker_id]);
    }
}
