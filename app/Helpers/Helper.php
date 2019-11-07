<?php

namespace App\Helpers;
use App\User;
use App\JobSeeker;
use App\Corp;
use Illuminate\Support\Facades\Hash;

class Helper
{
    // ユーザの作成とcorpsもしくはjob_seekersへの登録。
    public static function user_create_etc(int $user_type, array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pr' => $data['pr'],
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
