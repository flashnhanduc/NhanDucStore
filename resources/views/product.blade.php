@extends('main')

@section('content')
<div class="product-page-wrapper p-to-top">
    <div class="container">
        {{-- Breadcrumb Navigation --}}
        <nav class="product-breadcrumb" aria-label="breadcrumb">
            <a href="/">Trang chủ</a>
            <i class="ri-arrow-right-s-line"></i>
            <a href="/#cat-{{ $product->category_id }}">{{ $product->category->name ?? 'Thời trang Nam' }}</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="breadcrumb-current">{{ $product->name }}</span>
        </nav>

        {{-- Main Product Detail Container --}}
        <div class="product-detail-layout">
            {{-- Left: Image Gallery --}}
            <div class="product-gallery">
                @php
                    $images = $product->image ? explode('#', $product->image) : [];
                    $images = array_values(array_filter($images));
                    if (empty($images)) {
                        $defNum = (($product->id % 5) + 1);
                        $images = [
                            'frontend/asset/images/products' . $defNum . '.avif',
                            'frontend/asset/images/products1.1.avif',
                            'frontend/asset/images/products1.2.avif',
                            'frontend/asset/images/products1.3.avif',
                        ];
                    }
                    $mainImage = $images[0];
                    $hasDiscount = $product->price_sale && $product->price_sale > 0 && $product->price_sale < $product->price;
                    $discountPercent = $hasDiscount ? round((1 - $product->price_sale / $product->price) * 100) : 0;
                @endphp

                {{-- Thumbnail Strip --}}
                <div class="gallery-thumbnails">
                    @foreach($images as $idx => $img)
                        <div class="thumb-item {{ $idx === 0 ? 'active' : '' }}" onclick="switchProductImage('{{ asset($img) }}', this)">
                            <img src="{{ asset($img) }}" alt="{{ $product->name }} thumb {{ $idx + 1 }}">
                        </div>
                    @endforeach
                </div>

                {{-- Main Image Display --}}
                <div class="gallery-main">
                    <img id="mainProductImg" class="main-image" src="{{ asset($mainImage) }}" alt="{{ $product->name }}">
                    @if($hasDiscount)
                        <span class="detail-badge-sale">-{{ $discountPercent }}%</span>
                    @endif
                    <button type="button" class="btn-zoom" title="Phóng to ảnh" onclick="openImageZoom()">
                        <i class="ri-zoom-in-line"></i>
                    </button>
                </div>
            </div>

            {{-- Right: Product Summary & Purchase Form --}}
            <div class="product-summary">
                <span class="product-brand-tag">{{ mb_strtoupper($product->category->name ?? 'COOLMATE ESSENTIALS') }}</span>
                <h1 class="product-title">{{ $product->name }}</h1>

                {{-- Rating & SKU --}}
                <div class="product-meta-row">
                    <div class="product-rating">
                        <div class="stars">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <span class="rating-score">5.0</span>
                        <span class="rating-count">(142 đánh giá)</span>
                    </div>
                    <span class="meta-sep">•</span>
                    <span class="product-sku">Mã SP: <strong>CM-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</strong></span>
                </div>

                {{-- Price Box --}}
                <div class="product-price-box">
                    @if($hasDiscount)
                        <span class="price-sale">{{ number_format($product->price_sale) }} đ</span>
                        <span class="price-original">{{ number_format($product->price) }} đ</span>
                        <span class="price-discount-tag">Tiết kiệm {{ $discountPercent }}%</span>
                    @else
                        <span class="price-sale">{{ number_format($product->price) }} đ</span>
                    @endif
                </div>

                {{-- Purchase Form --}}
                <form action="/cart/add" method="POST" class="product-buy-form" id="addToCartForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- Color Selection --}}
                    @php
                        $variants = $product->variants ?? collect();
                        $colors = $variants->pluck('color')->filter()->unique();
                        if ($colors->isEmpty()) {
                            $colors = collect(['Xanh Navy', 'Đen', 'Xám Tiêu']);
                        }
                    @endphp
                    <div class="option-group">
                        <div class="option-header">
                            <span class="option-label">Màu sắc:</span>
                            <span class="option-selected" id="selectedColorLabel">{{ $colors->first() }}</span>
                        </div>
                        <div class="color-options">
                            @foreach($colors as $idx => $color)
                                <label class="color-pill {{ $idx === 0 ? 'active' : '' }}">
                                    <input type="radio" name="product_color" value="{{ $color }}" {{ $idx === 0 ? 'checked' : '' }} onchange="selectColor('{{ $color }}', this)">
                                    <span>{{ $color }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Size Selection --}}
                    @php
                        $sizes = $variants->pluck('size')->filter()->unique();
                        if ($sizes->isEmpty()) {
                            $sizes = collect(['M', 'L', 'XL', '2XL']);
                        }
                    @endphp
                    <div class="option-group">
                        <div class="option-header">
                            <span class="option-label">Kích thước:</span>
                            <span class="option-selected" id="selectedSizeLabel">{{ $sizes->first() }}</span>
                            <a href="#sizeGuide" class="size-guide-link" onclick="toggleSizeGuide(event)">
                                <i class="ri-ruler-line"></i> Hướng dẫn chọn size
                            </a>
                        </div>
                        <div class="size-options">
                            @foreach($sizes as $idx => $size)
                                <label class="size-pill {{ $idx === 0 ? 'active' : '' }}">
                                    <input type="radio" name="product_size" value="{{ $size }}" {{ $idx === 0 ? 'checked' : '' }} onchange="selectSize('{{ $size }}', this)">
                                    <span>{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Quantity & Stock --}}
                    <div class="option-group quantity-group">
                        <span class="option-label">Số lượng:</span>
                        <div class="quantity-control">
                            <button type="button" class="btn-qty btn-qty-minus" onclick="adjustDetailQty(-1)" aria-label="Giảm">
                                <i class="ri-subtract-line"></i>
                            </button>
                            <input type="number" id="detailQtyInput" name="product_qty" class="quantity-input" value="1" min="1" max="99" readonly>
                            <button type="button" class="btn-qty btn-qty-plus" onclick="adjustDetailQty(1)" aria-label="Tăng">
                                <i class="ri-add-line"></i>
                            </button>
                        </div>
                        <span class="stock-status"><i class="ri-checkbox-circle-fill"></i> Còn hàng</span>
                    </div>

                    {{-- Action CTA Buttons --}}
                    <div class="product-cta-buttons">
                        <button type="submit" class="btn-add-cart">
                            <i class="ri-shopping-bag-3-line"></i> THÊM VÀO GIỎ HÀNG
                        </button>
                        <button type="submit" class="btn-buy-now" onclick="setBuyNow()">
                            MUA NGAY
                        </button>
                    </div>
                </form>

                {{-- Trust Perks Box --}}
                <div class="product-perks-box">
                    <div class="perk-item">
                        <i class="ri-truck-line"></i>
                        <div>
                            <strong>Giao hàng toàn quốc</strong>
                            <span>Miễn phí ship đơn từ 299K</span>
                        </div>
                    </div>
                    <div class="perk-item">
                        <i class="ri-arrow-go-back-line"></i>
                        <div>
                            <strong>Đổi trả 60 ngày</strong>
                            <span>Đổi trả tận nơi miễn phí</span>
                        </div>
                    </div>
                    <div class="perk-item">
                        <i class="ri-shield-check-line"></i>
                        <div>
                            <strong>Chính hãng 100%</strong>
                            <span>Cam kết bảo hành chất lượng</span>
                        </div>
                    </div>
                    <div class="perk-item">
                        <i class="ri-customer-service-2-line"></i>
                        <div>
                            <strong>Hotline hỗ trợ 24/7</strong>
                            <span>Tư vấn qua 0389.839.375</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detailed Product Tabs --}}
        <div class="product-tabs-section">
            <div class="product-tab-headers">
                <button type="button" class="tab-btn active" onclick="switchDetailTab('tab-desc', this)">
                    MÔ TẢ CHI TIẾT
                </button>
                <button type="button" class="tab-btn" onclick="switchDetailTab('tab-specs', this)">
                    THÔNG SỐ & CHẤT LIỆU
                </button>
                <button type="button" class="tab-btn" onclick="switchDetailTab('tab-policy', this)">
                    CHÍNH SÁCH ĐỔI TRẢ
                </button>
            </div>

            <div class="product-tab-content">
                {{-- Tab 1: Description --}}
                <div id="tab-desc" class="tab-pane active">
                    <div class="tab-body-text">
                        @if(!empty($product->description))
                            {!! $product->description !!}
                        @else
                            <p>Sản phẩm <strong>{{ $product->name }}</strong> được thiết kế theo xu hướng hiện đại, mang phong cách lịch lãm, tinh tế và tối giản đặc trưng của dòng sản phẩm thời trang nam cao cấp.</p>
                            <ul>
                                <li><strong>Chất liệu:</strong> Vải cao cấp thoáng khí, mềm mại, co giãn 4 chiều mang lại sự thoải mái suốt cả ngày dài.</li>
                                <li><strong>Công nghệ hoàn tất:</strong> Xử lý bề mặt chống nhăn, kháng khuẩn và khử mùi hiệu quả.</li>
                                <li><strong>Form dáng:</strong> Thiết kế vừa vặn (Regular Fit / Slim Fit) tôn dáng quý ông hiện đại.</li>
                                <li><strong>Ứng dụng:</strong> Phù hợp mặc đi làm, dạo phố, gặp gỡ đối tác hoặc tham gia các hoạt động thường ngày.</li>
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- Tab 2: Specs & Sizing --}}
                <div id="tab-specs" class="tab-pane">
                    <div class="specs-table-wrapper">
                        <table class="specs-table">
                            <tbody>
                                <tr>
                                    <th>Danh mục</th>
                                    <td>{{ $product->category->name ?? 'Thời trang Nam' }}</td>
                                </tr>
                                <tr>
                                    <th>Chất liệu</th>
                                    <td>Cotton Compact cao cấp kết hợp sợi Spandex đàn hồi</td>
                                </tr>
                                <tr>
                                    <th>Kiểu dáng</th>
                                    <td>Form Regular Fit trẻ trung, thoải mái vận động</td>
                                </tr>
                                <tr>
                                    <th>Xuất xứ</th>
                                    <td>Tự hào sản xuất tại Việt Nam theo tiêu chuẩn xuất khẩu</td>
                                </tr>
                                <tr>
                                    <th>Hướng dẫn giặt</th>
                                    <td>Giặt ở nhiệt độ thường, không dùng thuốc tẩy mạnh, phơi nơi râm mát</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tab 3: Policy --}}
                <div id="tab-policy" class="tab-pane">
                    <div class="tab-body-text">
                        <h3>Chính Sách Đổi Trả Miễn Phí 60 Ngày</h3>
                        <p>Coolmate cam kết mang đến trải nghiệm mua sắm an tâm tuyệt đối cho bạn:</p>
                        <ul>
                            <li>Đổi size, đổi màu hoặc đổi mẫu hoàn toàn <strong>miễn phí trong vòng 60 ngày</strong> kể từ khi nhận hàng.</li>
                            <li>Bưu tá sẽ mang hàng mới đến đổi tận nhà cho bạn, bạn không cần phải ra bưu cục gửi trả.</li>
                            <li>Hoàn tiền 100% nếu bạn không hoàn toàn hài lòng với chất lượng sản phẩm vì bất kỳ lý do gì.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products Section (Aristino Style 4 Columns) --}}
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
            <div class="related-products-section">
                <div class="related-header">
                    <h2 class="related-title"><span class="title-bar">|</span> SẢN PHẨM TƯƠNG TỰ</h2>
                    <div class="related-title-underline"></div>
                </div>
                <div class="cat-products-grid">
                    @foreach($relatedProducts as $rel)
                        @php
                            $relImages = $rel->image ? explode('#', $rel->image) : [];
                            $relFirst = (count($relImages) > 0 && !empty($relImages[0])) ? $relImages[0] : null;
                            if (!$relFirst) {
                                $relFirst = 'frontend/asset/images/products' . (($rel->id % 5) + 1) . '.avif';
                            }
                            $relDiscount = $rel->price_sale && $rel->price_sale > 0 && $rel->price_sale < $rel->price;
                        @endphp
                        <div class="cat-product-card">
                            <a href="{{ url('/product/' . $rel->id) }}" class="cat-product-img">
                                <img src="{{ asset($relFirst) }}" alt="{{ $rel->name }}" loading="lazy">
                            </a>
                            <div class="cat-product-info">
                                <h3 class="cat-product-name">
                                    <a href="{{ url('/product/' . $rel->id) }}">{{ $rel->name }}</a>
                                </h3>
                                <div class="cat-product-price">
                                    <span class="cat-price-red">
                                        {{ number_format($rel->price_sale > 0 ? $rel->price_sale : $rel->price) }} đ
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Inline JS for Interactive Gallery & Tabs --}}
<script>
function switchProductImage(src, element) {
    const mainImg = document.getElementById('mainProductImg');
    if (mainImg) {
        mainImg.style.opacity = '0.3';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);
    }
    document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
    if (element) element.classList.add('active');
}

