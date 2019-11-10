<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\JobApplication;
use \App\JobSeeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    //
    public function check(string $user_id)
    {
        $job_seeker = JobSeeker::all()->where('user_id', $user_id)->first();
        if($job_seeker === null){
            return redirect('/');
        }
    }
    public function index()
    {
        $user = Auth::user();
        self::check($user->id);
        $job_seeker = JobSeeker::all()->where('user_id', $user->id)->first();
        $apps = JobApplication::all()->where('job_seeker_id', $job_seeker->id);
        return view('job_application/index', ['apps' => $apps, 'user' => $user]);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        // seekerではないなら初期ページに戻す。
        self::check($user->id);

        $validatedData = $request->validate([
            'job_offer_id' => 'integer'
        ]);

        // すでに存在してるならそのまま飛ばす。
        $is_seeker = JobSeeker::all()->where('user_id', $user->id)->first();
        $already_app = JobApplication::all()
               ->where('job_offer_id', $request->job_offer_id)
                     ->where('job_seeker_id' , $is_seeker->id)
                     ->first();
        if($already_app !== null){
            Log::debug('already application.');
            return redirect('/job_application');
        }
        $app = new JobApplication();
        $app->job_offer_id = $request->job_offer_id;
        $app->job_seeker_id = JobSeeker::all()->where('user_id', $user->id)->first()->id;
        $app->save();

        return redirect('/job_application');
    }
    public function destroy(Request $request)
    {
        $user = Auth::user();
        self::check($user->id);
        $app = JobApplication::findOrFail($request->id);
        $app->delete();

        return redirect('/job_application');
    }
}
