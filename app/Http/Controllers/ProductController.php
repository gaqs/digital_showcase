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
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $id = Product::insertGetId($data);

        // Retornar JSON para AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto ingresado correctamente',
                'business_id' => $id
            ]);
        }

        $request->session->put(['status' => 'success', 'message' => 'Producto creado correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        $business = Business::find($product->business_id);
        $business_avatar = get_images_from_folder('business',$business->folder,'avatar');

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
        $data['gallery'] = json_encode(get_images_from_folder('products',$id,'gallery'));

        return view('web.sections.product.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $data['updated_at'] = now();

        $product::find($request->id)->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto editado correctamente',
                'business_id' => $request->id
            ]);
        }

        $request->session->put(['status' => 'success', 'message' => 'Producto editado correctamente']);
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

    public function gallery(Request $request){

        $save_gallery = save_entity_image($request,'products',$request->id,'gallery');

        if( $save_gallery ){
            return response()->json([ 'success' => 200 ]);
        }else{
            return 'error';
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
