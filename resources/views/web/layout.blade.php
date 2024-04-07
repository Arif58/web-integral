<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.layout.head')
</head>
<body class="rbt-header-sticky">
    <header class="rbt-header rbt-header-10">
        @include('web.layout.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="rbt-footer footer-style-1 bg-color-white overflow-hidden">
        @include('web.layout.footer')
    </footer>

     <!-- JS
============================================ -->
    @include('web.layout.js')
</body>
</html>