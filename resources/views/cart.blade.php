@extends('main')
@section('content')
    <section class="cart-section p-to-top">
        <form action="/cart/send" method="post">
            <div class="container">
                <div class="row-flex row-flex-product-detail">
                    <p>Giỏ Hàng</p>
                </div>
                <div class="row-grid">
                    <div class="cart-section-left">
                        <h2 class="main-h2">Chi Tiết Đơn Hàng</h2>
                        <div class="cart-section-left-detail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Sản Phẩm</th>
                                        <th>Thành Tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($products as $product)
                                        @php
                                            $price = $product->price_sale * Session::get('cart')[$product->id];
                                            $total += $price;
                                        @endphp
                                        <tr>
                                            <td><img style="width: 70px;" src="{{ asset($product->image) }}" alt=""></td>
                                            <td>
                                                <div class="product-detail-right-infor">
                                                    <h1>{{  $product->name }}</h1>
                                                    <div class="hot-product-item-price">
                                                        <p>{{ number_format($product->price_sale) }}<sup>đ</sup>
                                                            <span>{{ number_format($product->price_normal) }}<sup>đ</sup>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="product-detail-right-quantity-input">
                                                    <i class="ri-subtract-line"></i>
                                                    <input onkeydown=" return false" class="quantity-input"
                                                        name="product_id[{{ $product->id }}]" type="number"
                                                        value="{{ Session::get('cart')[$product->id] }}">
                                                    <i class="ri-add-line"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <p>{{ number_format($price) }}<sup>đ</sup></p>
                                            </td>
                                            <td>
                                                <a href="/cart/delete/{{$product->id}}">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" style="font-weight: bold">Tổng Tiền</td>
                                        <td style="text-align: center ;font-weight: bold">
                                            {{ number_format($total) }}<sup>đ</sup>
                                        </td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                            <br>
                            <button formaction="/cart/update" class="main-btn"> Cập nhật giỏ hàng</button>
                            <a style="color:aquamarine ; font-style:italic;" href="/">=>>Tiếp tục mua hàng </a>
                        </div>
                    </div>
                    <div class="cart-section-right">
                        <h2 class="main-h2">Thông Tin Đơn Hàng</h2>
                        <div class="cart-section-right-input-name-phone">
                            <input type="text" placeholder="Tên" name="name" id="">
                            <input type="text" placeholder="Điện Thoại" name="phone" id="">
                        </div>
                        <div class="cart-section-right-input-email">
                            <input type="text" placeholder="Email" name="email" id="">
                        </div>
                        <div class="cart-section-right-select">
                            <select name="province" id="province">
                                <option value="">Tỉnh/TP</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->code }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <select name="ward" id="ward">
                                <option value="">Phường/Xã</option>
                            </select>
                        </div>
                        <div class="cart-section-right-input-address">
                            <input type="text" placeholder="Địa Chỉ" name="address" id="">
                        </div>
                        <div class="cart-section-right-input-note">
                            <input type="text" placeholder="Ghi Chú" name="note" id="">
                        </div>
                        <button class="main-btn">Đặt Hàng</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
    $(document).ready(function () {
        $('#province').on('change', function () {
            var provinceCode = $(this).val();
            $('#ward').html('<option value="">Đang tải...</option>');
            $.ajax({
                url: '/api/wards',
                type: 'GET',
                data: { province_code: provinceCode },
                success: function (data) {
                    var options = '<option value="">Phường/Xã</option>';
                    $.each(data, function (i, ward) {
                        options += '<option value="' + ward.code + '">' + ward.name + '</option>';
                    });
                    $('#ward').html(options);
                }
            });
        });
    });
</script>
@endsection