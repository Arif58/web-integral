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
                    @if (Auth::check())
                    <li class="position-static">
                        <a class="text-white" href="/dashboard">Dashboard</a>
                    </li> 
                    @endif
                </ul>
            </nav>

            <div class="mobile-menu-bottom">
                @if (!Auth::check())
                <div class="rbt-btn-wrapper mb--10">
                    <a class="rbt-btn btn-border-gradient btn-sm hover-transform-none w-100 justify-content-center text-center" style="box-shadow: none; border-radius: 6px;" href="/login">
                        <span>Login</span>
                    </a>
                </div>
                <div class="rbt-btn-wrapper mb--20">
                    <a href="/register" class="rbt-btn btn-sm hover-transform-none w-100 justify-content-center text-center bg-gradient-19">
                        <span>Register</span>
                    </a>
                </div>
                @endif

                <div class="social-share-wrapper" style="bottom: 15px;
                position: fixed;">
                    <span class="rbt-short-title d-block text-white">Kontak Kami</span>
                    <ul class="social-icon social-default transparent-with-border justify-content-start mt--20">
                        <li><a href="https://wa.me/6289626575729">
                                <i class="feather-phone text-white"></i>
                            </a>
                        </li>
                        <li><a href="https://gmail.com" target="_blank">
                                <i class="feather-mail text-white"></i>
                            </a>
                        </li>
                        <li><a href="https://www.instagram.com/integral.education" target="_blank">
                                <i class="feather-instagram text-white"></i>
                            </a>
                        </li>
                        <li><a href="https://www.linkdin.com/">
                                <i class="feather-youtube text-white"></i>
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
    <script>
        @if (session('status') == 'success')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('status') == 'error')
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>