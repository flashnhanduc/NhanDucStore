<!DOCTYPE html>
<html lang="vi">

<head>
    @include('partials.head')
</head>

<body>
    <header id="header">
        @include('partials.header')
    </header>

    <!-- Hero Slider -->
    <section class="slider">
        <div class="slider-items">
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/images/banner1.avif') }}" alt="Banner 1">
            </div>
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/images/banner2.avif') }}" alt="Banner 2">
            </div>
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/images/banner3.avif') }}" alt="Banner 3">
            </div>
        </div>
        <div class="slider-arrow">
            <button type="button" class="arrow-btn arrow-prev" aria-label="Trước">
                <i class="ri-arrow-left-line"></i>
            </button>
            <button type="button" class="arrow-btn arrow-next" aria-label="Sau">
                <i class="ri-arrow-right-line"></i>
            </button>
        </div>
        <div class="slider-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </section>

    <!-- Category Sections (Aristino Layout) -->
    <main class="home-main">
        @if(isset($categories) && count($categories) > 0)
            @foreach($categories as $category)
                @include('partials.category-section', ['category' => $category])
            @endforeach
        @endif
    </main>

    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>