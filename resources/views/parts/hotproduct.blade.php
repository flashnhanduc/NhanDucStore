 <section class="hot-products">
        <div class="container">
            <div class="row-grid ">
                <p class="heading-text">Sản Phẩm Mới </p>
            </div>
            <div class="row-grid row-grid-hot-products">
                @foreach ( $products as $product)
                    <div class="hot-product-item">
                    <a href="/product/{{ $product-> id }}"><img src="{{ asset(($product-> image)) }}" alt=""></a>
                    <p><a href="/product/{{ $product -> id }}">{{ ($product -> name) }}</a></p>
                    <span>{{ ($product-> material) }}</span>
                    <div class="hot-product-item-price">
                        <p>{{ number_format($product-> price_sale) }}<sup>đ</sup> <span>{{ number_format($product-> price_normal) }}<sup>đ</sup> </span></p>
                    </div>
                </div>
                @endforeach
             </div>
        </div>
    </section>