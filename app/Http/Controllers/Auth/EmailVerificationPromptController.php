<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        /* created by gus
        if( $request->user()->hasVerifiedEmail() ){
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            //Auth::guard('web')->logout();
            return view('web.sections.auth.verify-email');
        }
        */

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('web.sections.auth.verify-email');



    }
}
