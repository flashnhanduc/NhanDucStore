<div class="admin-sidebar-top">
    <a href="/admin">
        <img src="{{ asset('backend/asset/images/nhanduc.jpg') }}" alt="">
    </a>

</div>
<div class="admin-sidebar-content">
    <ul>
        <li><a href=""><i class="ri-dashboard-line"></i>Dashboard<i class="ri-file-add-line"></i></a>
            <ul class="sub-menu">
                <div class="sub-menu-items">
                    <li><a href=""><i class="ri-arrow-right-s-fill"></i>Thống Kê</a></li>
                </div>
            </ul>
        </li>
        <li><a href=""><i class="ri-file-list-line"></i></i>Đơn Hàng<i class="ri-file-add-line"></i></a>
            <ul class="sub-menu">
                <div class="sub-menu-items">
                    <li><a href="/admin/orders/list"><i class="ri-arrow-right-s-fill"></i>Danh Sách</a></li>
                </div>
            </ul>
        </li>
        <li><a href=""><i class="ri-file-list-line"></i></i>Sản Phẩm<i class="ri-file-add-line"></i></a>
            <ul class="sub-menu">
                <div class="sub-menu-items">
                    <li><a href="{{ route('admin.products.index') }}"><i class="ri-arrow-right-s-fill"></i>Danh Sách</a></li>
                    <li><a href="{{ route('admin.products.create') }}"><i class="ri-arrow-right-s-fill"></i>Thêm</a></li>
                </div>
            </ul>
        </li>

    </ul>