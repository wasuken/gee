<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\JobOffer;
use \App\JobSeeker;
use \App\Corp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class JobOfferController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $corp_if = Corp::all()->where('user_id', $user->id)->first();
        // 企業なら求職者一覧に飛ばす。
        if($corp_if !== null) return redirect('/job_seeker');

        $job_seeker_if = JobSeeker::all()->where('user_id', $user->id)->first();
        if($job_seeker_if === null) abort('500', '不整合なユーザです。');
        $offers = DB::table('job_offers');
        if($request->occupation !== null && $request->occupation !== '') {
            $offers = $offers->where('occupation', 'like', '%' . $request->occupation . '%');
        }
        if($request->work_location !== null && $request->work_location !== '') {
            $offers = $offers->where('work_location', 'like','%' . $request->work_location . '%');
        }
        if($request->keyword !== null && $request->keyword !== '') {
            $offers = $offers->where('contents', 'like', '%' . $request->keyword . '%');
        }
        return view('job_offer/index', ['offers' => $offers->get()->all(), 'user' => $user]);
    }
}
