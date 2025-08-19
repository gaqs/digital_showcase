<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function index(Request $request): View
    {
        return view('web.sections.profile.home', [
            'user' => $request->user(),
            'profile' => UserProfile::where('user_id', $request->user()->id)->first(),
        ]);
    }

    public function show(Request $request)
    {
        $data['user'] = User::find($request->id);
        $data['profile'] = UserProfile::where('user_id', $request->id)->first();
        $data['business'] = Business::where('user_id',$request->id)->get();
        
        return view('web.sections.profile.show', $data);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('web.sections.profile.edit', [
            'user' => $request->user(),
            'profile' => UserProfile::where('user_id', $request->user()->id)->first(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        //$request->user()->fill($request->validated());
        $user = $request->user();
        $user->fill($request->only(['name','lastname','email']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        //Guardar la información del perfil
        $user_profile = UserProfile::where('user_id', $request->user()->id)->first();

        $user_profile->fill($request->only(['phone','address','description','facebook','instagram','x','tiktok']));
        $user_profile->save();

        return Redirect::route('profile.edit')->with(['status' => 'success', 'message' => 'Usuario editado correctamente']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function avatar(Request $request)
    {      
        $id = Auth::user()->id;
        $aux = save_entity_image($request, 'users', $id, 'avatar'); //guarda el avatar del usuario en una carpeta con el id del usuario
        return $aux;
    }

    public function banner(Request $request)
    {
        $id = Auth::user()->id;
        $aux = save_entity_image($request, 'users', $id, 'banner'); //guarda el avatar del usuario en una carpeta con el id del usuario
        return $aux;
    }

    public function save(Request $request)
    {
        DB::table('user_saves')->insert([
            'user_id' => Auth::user()->id,
            'saveable_type' => $request->type,
            'save_id' => $request->id,
            'created_at' => date('y-m-d H:i:s')
        ]);

        return true;
    }

    public function delete_save(Request $request)
    {
        DB::table('user_saves')
            ->where('user_id', Auth::user()->id)
            ->where('save_id', $request->id)
            ->where('saveable_type', $request->type)
            ->delete();

        if( $request->link == 'true' ){
            return redirect()->back();
        }

        return true;

    }

    public function saved(Request $request): View
    {
        $business = DB::table('business')
                        ->select('user_saves.id as insert_id', 'business.id', 'business.name', 'business.description', 'business.folder', 'user_saves.saveable_type', 'user_saves.user_id', 'user_saves.save_id')
                        ->join('user_saves', 'business.id', '=', 'user_saves.save_id')
                        ->where('user_saves.saveable_type', 'Business')
                        ->where('user_saves.user_id', Auth::user()->id);


        $data['results'] = DB::table('product')
                        ->select('user_saves.id as insert_id', 'product.id', 'product.name', 'product.description', 'product.folder', 'user_saves.saveable_type', 'user_saves.user_id', 'user_saves.save_id' )
                        ->join('user_saves', 'product.id', '=', 'user_saves.save_id')
                        ->where('user_saves.saveable_type', 'Product')
                        ->where('user_saves.user_id', Auth::user()->id)
                        ->union($business)
                        ->orderBy('insert_id', 'ASC')
                        ->paginate(8);

        return view('web.sections.profile.saved', $data);
    }

}
