<!DOCTYPE html>
<html lang="en">

<head>
    @include('parts.head')
</head>

<body>
    <header id="header">
        @include('parts.header')
    </header>
   {{-- content --}}
   @yield('content')
   
    <!-- hotProducts -->
   {{-- @include('parts.hotproduct') --}}
    <!-- popullar-product  -->
    @include('parts.popullarproduct')
    <footer>
        @include('parts.footer')

    </footer>

</body>

</html>