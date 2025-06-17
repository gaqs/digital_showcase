<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sections.products.index');
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.sections.products.edit', [
            'product' => Product::findOrFail($product->id),
            'user' => User::select('id','name','lastname')->findOrFail($product->user_id),
            'business' => Business::select('id','name')->findOrFail($product->business_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->only([
            'business_id',
            'user_id',
            'categories_id',
            'name',
            'description',
            'price',
            'mercadolibre',
            'facebook',
            'yapo',
            'aliexpress',
            'other',
            'stock',
        ]));
        
        if($product->isDirty()){
            $product->save();
        }
        

        return Redirect::route('admin_product.edit', $product)->with(['status' => 'success', 'message' => 'Producto editado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
