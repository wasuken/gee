<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \App\JobSeeker;
use \App\Corp;

class JobSeekerController extends Controller
{
    //
    public function check(string $user_id)
    {
        $corp = Corp::all()->where('user_id', $user_id)->first();
        if($corp === null){
            return redirect('/');
        }
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        self::check($user->id);

        $seeker_users = DB::table('users')->whereIn('id', DB::table('job_seekers')->pluck('user_id')->all());
        if($request->user_name !== null){
            $seeker_users = $seeker_users->where('name', 'like', '%' . $request->user_name . '%');
        }
        if($request->keyword !== null){
            $seeker_users = $seeker_users->where('pr', 'like', '%' . $request->keyword . '%');
        }

        return view('job_seeker/index', ['seeker_users' => $seeker_users->get()->all(), 'user' => $user]);
    }
}
