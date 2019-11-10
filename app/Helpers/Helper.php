<?php

namespace App\Helpers;
use App\User;
use App\JobSeeker;
use App\Corp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Helper
{
    // ユーザの作成とcorpsもしくはjob_seekersへの登録。
    // $user_type = 0 -> 求職者
    // $user_type = 1 -> 企業
    public static function user_create_etc(int $user_type, array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pr' => $data['pr'],
            'email_verified_at' => isset($data['email_verified_at'])? $data['email_verified_at'] : now(),
            'remember_token' => isset($data['remember_token'])?$data['remember_token'] : Str::random(10),
        ]);
        if($user_type === 0){
            JobSeeker::create([
                'user_id' => $user->id
            ]);
        }else if($user_type === 1){
            Corp::create([
                'user_id' => $user->id
            ]);
        }
        return $user;
    }
}
