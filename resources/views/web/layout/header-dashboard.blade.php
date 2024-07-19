<div class="rbt-sticky-placeholder"></div>
<div class="rbt-header-wrapper header-space-betwween header-sticky" style="padding: 15px 30px">
    <div class="container-fluid">
        <div class="mainbar-row rbt-navigation-center align-items-center">
            <div class="header-left rbt-header-content">
                <div class="header-info">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ asset('images/logo/logo_IE.png') }}" alt="Education Logo Images">
                        </a>
                    </div>
                </div>
            </div>
            <div class="header-right">

                <!-- Navbar Icons -->
                <ul class="quick-access">

                    <li class="rbt-user-wrapper d-none d-xl-block">
                        <a href="#" style="color: white"><i class="feather-user"></i>{{ Auth::user()->username }}</a>                        
                        <div class="rbt-user-menu-list-wrapper mt--10" style="min-width: 165px">
                            <div class="inner">
                                <ul class="user-list-wrapper">
                                    <li class="mb-2">
                                        <a href="/profil-saya">
                                            <span>Profile Saya</span>
                                        </a>
                                    </li>
                                    <li>
                                        {{-- <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <span>Keluar</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form> --}}
                                        <a href="#" onclick="confirmLogout(event)">
                                            <span>Keluar</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>

                <!-- Start Mobile-Menu-Bar -->
                <div class="mobile-menu-bar d-block d-xl-none">
                    <div class="hamberger">
                        <button class="hamberger-button rbt-round-btn">
                            <i class="feather-menu"></i>
                        </button>
                    </div>
                </div>
                <!-- Start Mobile-Menu-Bar -->

            </div>
        </div>
    </div>
</div>
<a class="rbt-close_side_menu" href="javascript:void(0);"></a>