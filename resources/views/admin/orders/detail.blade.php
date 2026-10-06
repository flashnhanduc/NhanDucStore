<div class="admin-content-main-content-order-list">
    <!-- Phần thông tin khách hàng -->
    <h3>Đơn hàng: #{{ $order->id }} - Khách hàng: {{ $order->name }}</h3>
    <p>Điện thoại: {{ $order->phone }} | Địa chỉ: {{ $order->address }}</p>

    <!-- Phần bảng sản phẩm -->
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Phân Loại (Màu/Size)</th>
                <th>Giá Bán</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            <!-- Lặp qua các chi tiết của hóa đơn này -->
            @foreach ($order->details as $key => $detail)
            <tr>
                <td>{{ $key + 1 }}</td>
                <!-- Gọi xuyên qua biến thể để lấy tên sản phẩm gốc -->
                <td>{{ $detail->variant->product->name }}</td>
                <!-- Lấy màu và size trực tiếp từ biến thể -->
                <td>{{ $detail->variant->color }} - {{ $detail->variant->size }}</td>
                <td>{{ number_format($detail->price) }} đ</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->total) }} đ</td>
            </tr>
            @endforeach
            
            <!-- Hiển thị tổng tiền -->
            <tr>
                <td colspan="5" style="text-align: right; font-weight: bold;">TỔNG CỘNG HÓA ĐƠN:</td>
                <td style="font-weight: bold; color: red;">{{ number_format($order->total_money) }} đ</td>
            </tr>
        </tbody>
    </table>
</div>