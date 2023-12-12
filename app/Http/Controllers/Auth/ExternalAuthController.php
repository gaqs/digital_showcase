<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class ExternalAuthController extends Controller
{
    //
    public function google_login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $user = Socialite::driver('google')->user();
        $userExist = User::where('ext_id', $user->id)->where('ext_auth','google')->first();

        if($userExist){
            Auth::login($userExist);
        }else{
            $newUser = User::create([
                        'name'      => $user->name,
                        'email'     => $user->email,
                        'avatar'    => $user->avatar,
                        'ext_id'    => $user->id,
                        'ext_auth'  => 'google'
                    ]);
             Auth::login($newUser);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function facebook_login()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback()
    {
        $user = Socialite::driver('facebook')->user();
        $userExist = User::where('ext_id', $user->id)->where('ext_auth','facebook')->first();

        if($userExist){
            Auth::login($userExist);
        }else{
            $newUser = User::create([
                        'name'      => $user->name,
                        'email'     => $user->email,
                        'avatar'    => $user->avatar,
                        'ext_id'    => $user->id,
                        'ext_auth'  => 'facebook'
                    ]);
             Auth::login($newUser);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
