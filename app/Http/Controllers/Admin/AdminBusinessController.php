<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sections.business.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.business.show');
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
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        return view('admin.sections.business.edit', ['business' => Business::findOrFail($business->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $business->fill($request->only([
            'name',
            'categories_id',
            'keywords',
            'email',
            'email_2',
            'description',
            'phone',
            'whatsapp',
            'web',
            'facebook',
            'instagram',
            'x',
            'tiktok',
            'mercadolibre',
            'yapo',
            'aliexpress',
            'address',
            'latitude',
            'longitude',
        ]));
        
        if($business->isDirty()){
            $business->save();
        }
        
        return Redirect::route('admin_business.edit', $business)->with(['status' => 'success', 'message' => 'Negocio editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        //
    }
}
