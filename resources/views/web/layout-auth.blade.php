<head>
    @include('web.layout.head')
</head>
<body class="rbt-elements-area bg-color-white">
    <div class="wrapper w-100 h-100 d-flex align-items-center">
        <div class="container">
            <div class="row g-5 justify-content-between align-items-center">
                <div class="col-lg-6 order-1 order-lg-1">
                    <img src="{{ asset('images/banner/auth-image.svg') }}" alt=""> 
                </div>
                <div class="col-lg-6 order-2 order-lg-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
       
 
    @include('web.layout.js')
</body>