<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['business'] = Business::where('user_id', Auth::user()->id)->get();
        return view('web.sections.business.own', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //contar la cantidad de negocios del usuario
        $data['qty_business'] = Business::where('user_id', Auth::user()->id)->count();
        return view('web.sections.business.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $id = Business::insertGetId($data);

        session()->flash('status', 'success');
        session()->flash('message', 'Negocio creado correctamente');
        // Retornar JSON para AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Negocio creado correctamente',
                'business_id' => $id
            ]);
        }

        
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['business'] = Business::find($id);
        
        $user = User::find($data['business']->user_id);

        if( $user == null ){
            $data['user'] = (object)[
                'id' => 0,
                'name' => 'John Doe',
                'email' => 'johndoe@email.com'
            ];
        }else{
            $data['user'] = $user;
        }

        $data['profile'] = UserProfile::where('user_id',$data['business']->user_id)->first();
        $data['products'] = Product::where('business_id', $id)->get();

        if( isset(Auth::user()->id) ){
            $data['saves'] = DB::table('user_saves')
                                ->select('save_id')
                                ->where('user_id', Auth::user()->id)
                                ->where('saveable_type', 'Business')
                                ->where('save_id', $id)
                                ->get()
                                ->toArray();
        }else{
            $data['saves'] = '';
        }

        return view('web.sections.business.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $query = Business::find($id);

        $data['business'] = $query;

        $data['avatar'] = get_images_from_folder('business', $id, 'avatar');
        $data['gallery'] = json_encode(get_images_from_folder('business', $id, 'gallery'));
        

        return view('web.sections.business.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $data = $request->all();

        $data['updated_at'] = now();

        $business::find($request->id)->update($data);

        session()->flash('status', 'success');
        session()->flash('message', 'Negocio editado correctamente');
        //retiornar JSON para AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Negocio editado correctamente',
                'business_id' => $request->id
            ]);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $business = Business::find($id);
        $folder = $id;
        $product = Product::where('business_id', $business->id)->first();

        if( !is_null($product) ){
            return Redirect::route('business.index')->with(['status' => 'error', 'message' => 'Debe eliminar los productos dentro del negocio antes de borrarlo.']);
        }else{

            if($folder){
                $rmfolder = delete_folder( public_path('uploads/business/'.$folder) );
                if($rmfolder){
                    $business->delete();
                    return Redirect::route('business.index')->with(['status' => 'success', 'message' => 'Negocio eliminado correctamente.']);
                }else{
                    return Redirect::route('business.index')->with(['status' => 'error', 'message' => 'No se logro eliminar el negocio.']);
                }
            }

        }

        return Redirect::route('business.index')->with(['status' => 'success', 'message' => 'Negocio eliminado correctamente.']);
    }

    
    /**
     * Store or edit Business gallery and avatar.
     */
    public function avatar(Request $request){

        $save_avatar = save_entity_image($request,'business',$request->id,'avatar');
        
        if( $save_avatar ){
            return response()->json([ 'success' => 200 ]);
        }else{
            return 'error';
        }
    }
    
    public function gallery(Request $request){

        $save_gallery = save_entity_image($request,'business',$request->id,'gallery');

        if( $save_gallery ){
            return response()->json([ 'success' => 200 ]);
        }else{
            return 'error';
        }
    }
    

    public function delete_file(Request $request)
    {
        $file = public_path('uploads/business/'.$request->file);

        if (file_exists($file)) {
            if (unlink($file)) {
                // Archivo eliminado exitosamente
                return true;
            } else {
                // Error al eliminar el archivo
                return false;
            }
        } else {
            // El archivo no existe
            return true;
        }
    }
}
