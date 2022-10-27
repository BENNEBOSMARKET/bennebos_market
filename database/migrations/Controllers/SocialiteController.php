<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    // Google login
    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function googleAuthCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);
        return redirect()->route('customer.home');
    }

    // facebook login
    public function facebookAuth()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // facebook callback
    public function facebookAuthCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user);
        return redirect()->route('customer.home');
    }

    // twitter login
    public function twitterAuth()
    {
        return Socialite::driver('twitter')->redirect();
    }

    // twitter callback
    public function twitterAuthCallback()
    {
        $user = Socialite::driver('twitter')->user();

        $this->_registerOrLoginUser($user);
        return redirect()->route('customer.home');
    }


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make(uniqid());
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }
}
