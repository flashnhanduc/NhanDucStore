<!-- Top Utility Bar (Dark Slate) -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-inner">
            <div class="top-bar-left">
                @auth
                    <span class="user-greeting">Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
                    <span class="top-bar-sep">|</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="top-bar-link">Đăng xuất</button>
                    </form>
                @else
                    <span class="user-greeting">Xin chào, <strong>Lý Nhân Đức</strong></span>
                    <span class="top-bar-sep">|</span>
                    <a href="{{ route('login') }}" class="top-bar-link">Đăng nhập</a>
                @endauth
            </div>
            <div class="top-bar-right">
                <a href="#" class="top-bar-link">
                    <i class="ri-heart-line"></i> Yêu thích (<span class="wishlist-count">0</span>)
                </a>
                <span class="top-bar-sep">|</span>
                <a href="/cart" class="top-bar-link">
                    <i class="ri-shopping-cart-2-line"></i> Giỏ hàng (<span class="cart-count-top">0</span>)
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Navigation Header -->
<div class="header-main">
    <div class="container">
        <div class="header-inner">
            <!-- Mobile Menu Toggle -->
            <div class="header-bar-icon" id="mobileMenuBtn" aria-label="Mở menu">
                <i class="ri-menu-line"></i>
            </div>

            <!-- Brand Logo -->
            <div class="header-logo">
                <a href="/"><img src="{{ asset('frontend/asset/images/logo.png') }}" alt="Coolmate"></a>
            </div>
            <div class="header-logo-mobile">
                <a href="/"><img src="{{ asset('frontend/asset/images/logo-mobile.png') }}" alt="Coolmate"></a>
            </div>

            <!-- Navigation Links -->
            <div class="header-nav" id="headerNav">
                <nav>
                    <ul>
                        <li><a href="/" class="nav-item">TRANG CHỦ</a></li>
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $cat)
                                <li>
                                    <a href="#cat-{{ $cat->id }}" class="nav-item">{{ mb_strtoupper($cat->name) }}</a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="#cat-1" class="nav-item">ÁO NAM</a></li>
                            <li><a href="#cat-2" class="nav-item">QUẦN NAM</a></li>
                            <li><a href="#cat-3" class="nav-item">PHỤ KIỆN</a></li>
                        @endif
                        <li>
                            <a href="#" class="nav-item nav-sale">
                                KHUYẾN MÃI <span class="nav-sale-tag">HOT</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Search Box with Red Button -->
            <div class="header-search-wrap">
                <form action="/search" method="GET" class="header-search-form">
                    <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." autocomplete="off">
                    <button type="submit" class="header-search-btn" aria-label="Tìm kiếm">
                        <i class="ri-search-line"></i>
                    </button>
                </form>
            </div>

            <!-- Mobile Cart Shortcut -->
            <div class="header-mobile-cart">
                <a href="/cart" aria-label="Giỏ hàng">
                    <i class="ri-shopping-bag-3-line"></i>
                    <span class="mobile-cart-badge">0</span>
                </a>
            </div>
        </div>
    </div>
</div>