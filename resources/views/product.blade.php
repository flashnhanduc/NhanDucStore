@extends('main')
@section('content')
  <form action="/cart/add" method="POST"> 
    @csrf
      <div class="product-detail p-to-top">
        <div class="container">
            <div class="row-flex row-flex-product-detail">
                <p>Sản Phẩm</p> <i class="ri-arrow-right-line"></i>
                <p>{{ $product -> name }}</p>
            </div>
            <div class="row-grid">
                <div class="product-detail-left">
                    <img class="main-image" src="{{ asset($product -> image) }}" alt="">
                    <div class="product-images-items">
                        @php
                            $product_images = explode('#',$product -> images)
                        @endphp
                       @foreach (  $product_images as  $product_img )
                           <img src="{{ asset($product_img) }}" alt="">
                         @endforeach    
                       
                    </div>
                </div>
                <div class="product-detail-right">
                    <div class="product-detail-right-infor">
                        <h1>{{ ($product -> name) }}</h1>
                        <span>{{ ($product -> material) }}</span>
                        <div class="hot-product-item-price">
                            <p>{{ number_format($product ->price_sale) }}<sup>đ</sup> <span>{{ number_format($product->price_normal) }}<sup>đ</sup> </span></p>
                        </div>
                    </div>
                        <h2>Đặc điểm nổi bật</h2>
                    <div class="product-detail-right-des">
                      {!! $product->description !!}
                    </div>
                    <div class="product-detail-right-quantity">
                        <h2>Số Lượng</h2>
                        <div class="product-detail-right-quantity-input">
                            <i class="ri-subtract-line"></i>
                            <input onkeydown="return false" class="quantity-input" name="product_qty" type="number" value="1">
                            <input type="hidden" value="{{ ($product -> id) }}" name="product_id">
                            <i class="ri-add-line"></i>
                        </div>
                    </div>
                    <div class="product-detail-right-aadcart">
                        <button type="submit" class="main-btn" > Thêm vào giỏ hàng</button>

                    </div>
                </div>
            </div>
             <div class="row-flex row-flex-product-detail">
                  <h2>Chi Tiết Sản Phẩm</h2>
            </div>
            <div class="row-flex">
                <div class="product-detail-content">
                     {!! $product->content  !!}
                   
                </div>
            </div>
        </div>
    </div>
    
  </form>
@endsection