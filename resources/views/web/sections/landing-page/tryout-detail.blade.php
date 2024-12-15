@extends('web.layout')
@section('title', 'Tryout Detail')
@section('content')
<main class="rbt-main-wrapper">
    <!-- Start breadcrumb Area -->
    <div class="rbt-breadcrumb-default rbt-breadcrumb-style-3  bg-gradient-18">
        {{-- <div class="breadcrumb-inner"> --}}
            {{-- <img src="{{asset('/images/bg/bg-image-10.jpg')}}" alt="Education Images"> --}}
        {{-- </div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content text-start">
                        <ul class="page-list">
                            <li class="rbt-breadcrumb-item"><a class="text-white" href="/">Beranda</a></li>
                            <li>
                                <div class="icon-right"><i class="feather-chevron-right color-white"></i></div>
                            </li>
                            <li class="rbt-breadcrumb-item"><a class="text-white" href="/try-out-utbk">Try Out UTBK</a></li>
                            <li>
                                <div class="icon-right"><i class="feather-chevron-right color-white"></i></div>
                            </li>
                            <li class="rbt-breadcrumb-item active" style="color: #BDBDBD">{{$product->tryOut->name}}</li>
                        </ul>
                        <h1 class="title text-white">{{$product->tryOut->name}}</h1>

                        @php
                            $startDate = date('d', strtotime($product->tryOut->start_date));
                            $startMonth = date('F Y', strtotime($product->tryOut->start_date));
                            $price = number_format($product->price, 0, ',', '.');
                            $endDate = date('d F Y', strtotime($product->tryOut->end_date));
                            $tryOutDate = $startDate . ' - ' . $endDate;
                            $totalQuestion = $product->tryOut->subTests->sum('total_question');
                            $totalTime = $product->tryOut->subTests->sum('duration');
                            $subTestCategory = $product->tryOut->subTests->groupBy('category_subtest_id');
                            $isExpired = $dateNow > $product->tryOut->end_date;

                            $isPurchased = false;
                            if(Auth::check()){
                                $isPurchased = Auth::user()->participants->contains('tryout_id', $product->tryout_id);
                            }
                        @endphp
                        <ul class="rbt-meta mb-3">
                            <li><p class="description text-white"><i class="feather-calendar"></i>{{$tryOutDate}}</p></li>
                            <span>|</span>
                            <li><p class="description text-white"><i class="feather-book"></i>{{$totalQuestion}} Soal</p></li>
                            <span>|</span>
                            <li><p class="description text-white"><i class="feather-clock"></i>{{$totalTime}} Menit</p></li>
                        </ul>

                        {{-- <div class="rbt-meta mt-5">
                            <a class="rbt-btn btn-sm d-block text-center w-50" href="#">
                                <span class="btn-text">Kerjakan Sekarang</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area -->

    <div class="rbt-course-details-area ptb--60">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="course-details-content">
                         <!-- Start Fasilitas Box  -->
                         <div class="rbt-course-feature-box overview-wrapper rbt-shadow-box mt--30">
                            <div class="rbt-course-feature-inner">
                                <div class="section-title">
                                    <h4 class="title mb-5">Fasilitas</h4>
                                </div>
                                <div class="mb--30">
                                    <!-- Start Feture Box  -->
                                    @php
                                        $features = json_decode($product->features);
                                    @endphp
                                    <div>
                                        @if($features)
                                        <ul class="plan-offer-list">
                                            @if($features->supported != null)
                                                @foreach($features->supported as $item)
                                                <li>
                                                    <i class="feather-check"></i>
                                                    {{trim($item)}}
                                                </li>
                                                @endforeach
                                            @endif

                                            {{-- @if ($features->not_supported != null)
                                                @foreach($features->not_supported as $item)
                                                <li class="off"><i class="feather-x"></i>{{trim($item)}}</li>
                                                @endforeach
                                                
                                            @endif --}}
                                            
                                        </ul>
                                        @endif
                                    </div>
                                    <!-- End Feture Box  -->
                                </div>
                            </div>
                        </div>
                        <!-- End Fasilitas Box  -->

                         <!-- Start Subtes Detail Box  -->
                         <div class="rbt-course-feature-box overview-wrapper rbt-shadow-box mt--30">
                            <div class="rbt-course-feature-inner">
                                <div class="section-title">
                                    <h4 class="title mb-5">Subtes UTBK SNBT 2024</h4>
                                </div>
                                <div class="mb--30">
                                    @foreach ($subTestCategory as $subTest)
                                    <div class="mb-5">
                                        <h5 class="title">{{$subTest->first()->categorySubtest->name}}</h5>
                                        @foreach($subTest as $item)
                                        <!-- Start Feture Box  -->
                                        <div class="mb-3">
                                            <li>{{$item->name}}</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    {{$item->total_question}} Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    {{$item->duration}} Menit
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- End Feture Box  -->
                                        @endforeach
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Subtes Detail Box  -->
                    </div>

                </div>

             

                <div class="col-lg-4">
                    <div class="course-sidebar sticky-top rbt-shadow-box course-sidebar-top rbt-gradient-border" style="box-shadow: none">
                        <div class="inner">
                            <div class="rbt-card-img text-center py-4 height-200 bg-gradient-20 d-flex align-content-center flex-wrap justify-content-center radius-6">
                                <h1 class="color-white mb-0">
                                    {{$startDate}}
                                    <p style="font-size: 30px; font-weight: normal;">{{$startMonth}}</p>
                                </h1>
                            </div>

                            <div class="content-item-content">
                                <div class="rbt-price-wrapper mt-4 mb-2">
                                    <ul class="rbt-meta">
                                        <li><h4 class="rbt-title-style-2" style="text-transform: none;">Rp{{$price}}</h4></li>
                                        <span>|</span>
                                        <li><h4 class="rbt-title-style-2" style="text-transform: none;">{{$product->ie_gems}} IE Gems</h4></li>
                                    </ul>
                                </div>

                                <div class="mb-4">
                                    <ul class="rbt-meta">
                                        <li><i class="feather-calendar"></i>{{$tryOutDate}}</li>
                                    </ul>
                                </div>

                                @if(!$isExpired)
                                <div class="buy-now-btn">
                                    <a class="rbt-btn btn-gradient w-100 d-block text-center radius-10" @if($isPurchased) href="/tryout-saya" @else href="{{route('payment', $product->id)}}" @endif>
                                        <span class="btn-text">@if($isPurchased) Lihat Tryout Saya @else Daftar Sekarang @endif</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

     <!-- Start Call To Action  -->
     <div class="rbt-callto-action-area">
        <div class="rbt-callto-action rbt-cta-default style-4">
            <div class="container">
                <div>
                    <div class="section-title">
                        <h4 class="title mb-4">Try Out Lainnya</h4>
                    </div>
                    <div class="row g-5">
                        @foreach ($otherTryOuts as $item)
                        <!-- Start Single Event  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rbt-card event-grid-card variation-01 rbt-hover ">
                                    <div class="rbt-card-img text-center height-200 bg-gradient-20 d-flex align-content-center flex-wrap justify-content-center radius-6" style="height: 150px">
                                        <h1 class="color-white mb-0">
                                            {{date('d', strtotime($item->tryOut->start_date))}}
                                            <p style="font-size: 20px; font-weight: normal;">{{date('F Y', strtotime($item->tryOut->start_date))}}</p>
                                        </h1>
                                    </div>
                                    <div class="rbt-card-body">
                                        <h4 class="rbt-card-title" style="margin-bottom: 5px">{{$item->tryOut->name}}</h4>
                                        <ul class="rbt-meta" style="margin-bottom: 1px">
                                            <li><p>Rp{{number_format($item->price, 0, ',', '.')}}</p></li>
                                            <span>|</span>
                                            <li><p>{{$item->ie_gems}} IE Gems</p></li>
                                        </ul>
                                        <div class="mb-4">
                                            @php
                                                $startDate = date('d', strtotime($item->tryOut->start_date));
                                                $endDate = date('d F Y', strtotime($item->tryOut->end_date));
                                                $tryOutDate = $startDate . ' - ' . $endDate;
                                            @endphp
                                            <ul class="rbt-meta">
                                                <li><i class="feather-calendar"></i>{{$tryOutDate}}</li>
                                            </ul>
                                        </div>
                                    

                                    <div class="read-more-btn">
                                        <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="{{route('tryout-detail', $item->id)}}">
                                            <span class="icon-reverse-wrapper">
                                                <span class="btn-text">Daftar Sekarang</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Event  -->
                        @endforeach
                   </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Call To Action  -->
</main>
@endsection