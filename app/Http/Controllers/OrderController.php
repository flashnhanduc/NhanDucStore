<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list_order(){
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.orders.list',[
            'orders' => $orders
        ]);
    }
   public function detail_order(Request $request){
    $order_detail = json_decode($request->order_detail, true);

    // Kiểm tra nếu không phải mảng thì ép thành mảng
    if (!is_array($order_detail)) {
        $order_detail = [$order_detail];
    }

    $product_id = array_keys($order_detail); // Nếu là key-value (id => quantity)
    // Hoặc nếu là mảng ID đơn giản:
    // $product_id = $order_detail;

    $products = Product::whereIn('id', $product_id)->get();

    return view('admin.orders.detail', [
        'products' => $products,
        'order_detail' => $order_detail
    ]);
}


}
