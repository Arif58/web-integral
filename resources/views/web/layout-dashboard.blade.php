<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.layout.head')
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/datatable.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
@php
    $currentPath = Route::currentRouteName();
    $pageWithoutSidebar = ['profile.edit', 'profile.edit-major'];
    $pageWithoutHeader = ['profile.edit', 'profile.edit-major'];
    $pageWithoutNavbar = ['profile.edit', 'profile.edit-major']
@endphp
<body>
    @if (!in_array($currentPath, $pageWithoutNavbar))
    <header class="rbt-header rbt-header-10">
        @include('web.layout.header-dashboard')
    </header>
    @endif
    <!-- Start Card Style -->
    <div class="rbt-dashboard-area rbt-section-gapBottom mt--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (!in_array($currentPath, $pageWithoutHeader))
                    <!-- Start Dashboard Top  -->
                    <div class="rbt-dashboard-content-wrapper">
                        <div class="bg-gradient-19 border radius-10" style="height: 162px;"></div>
                        <div class="bot-element-dashboard"></div>
                        <!-- Start Tutor Information  -->
                        <div class="rbt-tutor-information">
                            <div class="rbt-tutor-information-left">
                                <div class="tutor-content">
                                    <h5 class="title" style="font-size: 38px;">{{ Auth::user()->fullname }}</h5>
                                    <ul class="rbt-meta rbt-meta-white mt--5">
                                        @if (Auth::user()->role === 'student')
                                        <li><i class="feather-book"></i>{{Auth::user()->participants->count()}} Try Out Terdaftar</li>
                                        <span style="color: white">|</span>
                                        <li><i class="feather-award"></i>{{Auth::user()->ie_gems}} IE Gems</li>
                                        @elseif (Auth::user()->role === 'admin')
                                        <li><i class="feather-user"></i>{{ Auth::user()->role}}</li>
                                        @endif
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Tutor Information  -->
                    </div>
                    <!-- End Dashboard Top  -->
                    @endif

                    <div class="row g-5">
                        @if (!in_array($currentPath, $pageWithoutSidebar))
                        <div class="col-lg-3">
                            <!-- Start Dashboard Sidebar  -->
                            <div class="rbt-default-sidebar sticky-top rbt-shadow-box" style="top: 10px;">
                                <div class="inner">
                                    <div class="content-item-content">

                                        <div class="rbt-default-sidebar-wrapper">
                                            <nav class="mainmenu-nav">
                                                <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                                                   @include('web.layout.sidebar-menu')
                                                </ul>
                                            </nav>

                                    
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Dashboard Sidebar  -->
                        </div>
                        @endif
                        <div class="@if(in_array($currentPath, $pageWithoutSidebar)) col  @else col-lg-9 @endif">
                            @yield('content')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card Style -->
    <footer class="rbt-footer footer-style-1 bg-color-white overflow-hidden">
        @include('web.layout.footer')
    </footer>

     <!-- JS
============================================ -->
    @include('web.layout.js')
</body>
</html>