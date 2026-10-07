<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 


class OrderController extends Controller
{
   public function index() {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        $title = 'Danh Sách Đơn Hàng';
        
        return view('admin.orders.list', compact('title', 'orders'));
    }

    public function show($id) {
        $order = Order::with('details.variant.product')->findOrFail($id);
        $title = 'Chi Tiết Đơn Hàng ' . $order->id;

        return view('admin.orders.detail', compact('title', 'order'));
    }

    public function destroy($id) {
        $order = Order::find($id);
        if ($order) {
            $order->details()->delete(); 
            $order->delete();
            
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
