@extends('admin.main')
@section('content')
    <div class="admin-content-main-content-order-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Ghi Chú</th>
                    <th>Chi Tiết</th>
                    <th>Ngày Đặt</th>
                    <th>Trạng Thái</th>
                    <th>Tùy Biến</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                     <tr>
                    <td>{{  $orders->firstItem() + $key }}</td>
                    <td>{{  $order -> name }}</td>
                    <td>{{  $order -> phone }}</td>
                    <td>{{  $order -> email }}</td>
                    <td>{{  $order -> address }},{{  $order -> ward }},{{  $order -> city }}</td>
                    <td>{{  $order -> note }}</td>
                    <td><a class="edit-class" href="/admin/orders/detail/{{ $order->id }}">Chi Tiết</a></td>
                    <td>{{  $order -> created_at}}</td>
                    <td><a class="nou_confirm-order" href="">Chưa Xác Nhận</a></td>
                    <td>
                        <a class="delete-class" href="">Xóa</a>
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