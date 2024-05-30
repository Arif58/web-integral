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
    <!-- Mobile Menu Section -->
    <div class="popup-mobile-menu">
        <div class="inner-wrapper">
            <div class="inner-top">
                <div class="content">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('images/logo/logo_IE.png') }}" alt="Integral Education Logo Images">
                        </a>
                    </div>
                    <div class="rbt-btn-close">
                        <button class="close-button rbt-round-btn"><i class="feather-x"></i></button>
                    </div>
                </div>
            </div>

            <nav class="mainmenu-nav">
                <ul class="mainmenu">
                    <li class="position-static">
                        <a class="text-white" href="/">Beranda</a>
                    </li>
                    <li class="position-static">
                        <a class="text-white" href="/try-out-utbk">Try Out UTBK</a>
                    </li>
                </ul>
            </nav>

            <div class="mobile-menu-bottom">
                <div class="rbt-btn-wrapper mb--20">
                    <a class="rbt-btn btn-border-gradient radius-round btn-sm hover-transform-none w-100 justify-content-center text-center" style="box-shadow: none" href="/login">
                        <span>Login</span>
                    </a>
                </div>

                <div class="social-share-wrapper">
                    <span class="rbt-short-title d-block">Find With Us</span>
                    <ul class="social-icon social-default transparent-with-border justify-content-start mt--20">
                        <li><a href="https://www.facebook.com/">
                                <i class="feather-facebook"></i>
                            </a>
                        </li>
                        <li><a href="https://www.twitter.com">
                                <i class="feather-twitter"></i>
                            </a>
                        </li>
                        <li><a href="https://www.instagram.com/">
                                <i class="feather-instagram"></i>
                            </a>
                        </li>
                        <li><a href="https://www.linkdin.com/">
                                <i class="feather-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Mobile Area  -->

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