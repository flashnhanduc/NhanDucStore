<!DOCTYPE html>
<html lang="vi">

<head>
    @include('partials.head')
</head>

<body>
    <header id="header">
        @include('partials.header')
    </header>
   {{-- content --}}
   @yield('content')
   

    <footer>
        @include('partials.footer')

    </footer>

</body>

</html>