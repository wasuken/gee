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
    public function if_corp_redirect(string $user_id)
    {
        $corp_if = Corp::all()->where('user_id', $user_id)->first();
        // 企業なら求職者一覧に飛ばす。
        if($corp_if !== null) return redirect('/job_seeker');
    }
    public function if_job_offer_redirect(string $user_id)
    {
        $job_offer_if = JobOffer::all()->where('user_id', $user_id)->first();
        if($job_offer_if !== null) return redirect('/');
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        self::if_corp_redirect($user->id);

        $corp_if = Corp::all()->where('user_id', $user->id)->first();

        $job_seeker_if = JobSeeker::all()->where('user_id', $user->id)->first();
        if($corp_if === null && $job_seeker_if === null) abort('500', '不整合なユーザです。');
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
    public function store(Request $request)
    {
        $user = Auth::user();
        self::if_corp_redirect($user->id);

        $offer = new JobOffer();
        $offer->corp_id = Corp::all()->where('user_id', $user->id)->first()->id;
        $offer->title = $request->title;
        $offer->presentation_annual_income = $request->presentation_annual_income;
        $offer->work_location = $request->work_location;
        $offer->occupation = $request->occupation;
        $offer->contents = $request->contents;
        $offer->save();
        return redirect('/job_offer');
    }
    public function create()
    {
        $user = Auth::user();
        self::if_job_offer_redirect($user->id);
        return view('job_offer/create', ['user' => $user]);
    }
}
