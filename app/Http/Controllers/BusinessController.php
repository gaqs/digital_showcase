<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
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
        $data['products'] = Product::where('business_id', $id)->get();

        $data['avatar'] = show_business_avatar($data['business']->folder);
        $data['gallery'] = show_business_gallery($data['business']->folder);

        $comments = Comment::select( Comment::raw('count(*) as qty_comments, avg(score) as score') )
                        ->where('commentable_type', 'App\Models\Business')
                        ->where('commentable_id', $id)
                        ->where('parent_id', null)
                        ->get();
        $data['qty_comments'] = $comments[0]->qty_comments;
        $data['avg_score'] = number_format(($comments[0]->score + 5) / 2, 1, '.', ''); //todos los productos parten con 5.0

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

        $business::find($request->id)->update($data);

        return Redirect::route('business.edit', ['id' => $request->id])->with(['status' => 'success', 'message' => 'Negocio editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $business = Business::find($id);
        $business->delete();

        return Redirect::route('business.index')->with(['status' => 'success', 'message' => 'Negocio eliminado correctamente.']);
    }

    public function avatar(Request $request){

        $folder = $request->folder;
        if( $folder == 'default' || $folder == null){
            $folder = Str::random(10);
            $db_folder = Business::where('folder', $folder)->first();

            while( !empty($db_folder->folder) ){
                $folder = Str::random(10);
                $db_folder = Business::where('folder', $folder)->first();
            }
        }
        $request->session()->put('business_folder', $folder);

        if ($request->hasFile('profile')) {
            $fileName = '_avatar.'.$request->file('profile')->extension();
            $request->file('profile')->move(public_path('uploads/business/'.$folder), $fileName);
        }

        return response()->json([ 'success' => 200 ]);

    }
    public function gallery(Request $request){
        $folder = ($request->folder == 'default' || $request->folder == null ) ? $request->session()->get('business_folder') : $request->folder;

        $files = $request->file('gallery');
        foreach ($files as $file){
            $fileName = Str::random(10)  .'.'.$file->extension();
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
