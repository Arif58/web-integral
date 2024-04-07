@include('web.layout.head')
<body class="rbt-elements-area bg-color-white rbt-section-gap" style="justify-content: center; padding: 10%">
        <div class="row gy-5 row--30">
            <div class="col-lg-6">
                <div class="max-width-auto"> 
                    <img src="{{ asset('images/about/about-01.png') }}" alt="">
                </div>
            </div>
    
            <div class="col-lg-6">
                @yield('content')
            </div>
        </div>
 
    @include('web.layout.js')
</body>