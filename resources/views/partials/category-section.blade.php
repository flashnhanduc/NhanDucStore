<section class="cat-section" id="cat-{{ $category->id }}">
    <div class="container">
        {{-- Section Header: Title with Red Bar & Underline + Filter Pills --}}
        <div class="cat-section-header">
            <div class="cat-title-box">
                <h2 class="cat-section-title">
                    <span class="title-bar">|</span> {{ mb_strtoupper($category->name) }}
                </h2>
                <div class="cat-title-underline"></div>
            </div>

            <div class="cat-filter-pills">
                <button type="button" class="cat-pill active">TẤT CẢ</button>
                @if(isset($category->children) && $category->children->count() > 0)
                    @foreach($category->children as $sub)
                        <button type="button" class="cat-pill">{{ mb_strtoupper($sub->name) }}</button>
                    @endforeach
                @else
                    @php
                        $lowerName = mb_strtolower($category->name);
                        $defaultPills = [];
                        if (str_contains($lowerName, 'áo')) {
                            $defaultPills = ['Áo sơ mi dài tay', 'Áo sơ mi ngắn tay', 'Áo polo', 'Áo thun', 'Áo khoác'];
                        } elseif (str_contains($lowerName, 'quần')) {
                            $defaultPills = ['Quần dài', 'Quần short'];
                        } elseif (str_contains($lowerName, 'phụ kiện')) {
                            $defaultPills = ['Bóp tay / Ví', 'Giày', 'Thắt lưng', 'Cà vạt'];
                        }
                    @endphp
                    @foreach($defaultPills as $pill)
                        <button type="button" class="cat-pill">{{ mb_strtoupper($pill) }}</button>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- 4-Column Product Grid --}}
        <div class="cat-products-grid">
            @if(isset($category->products) && $category->products->count() > 0)
                @foreach($category->products->take(8) as $product)
                    @php
                        $images = $product->image ? explode('#', $product->image) : [];
                        $firstImage = (count($images) > 0 && !empty($images[0])) ? $images[0] : null;
                        if (!$firstImage) {
                            $firstImage = 'frontend/asset/images/products' . (($product->id % 5) + 1) . '.avif';
                        }
                    @endphp
                    <div class="cat-product-card">
                        <a href="{{ url('/product/' . $product->id) }}" class="cat-product-img">
                            <img src="{{ asset($firstImage) }}" alt="{{ $product->name }}" loading="lazy">
                        </a>
                        <div class="cat-product-info">
                            <h3 class="cat-product-name">
                                <a href="{{ url('/product/' . $product->id) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="cat-product-price">
                                <span class="cat-price-red">
                                    {{ number_format($product->price_sale > 0 ? $product->price_sale : $product->price) }} đ
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="cat-products-empty">
                    <p>Đang cập nhật sản phẩm cho danh mục này...</p>
                </div>
            @endif
        </div>

        {{-- Centered "View All" Button --}}
        <div class="cat-view-all">
            <a href="{{ url('/category/' . $category->id) }}" class="cat-view-all-btn">
                XEM TẤT CẢ SẢN PHẨM {{ mb_strtoupper($category->name) }} <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    </div>
</section>
