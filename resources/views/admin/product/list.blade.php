@extends('admin.main')
@section('content')
    <div class="admin-content-main-content-product-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh Mục</th> 
                    <th>Giá Bán</th>
                    <th>Giá Giảm</th>
                    <th>Ngày Đăng</th>
                    <th>Tùy Chỉnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $products->firstItem() + $key }}</td>
                        <td><img style="width: 70px;" src="{{ asset($product->image) }}" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'Trống' }}</td>
                        <td>{{ number_format($product->price) }} đ</td>
                        <td>{{ number_format($product->price_sale) }} đ</td>
                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="edit-class">Sửa</a>
                            |
                            <a onclick="removeRow({{ $product->id }}, '{{ route('admin.products.destroy', $product->id) }}')" 
                               class="delete-class" >Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
@endsection