<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        // Lấy các danh mục cha (parent_id = 0) cùng subcategories và sản phẩm
        $categories = Category::where('parent_id', 0)
            ->where('status', 1)
            ->with(['children' => function($q) {
                $q->where('status', 1);
            }])
            ->with(['products' => function($q) {
                $q->where('is_active', 1)->take(8);
            }])
            ->get();
        
        return view('home', [
            'categories' => $categories,
        ]);
    }
    
    public function showHotProducts()
    {
        $products = Product::all();
        return view('partials.products-new', 
        ['products' => $products]);
    }

    public function show_product(Request $request) {
        $product = Product::with(['category', 'variants'])->findOrFail($request->id);
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->take(4)
            ->get();
            
        if ($relatedProducts->count() < 4) {
            $relatedProducts = Product::where('id', '!=', $product->id)
                ->where('is_active', 1)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'products' => $relatedProducts
        ]);
    }
}
