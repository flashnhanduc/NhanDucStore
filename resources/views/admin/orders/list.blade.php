@extends('admin.main')
@section('content')
    <div class="admin-content-main-content-order-list">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Khách Hàng</th>
                    <th>Điện Thoại</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Tổng Tiền</th> <!-- Thêm cột Tổng tiền cho trực quan -->
                    <th>Ghi Chú</th>
                    <th>Ngày Đặt</th>
                    <th>Trạng Thái</th>
                    <th>Tùy Biến</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <!-- Chỉnh lại ID thành STT vì bạn đang cộng biến $key -->
                        <td>{{ $orders->firstItem() + $key }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email ?? 'Không có' }}</td>
                        
                        <!-- Cắt bớt hiển thị để bảng không bị quá dài -->
                        <td>{{ $order->address }}, {{ $order->ward ?? '' }}, {{ $order->city ?? '' }}</td>
                        
                        <td style="color: red; font-weight: bold;">{{ number_format($order->total_money) }} đ</td>
                        <td>{{ $order->note }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        
                        <!-- Xử lý Trạng thái Đơn hàng -->
                        <td>
                            @if($order->status == 0)
                                <span class="nou_confirm-order" style="color: #ff9800; font-weight: bold;">Chờ Xác Nhận</span>
                            @elseif($order->status == 1)
                                <span style="color: #2196F3; font-weight: bold;">Đang Giao</span>
                            @else
                                <span style="color: #4CAF50; font-weight: bold;">Hoàn Thành</span>
                            @endif
                        </td>
                        
                        <td>
                            <a class="edit-class" href="{{ route('admin.orders.show', $order->id) }}">Chi Tiết</a>
                            |
                            <a onclick="removeRow({{ $order->id }}, '{{ route('admin.orders.destroy', $order->id) }}')"
                               class="delete-class" style="cursor: pointer; color: red;">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4 d-flex justify-content-end">
            {{ $orders->links() }}
        </div>
    </div>
@endsection