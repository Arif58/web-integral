<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.layout.head')
</head>
@php
    // $isTryoutDetailPage = Route::currentRouteName() === 'tryout-detail';
    $isPaymentPage = Route::currentRouteName() === 'payment';
@endphp
{{-- <body class="@unless($isTryoutDetailPage) rbt-header-sticky @endunless"> --}}
<body class="rbt-header-sticky">
    @if (!$isPaymentPage)
        <header class="rbt-header rbt-header-10">
            @include('web.layout.header')
        </header>
    @endif
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