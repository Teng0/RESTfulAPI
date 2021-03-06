<?php

namespace App\Http\Controllers\Seller;


use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $seller = Seller::has('products')->get();

        return response()->json(['data'=>$seller],200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        return response()->json(['data'=>$seller],200);
    }

}
