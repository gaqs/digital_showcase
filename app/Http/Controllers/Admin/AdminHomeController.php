<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class AdminHomeController extends Controller
{

    public function index()
    {
        if (Gate::denies('access-admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.dashboard');
    }

    public function show()
    {
        if (Gate::denies('access-admin')) {
            abort(403, 'Unauthorized action.');
        }

        //
    }

    public function store(Request $request){

        //
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


}
