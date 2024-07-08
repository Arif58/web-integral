@extends('web.layout')
@section('title', 'Beranda')
@section('content')
    <main class="rbt-main-wrapper">
        <!-- Start Banner Area -->
        <div class="rbt-banner-area rbt-banner-7 bg-gradient-18 header-transperent-spacer">
            <div class="wrapper w-100">
                <div class="container">
                    <div class="row g-5 justify-content-between align-items-center">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="content">
                                <div class="inner">
                                    <h1 class="title text-white">Sukses UTBK-SNBT Bersama Try Out Integral Education</h1>
                                    <p class="description text-white">
                                        Persiapkan dirimu dalam menghadapi UTBK-SNBT dengan mengikuti Try Out Integral Education!
                                    </p>
                                    <div class="rbt-button-group justify-content-start mt--30">
                                        <a class="rbt-btn btn-gradient" href="/try-out-utbk#tryout">
                                            <span>Daftar Try Out Sekarang</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail text-end">
                                    <img src="{{asset('images/banner/pana.svg')}}" alt="Education Images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->

        <!-- Start Category Area  -->
        <div class="rbt-category-area bg-color-white rbt-section-gapTop">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Start Service Grid  -->
                    <div class="col-lg-2 col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6">
                        <div class="service-card service-card-5 variation-2">
                            <div class="inner">
                                <div class="icon">
                                    <a><img src="{{ asset('images/icons/sd.svg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title">Bimbel SD</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Grid  -->

                    <!-- Start Service Grid  -->
                    <div class="col-lg-2 col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6">
                        <div class="service-card service-card-5 variation-2">
                            <div class="inner">
                                <div class="icon">
                                    <a><img src="{{ asset("images/icons/smp.svg") }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title">Bimbel SMP</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Grid  -->

                    <!-- Start Service Grid  -->
                    <div class="col-lg-2 col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6">
                        <div class="service-card service-card-5 variation-2">
                            <div class="inner">
                                <div class="icon">
                                    <a><img src="{{ asset('images/icons/sma.svg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title">Bimbel SMA</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Grid  -->

                    <!-- Start Service Grid  -->
                    <div class="col-lg-2 col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6">
                        <div class="service-card service-card-5 variation-2">
                            <div class="inner">
                                <div class="icon">
                                    <a><img src="{{ asset('images/icons/utbk.svg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title">Bimbel UTBK</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Grid  -->

                    <!-- Start Service Grid  -->
                    <div class="col-lg-2 col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6">
                        <div class="service-card service-card-5 variation-2">
                            <div class="inner">
                                <div class="icon">
                                    <a><img src="{{ asset('images/icons/mahasiswa.svg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title">Bimbel Mahasiswa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Grid  -->
                </div>
            </div>
        </div>
        <!-- End Category Area  -->

        <!-- Start Testimonial Area  -->
        <div class="rbt-testimonial-area bg-color-white rbt-section-gap overflow-hidden">
            {{-- <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center">
                                <span class="subtitle bg-primary-opacity">EDUCATION FOR EVERYONE</span>
                                <h2 class="title">People like histudy education. <br /> No joking - here’s the proof!</h2>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="scroll-animation-wrapper mt--50">
                <div class="scroll-animation scroll-right-left">
    
                    <!-- Start Single Testimonial  -->
                    @foreach ($testimonialHighlightRowOne as $item)
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="{{ asset('storage/'.$item->photo)}}" alt="Testimoni Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">{{ $item->name }}</h5>
                                        <span>{{ $item->major }}</span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">{{ $item->testimonials }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- End Single Testimonial  -->
                </div>
            </div>
    
            <div class="scroll-animation-wrapper mt--30">
                <div class="scroll-animation scroll-left-right">
                    
                    <!-- Start Single Testimonial  -->
                    @foreach ($testimonialHighlightRowOne as $item)
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="{{ asset('storage/'.$item->photo)}}" alt="Testimoni Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">{{ $item->name }}</h5>
                                        <span>{{ $item->major }}</span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">{{ $item->testimonials }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                    <!-- End Single Testimonial  -->
                </div>
            </div>
        </div>
        <!-- End Testimonial Area  -->

        <!-- Start Prestasi Area  -->
        <div class="rbt-team-area bg-color-white rbt-section-gap">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title">Prestasi Siswa</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="swiper event-activation-1 rbt-arrow-between rbt-dot-bottom-center pb--60 icon-bg-primary">

                            <div class="swiper-wrapper">
                                <!-- Start Single Slide  -->
                                @foreach ($studentAchievementsHighlight as $item)
                                <div class="swiper-slide">
                                    <div class="single-slide">
                                         <!-- Start Single Team  -->
                                        <div class="">
                                            <div class="rbt-team team-style-default style-three rbt-hover">
                                                <div class="inner">
                                                    <div class="thumbnail"><img src="{{ asset('storage/'.$item->photo)}}" alt="Corporate Template" style="height: 360px;" loading="lazy"></div>
                                                    <div class="content">
                                                        <h2 class="title" style="font-size: 24px;">{{$item->name}}</h2>
                                                        <h6 class="subtitle">{{$item->achievement}}</h6>
                                                        <span class="team-form">
                                                        {{ $item->school }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Team  -->
                                    </div>
                                </div>
                                @endforeach
                              
                            </div>
                            <div class="rbt-swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Prestasi Area  -->

        <!-- Start About Us Area  -->
        <div class="rbt-about-area about-style-1 bg-gradient-18 rbt-section-gap">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <img src="{{ asset("images/banner/about.svg") }}" alt="About Images" loading="lazy">
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="inner pl--50 pl_sm--5">
                            <div class="section-title text-start">
                                <span class="subtitle bg-primary-opacity">About Integral Education</span>
                                <h2 class="title text-white">Apa itu Integral Education?</h2>
                                <p class="description mt--20" style="color: #E0E0E0">Integral Education memfasilitasi siswa SD, SMP, SMA, dan Mahasiswa dalam mempersiapkan kegiatan belajar menghadapi ujian, olimpiade, dan persiapan masuk PTN bagi siswa SMA. Integral Education telah meluluskan puluhan siswa SMA ke perguruan tinggi diantaranya UI, UGM, IPB, UNDIP, UNPAD, dan lain-lain.</p>
                                <div class="read-more-btn mt--40">
                                    <a class="rbt-btn btn-gradient radius-round rbt-marquee-btn marquee-text-y" href="#">
                                        <span data-text="More About Us">
                                    More About Us
                                </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Us Area  -->

        <!-- Start Tutor Area  -->
        <div class="rbt-team-area bg-color-extra2 rbt-section-gap">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title">Meet Our Tutor</h2>
                            {{-- <p class="description has-medium-font-size mt--20">There are many variations of passages of the
                                Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="row row--15 mt_dec--30">
                    <!-- Start Single Team  -->
                    @foreach ($tutorHighlight as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--30">
                        <div class="team">
                            <div class="thumbnail"><img src="{{ asset('storage/'.$item->photo)}}" alt="Foto Tutor" style="height: 400px;" loading="lazy">
                            </div>
                            <div class="content">
                                <h4 class="title">{{$item->name}}</h4>
                                <p class="designation mb--0 mt-2">{{$item->position}}</p>
                                <p class="designation" style="font-size: 11px;">{{$item->education}}</p>
                            </div>
                            {{-- <ul class="social-icon">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                    @endforeach
    
                </div>
            </div>
        </div>
        <!-- End Tutor Area  -->

        <!-- Start Flow Pendaftaran Area  -->
        <div class="rbt-advance-tab-area rbt-section-gap bg-color-white">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title">Alur Pendaftaran</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 mt_md--30 mt_sm--30 order-2 order-lg-1">
                        <div class="advance-tab-button advance-tab-button-1">
                            <ul class="nav nav-tabs tab-button-list" id="aboutmyTab" role="tablist">
                                <li class="nav-item w-100" role="presentation">
                                    <a href="#" class="nav-link tab-button active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">
                                        <div class="tab">
                                            <h4 class="title">Alur Pendaftaran Bimbel Offline & Online</h4>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item w-100" role="presentation">
                                    <a href="#" class="nav-link tab-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                        <div class="tab">
                                            <h4 class="title">Alur Pendaftaran Try Out UTBK</h4>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-12 order-1 order-lg-2" style="padding-right: 0px">
                        <div class="tab-content">
                            <div class="tab-pane fade advance-tab-content-1 active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset("images/tab/tabs-03.jpg")}}"alt="advance-tab-image" loading="lazy">
                                </div>

                            </div>
                            <div class="tab-pane fade advance-tab-content-1" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset("images/tab/tabs-02.jpg")}}"alt="advance-tab-image" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Flow Pendaftaran Tab  -->

         <!-- Start Course Content  -->
         <div class="container rbt-section-gapBottom">
            <div class="row mb--60">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2 class="title">Frequently Asked Question</h2>
                    </div>
                </div>
            </div> 
            <div class="course-content rbt-shadow-box mt--60">
                <div class="rbt-accordion-style rbt-accordion-02 accordion mt--45">
                    <div class="accordion" id="accordionExampleb2">
                        @foreach ($faqs as $key => $item)
                        <div class="accordion-item card">
                            <h2 class="accordion-header card-header" id="heading_{{$key}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$key}}" aria-expanded="false" aria-controls="collapse_{{$key}}">
                                    {{ $item->question }}
                                </button>
                            </h2>
                            <div id="collapse_{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$key}}" data-bs-parent="#accordionExampleb2">
                                <div class="accordion-body card-body">
                                    <p class="faq">{{ $item->answer }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
         </div>
      
        <!-- End Course Content  -->

        
    </main>
@endsection