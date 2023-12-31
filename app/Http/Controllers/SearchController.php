<?php

namespace App\Http\Controllers;
use App\Models\Business;
use App\Models\Product;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Request $request)
    {
        if( $request->option == 0 ){

            $data['results'] = Business::where(function ($query) use ($request) {
                if ($request->search != '') {
                    $query->where('name', 'like', "%{$request->search}%")
                        ->orWhere('keywords', 'like', "%{$request->search}%");
                }

                if ($request->category_id != 0) {
                    $query->where('category_id', $request->category_id);
                }
            })
            ->paginate(5);

            $data['search_type'] = 'business';


            return view('web.sections.search.show', $data);

        }else if( $request->option == 1 ){
            $data['results'] = Product::join('business', 'business.id', '=', 'product.business_id')
            ->join('categories', 'categories.id', '=', 'product.category_id')
            ->select('product.*', 'business.name as b_name','business.score as b_score', 'categories.name as c_name', 'categories.tw_color as tw_bg')
            ->where(function ($query) use ($request) {
                if ($request->search != '') {
                    $query->where('product.name', 'like', "%{$request->search}%")
                        ->orWhere('product.description', 'like', "%{$request->search}%");
                }
                if ($request->category_id != 0) {
                    $query->where('product.category_id', $request->category_id);
                }
                if( $request->business_id != ''){
                    $query->where('product.business_id', $request->business_id);
                }
            })
            ->paginate(8);

            $data['search_type'] = 'product';

            return view('web.sections.search.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

}
