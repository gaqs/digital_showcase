<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use Usamamuneerchaudhary\Commentify\Models\Comment;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('web.sections.product.own');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Business::where('user_id', Auth::user()->id)->get();

        return view('web.sections.product.create', [
            'business' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        unset($data['_token']);

        $data['user_id'] = Auth::user()->id;
        $data['folder'] = $request->session()->get('product_folder');
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $product = Product::insertGetId($data);

        $request->session()->forget('product_folder');

        return Redirect::route('product.show', ['id' => $product])->with(['status' => 'success', 'message' => 'Negocio ingresado correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        $business = Business::find($product->business_id);
        $business_avatar = show_business_avatar($business->folder);

        $comments = Comment::select( Comment::raw('count(*) as qty_comments, avg(score) as score') )
                        ->where('commentable_type', 'App\Models\Product')
                        ->where('commentable_id', $id)
                        ->where('parent_id', null)
                        ->get();
        $avg_score = number_format(($comments[0]->score + 5) / 2, 1, '.', ''); //todos los productos parten con 5.0

        if( isset(Auth::user()->id) ){
            $saves = DB::table('user_saves')
                        ->select('save_id')
                        ->where('user_id', Auth::user()->id)
                        ->where('saveable_type', 'Product')
                        ->where('save_id', $id)
                        ->get()
                        ->toArray();
        }else{
            $saves = '';
        }

        return view('web.sections.product.show', [
            'product'       => $product,
            'business'      => $business,
            'avatar'        => $business_avatar,
            'avg_score'     => $avg_score,
            'qty_comments'  => $comments[0]->qty_comments,
            'saves'         => $saves
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['product'] = Product::find($id);
        $data['gallery'] = show_product_gallery($data['product']->folder);

        return view('web.sections.product.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] = now();

        $product::find($request->id)->update($data);

        return Redirect::route('product.edit', ['id' => $request->id])->with(['status' => 'success', 'message' => 'Producto editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $folder = $product->folder;
        if($folder){

            $rmfolder = delete_folder( public_path('uploads/products/'.$folder) );

            if($rmfolder){
                $product->delete();
                return Redirect::route('product.index')->with(['status' => 'success', 'message' => 'Producto eliminado correctamente.']);
            }else{
                return Redirect::route('product.index')->with(['status' => 'error', 'message' => 'No se logro eliminar el producto.']);
            }

        }else{
            return Redirect::route('product.index')->with(['status' => 'error', 'message' => 'No se encuentra la carpeta del producto.']);
        }


    }

    /**
     * Store a newly created gallery.
     * folder name: {business_id}_{str_random(10)}_{unixtime}
     */
    public function gallery(Request $request)
    {
        $folder = $request->folder;
        //si no hay nombre de carpeta en $folder, genera una que no exista en la DB
        if( $folder == '' || empty($folder)){
            do{
                $folder = $request->business_id.'_'.str_random(10).'_'.time();
                $db_folder = Product::where('folder', $folder)->first();
            }while($db_folder);
        }

        $request->session()->put('product_folder', $folder);

        //crea la carpeta si no existe
        $folder_path = public_path('uploads/products/' . $folder);
        if (!is_dir($folder_path)) { mkdir($folder_path, 0775, true); }

        //mueve los archivos a la carpeta
        $files = $request->file('gallery');
        if( $files ){
            foreach ($files as $file){
                $file_name = time().'_'.str_random(10) .'.'.$file->extension();
                $file->move($folder_path, $file_name);
            }
        }
    }

    public function delete_file(Request $request)
    {
        $file = public_path('uploads/products/'.$request->file);

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
