<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Auth;
use App\Models\Business;

class AdminHomeController extends Controller
{

    public function index(){
        return view('admin.auth.login');
    }

    public function show(){
        return view('admin.dashboard');
    }

    public function store(Request $request){

        dd($request->all());

        if( RateLimiter::tooManyAttempts(request()->ip(), 2)){
            $seconds = RateLimiter::availableIn(request()->ip());
            return back()->with('status', 'Demasiados intentos. Debe esperar '.$seconds.' segundos');
        }

        $data = $request->all();
        if( Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']]) ){

            RateLimiter::clear(request()->ip());
            return redirect()->route('admin.dashboard');

        }else{
            RateLimiter::hit(request()->ip(), 60);
            return back();
        }
    }

    public function destroy(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.index');
    }


}
