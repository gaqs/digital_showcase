<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\TradeSkill;


class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['trades'] = TradeSkill::where('user_id', Auth::user()->id)->get();
        return view('web.sections.trade.own', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['trade_skill'] = [];
        return view('web.sections.trade.create', $data);
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

        $id = TradeSkill::insertGetId($data);

        // Retornar JSON para AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Oficio tradicional ingresado correctamente',
                'business_id' => $id
            ]);
        }

        $request->session->put(['status' => 'success', 'message' => 'Oficio tradicional creado correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['trade_skill'] = TradeSkill::find($id);
        return view('web.sections.trade.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $query = TradeSkill::find($id);

        $data['trade_skill'] = $query;

        $data['avatar'] = get_images_from_folder('trades', $id, 'avatar');
        $data['banner'] = get_images_from_folder('trades', $id, 'banner');
        $data['gallery'] = json_encode(get_images_from_folder('trades', $id, 'gallery'));
        
        return view('web.sections.trade.create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function avatar(Request $request)
    {
        $save_avatar = save_entity_image($request,'trades',$request->id,'avatar');
        
        if( $save_avatar ){
            return response()->json([ 'success' => 200 ]);
        }else{
            return 'error';
        }
    }

    /**
     * Handle gallery upload.
     */
    public function gallery(Request $request)
    {
        $save_gallery = save_entity_image($request,'trades',$request->id,'gallery');

        if( $save_gallery ){
            return response()->json([ 'success' => 200 ]);
        }else{
            return 'error';
        }
    }   

    /**
     * Handle banner upload.
     */
    public function banner(Request $request)
    {
        $save_avatar = save_entity_image($request,'trades',$request->id,'banner');
        
        if( $save_avatar ){
            return response()->json([ 'success' => 200 ]);
        }else{
            return 'error';
        }
    }
    
    /**
     * Handle file deletion.
     */
    public function delete_file(Request $request)
    {
        $file = public_path('uploads/trades/'.$request->file);

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
