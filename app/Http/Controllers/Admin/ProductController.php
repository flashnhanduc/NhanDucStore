<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add_product (){
        return view('admin.product.add',[
            'title'=>'Thêm Sản Phẩm'
        ]);
    }
     public function list_product (){
        $product = DB::table('products') -> paginate(10);
        return view('admin.product.list',[
            'title'=>'Danh Sách Sản Phẩm',
            'products' => $product,
        ]);
    }
    public function insert_product (Request $request){
        $products = new Products();
        $products -> name = $request -> input('name');
        $products -> material = $request -> input('material');
        $products -> price_normal = $request -> input('price_normal');
        $products -> price_sale = $request -> input('price_sale');
        $products -> description = $request -> input('description');
        $products -> content = $request -> input('content');
        $products -> image = $request -> input('image');
        $product_images = implode( '#',$request -> input('images'));
        $products -> images = $product_images;
        $products -> save();
        return redirect() ->back();

    }
    public function delete_product (Request $request){
       Products::find($request ->product_id) -> delete() ;
       return response()->json([
       'success' => true
       
        ]);

    } 
    public function edit_product ( Request $request){
        $product = Products::find($request -> id);
        return view('admin.product.edit',[
            'title'=> 'Tên Sản Phẩm',
            'product' => $product
        ]);
    }
    public function update_product (Request $request) {
        $products = products::find($request -> id);
        $products -> name = $request -> input('name');
        $products -> material = $request -> input('material');
        $products -> price_normal = $request -> input('price_normal');
        $products -> price_sale = $request -> input('price_sale');
        $products -> description = $request -> input('description');
        $products -> content = $request -> input('content');
        $products -> image = $request -> input('image');
        $product_images = implode( '#',$request -> input('images'));
        $products -> images = $product_images;
        $products -> save();
        return redirect('/admin/product/list') ;
    }
}
