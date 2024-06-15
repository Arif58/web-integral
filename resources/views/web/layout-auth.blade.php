<head>
    @include('web.layout.head')
</head>
<body class="rbt-elements-area bg-color-white rbt-section-gap d-flex">
    <div class="container my-auto">
        <div class="row gy-5 row--30">
            <div class="col-lg-6" style="margin: 0px !important">
                <div class="max-width-auto"> 
                    <img src="{{ asset('images/banner/auth-image.svg') }}" alt="">
                </div>
            </div>
    
            <div class="col-lg-6" style="margin: 0px !important">
                @yield('content')
            </div>
        </div>
    </div>
       
 
    @include('web.layout.js')
</body>