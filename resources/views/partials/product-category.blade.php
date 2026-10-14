<section class="category-section" style="margin-bottom: 50px;">
    <div class="container">
        <!-- Tên danh mục (Được truyền từ home.blade.php) -->
        <div class="row-grid">
            <p class="heading-text">{{ $title }}</p>
        </div>
        
        <div class="row-grid row-grid-hot-products">
            <!-- Nếu có dữ liệu sản phẩm thì mới in ra -->
            @if(isset($products) && count($products) > 0)
                @foreach ($products as $product)
                    @php
                        $images = explode('#', $product->image);
                        $firstImage = $images[0];
                    @endphp

                    <div class="hot-product-item">
                        <a href="{{ url('/product/' . $product->id) }}">
                            <img src="{{ $firstImage ? asset($firstImage) : asset('frontend/asset/images/default.jpg') }}" alt="{{ $product->name }}">
                        </a>
                        
                        <p><a href="{{ url('/product/' . $product->id) }}">{{ $product->name }}</a></p>
                        
                        <span>{{ $product->category->name ?? 'Thời trang Nam' }}</span>
                        
                        <div class="hot-product-item-price">
                            <p>
                                {{ number_format($product->price_sale > 0 ? $product->price_sale : $product->price) }}<sup>đ</sup> 
                                
                                @if($product->price_sale > 0 && $product->price_sale < $product->price)
                                    <span style="text-decoration: line-through; color: #999; margin-left: 5px;">
                                        {{ number_format($product->price) }}<sup>đ</sup>
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Giao diện chờ khi chưa có Controller xử lý -->
                <p style="text-align: center; width: 100%; color: #999; font-style: italic;">
                    Đang cập nhật sản phẩm cho danh mục này...
                </p>
            @endif
        </div>
    </div>
</section>