function selectColor(color, radio) {
    const label = document.getElementById('selectedColorLabel');
    if (label) label.textContent = color;
    document.querySelectorAll('.color-pill').forEach(el => el.classList.remove('active'));
    if (radio && radio.parentElement) radio.parentElement.classList.add('active');
}

function selectSize(size, radio) {
    const label = document.getElementById('selectedSizeLabel');
    if (label) label.textContent = size;
    document.querySelectorAll('.size-pill').forEach(el => el.classList.remove('active'));
    if (radio && radio.parentElement) radio.parentElement.classList.add('active');
}

function adjustDetailQty(delta) {
    const input = document.getElementById('detailQtyInput');
    if (!input) return;
    let val = parseInt(input.value) || 1;
    val += delta;
    if (val < 1) val = 1;
    if (val > 99) val = 99;
    input.value = val;
}

function switchDetailTab(tabId, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    if (btn) btn.classList.add('active');
    const target = document.getElementById(tabId);
    if (target) target.classList.add('active');
}

function toggleSizeGuide(e) {
    e.preventDefault();
    switchDetailTab('tab-specs', document.querySelectorAll('.tab-btn')[1]);
    const tabSection = document.querySelector('.product-tabs-section');
    if (tabSection) {
        tabSection.scrollIntoView({ behavior: 'smooth' });
    }
}

function setBuyNow() {
    // Form will naturally submit to /cart/add and redirect to /cart
}
</script>
@endsection