<!DOCTYPE html>
<html lang="en">

<head>
    @include('parts.head')
</head>

<body>
    <header id="header">
        @include('parts.header')
    </header>
    <!-- slider items -->
    <section class="slider">
        <div class="slider-items">
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/images/banner1.avif') }}" alt="">
            </div>
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/images/banner2.avif')}}" alt="">
            </div>
            <div class="slider-item">
                <img src="{{ asset('frontend/asset/images/banner3.avif')}}" alt="">
            </div>
        </div>
        <div class="slider-arrow">
            <i class="ri-arrow-right-line"></i>
            <i class="ri-arrow-left-line"></i>
        </div>
    </section>
    <!-- hotProducts -->
   @include('parts.hotproduct')
   
    <!-- popullar-product  -->
     @include('parts.popullarproduct')
  
    
    <footer>
        @include('parts.footer')

    </footer>
</body>

</html>