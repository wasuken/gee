<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\JobSeeker;
use App\Corp;
use Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pr' => ['required', 'string', 'min:2'],
            'user-type' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Log::debug($data);
        $user = Helper::user_create_etc(intval($data['user-type']),$data);
        return $user;
    }
    protected function register(Request $request)
    {
        Log::debug($request);
        // NULLなら0(求職者)にする。
        $user_type = is_null($request->user_type)? 0 : intval($request->user_type);
        Log::debug($user_type);
        $user = Helper::user_create_etc($user_type, [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirm' => $request->password_confirm,
            'pr' => $request->pr,
        ]);
        return redirect('/');
    }
}
