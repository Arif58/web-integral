@extends('web.layout')
@section('title', 'Tryout Integral Education')
@section('content')
<main class="rbt-main-wrapper">
    <!-- Start Banner Area -->
    <div class="rbt-banner-area rbt-banner-7 bg-gradient-18 header-transperent-spacer">
        <div class="wrapper w-100">
            <div class="container">
                <div class="row g-5 justify-content-between align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="content">
                            <div class="inner headline">
                                <h1 class="title text-white fade-in-left">Belajar Bersama Try Out UTBK Integral Education</h1>
                                <p class="description text-white fade-in-left-2" style="font-size: 20px;">
                                    Kuasai soal-soal HOTS denga mengikuti Try Out UTBK Integral Education. Dapatkan poin IE Gems setiap kali kamu mengerjakan soal.
                                </p>
                                <div class="rbt-button-group justify-content-start mt--30">
                                    <a class="rbt-btn btn-gradient fade-in-bottom" href="#tryout">
                                        <span>Daftar Sekarang</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="thumbnail-wrapper">
                            <div class="thumbnail text-end fade-in-right">
                                <img src="{{asset('images/banner/pana.svg')}}" alt="Education Images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner Area -->

    <!-- Start Service Area -->
    <div class="rbt-service-area rbt-section-gap">
        <div class="container">
            <div class="row mb--60">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2 class="title">Kenapa kamu harus pilih Try Out UTBK Integral Education</h2>
                    </div>
                </div>
            </div>
            <!-- Start Card Area -->
            <div class="row row--15 mt_dec--30">
                <!-- Start Service Grid  -->
                <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-6 col-sm-6 col-12 mt--30">
                    <div class="service-card service-card-6 bg-color bg-card-color-1">
                        <div class="inner text-center">
                            <div class="icon">
                                <img src="{{asset('images/shape/service-04.png')}}" alt="Shape Images">
                                <img class="opacity_image" src="{{asset('images/shape/service-04.png')}}" alt="Shape Images">
                            </div>
                            <div class="content">
                                <h6 class="title"><a>Soal Variatif</a></h6>
                                <p class="description">Soal soalnya variatif dan mirip dengan UTBK, karena diadaptasi dari soal tahun lalu. Kamu juga akan mendapat file pembahasan tiap paket Tryout!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Service Grid  -->

                <!-- Start Service Grid  -->
                <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-6 col-sm-6 col-12 mt--30">
                    <div class="service-card service-card-6 bg-color bg-card-color-2">
                        <div class="inner text-center">
                            <div class="icon">
                                <img src="{{asset('images/shape/service-02.png')}}" alt="Shape Images">
                                <img class="opacity_image" src="{{asset('images/shape/service-02.png')}}" alt="Shape Images">
                            </div>
                            <div class="content">
                                <h6 class="title"><a>Penilaian IRT</a></h6>
                                <p class="description">Penilaian menggunakan sistem IRT (Item Response Theory) sama seperti penilaian UTBK</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Service Grid  -->

                <!-- Start Service Grid  -->
                <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-6 col-sm-6 col-12 mt--30">
                    <div class="service-card service-card-6 bg-color bg-card-color-1">
                        <div class="inner text-center">
                            <div class="icon">
                                <img src="{{asset('images/shape/service-03.png')}}" alt="Shape Images">
                                <img class="opacity_image" src="{{asset('images/shape/service-03.png')}}" alt="Shape Images">
                            </div>
                            <div class="content">
                                <h6 class="title"><a>Rekomendasi Jurusan</a></h6>
                                <p class="description">Terdapat fitur rekomendasi jurusan sesuai dengan skor UTBK kamu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Service Grid  -->

                <!-- Start Service Grid  -->
                <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-6 col-sm-6 col-12 mt--30">
                    <div class="service-card service-card-6 bg-color bg-card-color-2">
                        <div class="inner text-center">
                            <div class="icon">
                                <img src="{{asset('images/shape/service-01.png')}}" alt="Shape Images">
                                <img class="opacity_image" src="{{asset('images/shape/service-01.png')}}" alt="Shape Images">
                            </div>
                            <div class="content">
                                <h6 class="title"><a>Perankingan</a></h6>
                                <p class="description">Terdapat sistem perankingan yang dapat menjadi pembandingmu dengan peserta Tryout lain</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Service Grid  -->
            </div>
            <!-- End Card Area -->
        </div>
    </div>
    <!-- End Service Area -->


    <!-- Start Try Out Product Area -->
    <div class="rbt-service-area bg-gradient-19-top-to-bottom rbt-section-gap" id="tryout">
        <div class="container">
            <div class="row mb--60">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2 class="title text-white">Pilih Try Out mu!</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                @foreach ($products as $product)
                @php
                    $startDate = date('d', strtotime($product->tryOut->start_date));
                    $startMonth = date('F Y', strtotime($product->tryOut->start_date));
                    $price = number_format($product->price, 0, ',', '.');
                    $endDate = date('d F Y', strtotime($product->tryOut->end_date));
                    $tryOutDate = $startDate . ' - ' . $endDate;
                    $isExpired = $dateNow > $product->tryOut->end_date;
                @endphp
                <!-- Start Single Event  -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                        <div class="rbt-card-img text-center @if($isExpired) bg-gradient-21 @else bg-gradient-20 @endif d-flex align-content-center flex-wrap justify-content-center radius-6" style="height: 150px;">
                            <div class="container text-center">
                                <h1 class="color-white mb-0">
                                    {{$startDate}}
                                    <p>{{$startMonth}}</p>
                                </h1>
                            </div>
                        </div>
                        <div class="rbt-card-body">
                            <h4 class="rbt-card-title">{{$product->tryOut->name}}</h4>
                            <ul class="rbt-meta mb-0">
                                <li><p class="description">Rp. {{$price}}</p></li>
                                <span>|</span>
                                <li><p class="description">{{$product->ie_gems}} IE Gems</p></li>
                            </ul>
                            <p class="description mb-4"><i class="feather-calendar"></i> {{$tryOutDate}}</p>
                            <div class="read-more-btn">
                                <a class="rbt-btn btn-border btn-sm radius-round" href="{{route('tryout-detail', $product->id)}}">
                                    <span class="icon-reverse-wrapper">
                                        <span class="btn-text">Daftar Sekarang</span>
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
            <div class="row">
                <div class="col-lg-12 mt--60">
                    {{$products->links('vendor.pagination.custom')}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Try Out Product Area -->

    <!-- Start Try out step Area -->
    <div class="rbt-service-area rbt-section-gap">
        <div class="container">
            <div class="row mb--60">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2 class="title">Cara Mengikut Try Out</h2>
                    </div>
                </div>
            </div>

            <div class="row g-5 hanger-line">
                <!-- Start Single Counter  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="rbt-counterup rbt-hover-03 border-bottom-gradient" style="background: #EFFFF6">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background: #DFF9EA">
                                <h3 class="mb-0">1</h3>
                            </div>
                            <div class="content">
                               
                                <span class="subtitle">Siswa melakukan registrasi akun bila belum mempunyai akun. Jika sudah mempunyai akun, siswa melakukan login.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Counter  -->

                <!-- Start Single Counter  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--60 mt_md--30 mt_sm--30 mt_mobile--60">
                    <div class="rbt-counterup rbt-hover-03 border-bottom-gradient" style="background: #F9F0A6">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background: #F7EA86">
                                <h3 class="mb-0">2</h3>
                            </div>
                            <div class="content">
                               
                                <span class="subtitle">Pilih menu “Try Out UTBK”, lalu pilih Try Out yang ingin diikuti</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Counter  -->

                <!-- Start Single Counter  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt_md--60 mt_sm--60">
                    <div class="rbt-counterup rbt-hover-03 border-bottom-gradient" style="background: #EFFFF6">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background: #DFF9EA">
                                <h3 class="mb-0">3</h3>
                            </div>
                            <div class="content">
                             
                                <span class="subtitle">Siswa membayar biaya pendaftaran menggunakan QRIS atau IE Gems.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Counter  -->

                <!-- Start Single Counter  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--60 mt_md--30 mt_sm--30 mt_mobile--60">
                    <div class="rbt-counterup rbt-hover-03 border-bottom-gradient" style="background: #F9F0A6">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background: #F7EA86">
                                <h3 class="mb-0">4</h3>
                            </div>
                            <div class="content">
                               
                                <span class="subtitle">Siswa mengerjakan Try Out di waktu yang sudah dijadwalkan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Counter  -->
            </div>
        </div>
    </div>

</main>
@endsection