<!DOCTYPE html>
<html lang="en">

<head>
   @include('admin.parts.head')
<title>Hello-Admin</title>
</head>

<body>
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                   @include('admin.parts.sidebar')
                </div>
            </div>
            <div class="admin-content">
               @include('admin.parts.header')
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-title">
                        <h1>{{ isset($title)? $title : 'Dashboard' }}</h1>
                    </div>
                    <div class="admin-content-main-content">
                        {{-- Nội dung nằm ở đây --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        @include('admin.parts.footer')
    </footer>
</body>

</html>v
