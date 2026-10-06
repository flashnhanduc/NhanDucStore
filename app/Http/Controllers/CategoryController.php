<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $products = Product::all();
        return view ('home',[
            'products' =>  $products 
        ]);
        
    }
     public function showHotProducts()
    {
        $products = Product::all();
        return view('parts.hotproduct', 
        ['products' => $products]);
    }

    public function show_product (Request $request){
        $product = Product::find($request -> id );
        $products = Product::latest()->limit(4)->get(); 
        return view ('product',[
            'product' => $product,
            'products' => $products
        ]);

    }
   
}
