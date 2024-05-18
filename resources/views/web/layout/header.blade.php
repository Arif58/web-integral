<div class="rbt-sticky-placeholder"></div>
<div class="rbt-header-wrapper header-space-betwween header-sticky" style="background-color: #1D3B64">
    <div class="container-fluid">
        <div class="mainbar-row rbt-navigation-center align-items-center">
            <div class="header-left rbt-header-content">
                <div class="header-info">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('images/logo/logo_IE.png') }}" alt="Education Logo Images">
                        </a>
                    </div>
                </div>
            </div>

            <div class="rbt-main-navigation d-none d-xl-block">
                <nav class="mainmenu-nav">
                    <ul class="mainmenu">
                        <li class="with-megamenu has-menu-child-item position-static">
                            <a href="/" style="color: white">Beranda</a>
                        </li>
                        {{-- <li class="has-dropdown has-menu-child-item">
                            <a href="#" style="color: white">Produk
                                <i class="feather-chevron-down"></i>
                            </a>
                            <ul class="submenu">
                                <li class="has-dropdown"><a href="/produk/try-out-utbk">Try Out UTBK</a>
                                </li>
                                <li class="has-dropdown"><a href="#">Bimbel</a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="with-megamenu has-menu-child-item position-static">
                            <a href="/produk/try-out-utbk" style="color: white">Try Out UTBK</a>
                        </li>
                       
                    </ul>
                </nav>
            </div>

            <div class="header-right">

                <!-- Navbar Icons -->
                <ul class="quick-access">

                    <li class="account-access rbt-user-wrapper d-none d-xl-block">
                        <a href="#" style="color: white"><i class="feather-user"></i>Admin</a>                        
                        <div class="rbt-user-menu-list-wrapper">
                            <div class="inner">
                                <div class="rbt-admin-profile">
                                    <div class="admin-info">
                                        <span class="name">Nipa Bali</span>
                                    </div>
                                </div>
                                <ul class="user-list-wrapper">
                                    <li>
                                        <a href="instructor-dashboard.html">
                                            <i class="feather-home"></i>
                                            <span>My Dashboard</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                                <hr class="mt--10 mb--10">
                                <ul class="user-list-wrapper">
                                    <li>
                                        <a href="instructor-settings.html">
                                            <i class="feather-settings"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.html">
                                            <i class="feather-log-out"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>

                <div class="row me-2 btn-wrapper d-none d-xl-block">
                    <div class="col-lg-12">
                        <div class="rbt-button-group">
                            <a class="btn-md btn-white" style="color: white" href="/login">Login</a>
                            <a class="rbt-btn btn-sm" href="/register" style="background-color: #DC7E3F">Register</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="row rbt-btn-wrapper d-none d-xl-block">
                    <div class="col-lg">
                        
                    </div>
                    
                </div> --}}

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