<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Nhớ use Model Order

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index() {
        // Lấy danh sách, sắp xếp mới nhất lên đầu, phân trang 10 dòng
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        
        return view('admin.orders.list', [
            'orders' => $orders
        ]);
    }

    // Xem chi tiết hóa đơn
    public function detail($id) {
        $order = Order::with('details.variant.product')->findOrFail($id);

        return view('admin.orders.detail', [
            'order' => $order
        ]);
    }
}
