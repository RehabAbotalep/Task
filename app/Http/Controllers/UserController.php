<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show Phone Verification form
    public function showPhoneForm()
    {
    	return view('verifyPhone');
    }

    //Verify Email
    public function verifyUser($token)
    {
        $user = User::where('email_token',$token)->first();
      	$user->email_verified = 1;
      	$user->email_token    = null;
      	$user->save();

      	return redirect(route('phone.verify'));
    }

    //Verify Phone
    public function verifyPhone(Request $request)
    {
        $user = User::where('phone_code',$request->code)->first();
        if( !$user )
        {
        	return back()->with('status','Wrong Code');
        }
      	$user->phone_verified = 1;
      	$user->phone_code    = null;
      	if( $user->phone_verified  && $user->email_verified )
      	{
      		$user->is_verified = 1;
      	}
      	$user->save();

      	return redirect('/login');
    }

    public function activeAcount()
    {
        return view('activeAccount');
    }

   
}
