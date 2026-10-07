<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
   // GET: admin.products.index
    public function index() {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(7);
        $title = 'Danh Sách Sản Phẩm';
        
        return view('admin.product.list', compact('title', 'products'));
    }

    // GET: admin.products.create
    public function create() {
        $categories = Category::all();
        $title = 'Thêm Sản Phẩm';
        
        return view('admin.product.add', compact('title', 'categories'));
    }

    // POST: admin.products.store
    public function store(Request $request) {
        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name') . '-' . Str::random(5));
        $product->price = $request->input('price');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        
        if ($request->has('images') && is_array($request->input('images'))) {
            $product->image = implode('#', $request->input('images'));
        } else {
            $product->image = $request->input('image');
        }

        $product->save();
        
        // Chuyển hướng bằng route name chuẩn
        return redirect()->route('admin.products.index')->with('success', 'Thêm thành công!');
    }

    // GET: admin.products.edit
    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $title = 'Sửa Sản Phẩm';
        
        return view('admin.product.edit', compact('title', 'product', 'categories'));
    }

    // POST: admin.products.update
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name') . '-' . Str::random(5));
        $product->price = $request->input('price');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
        
        $product->save();
        
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    // POST: admin.products.destroy (Dùng cho AJAX)
    public function destroy(Request $request) {
        $product = Product::find($request->product_id);
        if ($product) {
            $product->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
