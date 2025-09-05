<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list_order(){
        $order = Order::all();
        return view('admin.orders.list',[
            'orders' => $order
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

    $products = Products::whereIn('id', $product_id)->get();

    return view('admin.orders.detail', [
        'products' => $products,
        'order_detail' => $order_detail
    ]);
}


}
