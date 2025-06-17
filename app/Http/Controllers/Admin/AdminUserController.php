<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sections.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['profile'] = UserProfile::where('user_id', $user->id)->first();

        return view('admin.sections.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        //informacion de la tabla user
        $user->fill($request->only(['name', 'lastname', 'role']));
        $user->save();

        //informacion de la tabla user_profile
        $profile = UserProfile::where('user_id', $user->id)->first();
        $profile->fill($request->only(['user_id','phone','address','description','facebook','instagram','x','tiktok']));
        $profile->save();

        return Redirect::route('admin_users.edit', $user)->with(['status' => 'success', 'message' => 'Usuario editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function avatar(User $user)
    {
        //
    }

    public function banner(User $user)
    {
        //
    }
}
