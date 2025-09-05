<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $products = Products::all();
        return view ('home',[
            'products' =>  $products 
        ]);
        
    }
     public function showHotProducts()
    {
        $products = Products::all();
        return view('parts.hotproduct', 
        ['products' => $products]);
    }

    public function show_product (Request $request){
        $product = Products::find($request -> id );
        $products = Products::latest()->limit(4)->get(); 
        return view ('product',[
            'product' => $product,
            'products' => $products
        ]);

    }
   
}
