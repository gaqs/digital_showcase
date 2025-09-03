<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TradeSkill;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class AdminTradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sections.trades.index');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeSkill $trade)
    {
        return view('admin.sections.trades.edit', ['trade' => TradeSkill::findOrFail($trade->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeSkill $trade)
    {
        $trade->fill($request->only([
            'trade',
            'name',
            'lastname',
            'description',
            'phone',
            'whatsapp',
            'facebook',
            'instagram',
            'x',
            'tiktok',
        ]));
        
        if($trade->isDirty()){
            $trade->save();
        }

        $folder = $request->folder;
        $filePath = public_path('uploads/trades/'.$folder);

        //galeria
        if( $request->hasFile('gallery')){
            foreach ($request->file('gallery') as $file){
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . '_' . Str::random(10) . '.' . $ext;
                $file->move( $filePath , $fileName);
            }
        }

        //avatar
        if( $request->hasFile('avatar')){
            $avatar = $request->file('avatar');

            $old_avatar = get_images_from_folder('trades',$folder,'avatar');

            if ($old_avatar != '' && $old_avatar != 'default/_avatar.jpg') {
                $avatar_path = public_path('uploads/trades/'. get_images_from_folder('trades',$folder,'avatar'));
                unlink( $avatar_path );
            }
            
            $save_path = public_path('uploads/trades/'.$folder.'/_avatar.'.$avatar->extension());

            $img = Image::read($avatar)->cover(500,500,'center');
            $img->save($save_path);
        }

        //banner
        if( $request->hasFile('banner')){
            $banner = $request->file('banner');

            $old_banner = get_images_from_folder('trades',$folder,'banner');

            if ($old_banner!= '' && $old_banner != 'default/_banner.jpg') {
                $banner_path = public_path('uploads/trades/'. get_images_from_folder('trades',$folder,'banner'));
                unlink( $banner_path );
            }
            
            $save_path = public_path('uploads/trades/'.$folder.'/_banner.'.$banner->extension());

            $img = Image::read($banner)->cover(1280,300,'center');
            $img->save($save_path);
        }
       
        return Redirect::route('admin_trade.edit', $trade)->with(['status' => 'success', 'message' => 'Oficio editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
