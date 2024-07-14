<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.layout.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header class="rbt-header rbt-header-10">
        @include('web.layout.header-dashboard')
    </header>
    <!-- Start breadcrumb Area -->
    <div class="rbt-breadcrumb-default ptb--50 ptb_md--50 ptb_sm--30 bg-gradient-18">
        <div class="container">
            <div class="d-flex">
                <div>
                    <h3 class=" color-white mb-0">
                        <a href="javascript:history.back()"><i class="feather-arrow-left"></i></a>
                    </h3> 
                </div>
                <div style="width: 100%">
                    <div class="breadcrumb-inner text-center">
                        <h1 class="title color-white mb-5">
                            Rekomendasi Jurusan
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area -->

     <!-- Start Card Style -->
     <div class="rbt-dashboard-area rbt-section-gapBottom mt--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="row g-5">

                    </div> --}}
                    <div class="content">
                        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
                            <div class="row g-5 mb-5 pb-4" style="border-bottom: 1px solid var(--color-border-2);">
                                <div class="col-lg-6 order-2 order-lg-1 title">
                                    <h3 class="rbt-content-title">Rekomendasi Jurusan Serupa</h3>
                                    <span>Kami memberikan rekomendasi berdasarkan <b>nilai try out</b> dan juga <b>target perguruan tinggi</b> serta <b>minat dan bakat</b> yang kamu pilih.</span>
                                </div>
                                <div class="col-lg-6 order-1 order-lg-2 text-center text-lg-end">
                                    <img src="{{asset('images/banner/Search Illustration.svg')}}" alt="" style="transform: scaleX(-1);">
                                </div>
                            </div>

                            <div class="row mt-4">
                                @if (is_string($majorRecommendation))
                                    <span class="text-center">
                                        -- {{$majorRecommendation}} --
                                    </span>
                                @else
                                    @foreach ($majorRecommendation as $major)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="mx-4 justify-content-center" style="padding: 10px 10px; border-radius: 5px; border: 1px solid #3D76A6; margin-bottom: 15px;">
                                            <p class="text-center mb-2" style="font-weight: 400; color: #424242">{{$major->university->name}}</p>
                                            <p class="text-center mb-0" style="font-weight: 300; color: #9F9F9F">{{$major->name}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                
                            </div>
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
    
    @include('web.layout.js')
</body>
</html>