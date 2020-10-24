<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'active/account';

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
            'phone' => ['required','unique:users'],
            'governate' => ['required','exists:governates,id'],
            'city' => ['required', 'exists:cities,id'],
            'address' => ['required', 'string'],
            'dob' => ['required'],
            'channel_to_promote_in' => ['required'],

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
        return $user =  User::create([
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'governate_id' => $data['governate'],
            'city_id' => $data['city'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'channel_to_promote_in' => $data['channel_to_promote_in'],
            'website' => $data['website'],
            'email_token' => Str::random(40),
            'phone_code'  => rand(100000,999999),
            'password' => Hash::make($data['password']),
        ]);
    
    }

    
}
