@extends('admin.main')
@section('content')
    <div class="admin-content-main-content-order-list">
        
        <div class="order-info" style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px;">
            <h3>Chi tiết đơn hàng: #{{ $order->id }}</h3>
            <p><strong>Khách hàng:</strong> {{ $order->name }} | <strong>SĐT:</strong> {{ $order->phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}, {{ $order->ward }}, {{ $order->city }}</p>
            <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Phân Loại</th> 
                    <th>Giá Bán</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                    <th>Tùy Biến</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $key => $detail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><img style="width: 70px;" src="{{ asset($detail->variant->product->image) }}" alt=""></td>
                        <td>{{ $detail->variant->product->name }}</td>
                        <td>{{ $detail->variant->color }} - Size: {{ $detail->variant->size }}</td>
                        <td>{{ number_format($detail->price) }} đ</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->total) }} đ</td>
                        <td>
                            <a class="delete-class" href="#" onclick="alert('Tính năng xóa lẻ từng món trong đơn hàng đang được cập nhật!'); return false;">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                
                <tr>
                    <td style="font-weight: 700; text-align: right; padding-right: 20px;" colspan="6">TỔNG CỘNG HÓA ĐƠN:</td>
                    <td style="font-weight: 700; color: red;" colspan="2">{{ number_format($order->total_money) }} đ</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection