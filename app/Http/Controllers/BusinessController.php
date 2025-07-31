<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProfile;

use Usamamuneerchaudhary\Commentify\Models\Comment;
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
        return view('web.sections.business.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        $data['user_id'] = Auth::user()->id;
        $data['folder'] = $request->session()->get('business_folder');
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $business = Business::insertGetId($data);

        $request->session()->forget('business_folder');

        return Redirect::route('business.show', ['id' => $business])->with(['status' => 'success', 'message' => 'Negocio ingresado correctamente']);

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['business'] = Business::find($id);
        $data['user'] = User::find($data['business']->user_id);
        $data['profile'] = UserProfile::where('user_id',$data['business']->user_id)->first();
        $data['products'] = Product::where('business_id', $id)->get();

        $data['avatar'] = show_business_avatar($data['business']->folder);
        $data['gallery'] = show_business_gallery($data['business']->folder);

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

        $data['avatar'] = ($query->folder == 'default') ? null : show_business_avatar($query->folder);
        $data['gallery'] = ($query->folder == 'default') ? null : show_business_gallery($query->folder);

        return view('web.sections.business.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $data = $request->all();

        if($request->session()->has('business_folder')){
            $data['folder'] = $request->session()->get('business_folder');
        }
        $data['updated_at'] = now();

        $business::find($request->id)->update($data);

        return Redirect::route('business.edit', ['id' => $request->id])->with(['status' => 'success', 'message' => 'Negocio editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $business = Business::find($id);
        $folder = $business->folder;
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

    public function avatar(Request $request){

        $folder = $request->folder;

        //si no hay nombre de carpeta en $folder, genera una que no exista en la DB
        if( $folder == '' || empty($folder)){
            do{
                $folder = str_random(10).'_'.time();
                $db_folder = Business::where('folder', $folder)->first();
            }while($db_folder);
        }

        $request->session()->put('business_folder', $folder);

        //crea la carpeta si no existe
        $folder_path = public_path('uploads/business/' . $folder);
        if (!is_dir($folder_path)) { mkdir($folder_path, 0775, true); }

        if ($request->hasFile('profile')) {
            $file_name = '_avatar.'.$request->file('profile')->extension();
            $request->file('profile')->move( $folder_path, $file_name);
        }

        return response()->json([ 'success' => 200 ]);

    }
    
    public function gallery(Request $request){
        $folder = ($request->folder == 'default' || $request->folder == null ) ? $request->session()->get('business_folder') : $request->folder;

        $files = $request->file('gallery');
        foreach ($files as $file){
            $fileName = str_random(10).'_'.time().'.'.$file->extension();
            $file->move(public_path('uploads/business/'.$folder), $fileName);
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
