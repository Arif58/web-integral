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
                            <li class="rbt-breadcrumb-item active" style="color: #BDBDBD">Try Out UTBK #1</li>
                        </ul>
                        <h1 class="title text-white">Try Out UTBK #1</h1>


                        <ul class="rbt-meta mb-3">
                            <li><p class="description text-white"><i class="feather-calendar"></i>4-10 April 2024</p></li>
                            <span>|</span>
                            <li><p class="description text-white"><i class="feather-book"></i>155 Soal</p></li>
                            <span>|</span>
                            <li><p class="description text-white"><i class="feather-clock"></i>195 Menit</p></li>
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
                                    <div>
                                        <ul class="plan-offer-list">
                                            <li><i class="feather-check"></i>Become an advanced, confident, and
                                                modern
                                                JavaScript developer from scratch.</li>
                                            <li><i class="feather-check"></i>Have an intermediate skill level of
                                                Python
                                                programming.</li>
                                            <li><i class="feather-check"></i>Have a portfolio of various data
                                                analysis
                                                projects.</li>
                                            <li><i class="feather-check"></i>Use the numpy library to create and
                                                manipulate
                                                arrays.</li>
                                            <li class="off"><i class="feather-x"></i>Lorem ipsum dolor sit amet </li>
                                            <li class="off"><i class="feather-x"></i>Lorem ipsum dolor sit amet </li>
                                        </ul>
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
                                    <div class="mb-5">
                                        <h5 class="title">TPS (Tes Potensi Skolastik)</h5>
                                        <!-- Start Feture Box  -->
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <!-- End Feture Box  -->
                                    </div>
                                    

                                    <div>
                                        <h5 class="title">Tes Literasi dan Penalaran Matematika</h5>
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <li>Lorem Ipsum</li>
                                            <ul class="rbt-meta ms-4 mt-1">
                                                <li>
                                                    <i class="feather-book"></i>
                                                    30 Soal
                                                </li>
                                                <span>|</span>
                                                <li>
                                                    <i class="feather-clock"></i>
                                                    50 Menit
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Subtes Detail Box  -->
                    </div>

                </div>

             

                <div class="col-lg-4">
                    <div class="course-sidebar sticky-top rbt-shadow-box course-sidebar-top rbt-gradient-border" style="box-shadow: none">
                        <div class="inner">
                            <div class="rbt-card-img text-center py-4 height-200 bg-color-gray radius-6 d-flex justify-content-center">
                                <h1 class="color-black rbt-title-style-2 my-auto" style="font-size: 30px">
                                    Try Out UTBK #1
                                </h1>
                            </div>

                            <div class="content-item-content">
                                <div class="rbt-price-wrapper mt-4 mb-2">
                                    <ul class="rbt-meta">
                                        <li><h4 class="rbt-title-style-2">Rp 10.000</h4></li>
                                        <span>|</span>
                                        <li><h4 class="rbt-title-style-2">10 Poin</h4></li>
                                    </ul>
                                </div>

                                <div class="mb-4">
                                    <ul class="rbt-meta">
                                        <li><i class="feather-calendar"></i>4 - 10 April 2024</li>
                                    </ul>
                                </div>

                                <div class="buy-now-btn">
                                    <a class="rbt-btn btn-gradient w-100 d-block text-center radius-10" href="/payment">
                                        <span class="btn-text">Daftar Sekarang</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    </a>
                                </div>
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
                        <!-- Start Single Event  -->
                       <div class="col-lg-4 col-md-6 col-12">
                           <div class="rbt-card event-grid-card variation-01 rbt-hover">
                                <div class="rbt-card-img text-center py-4 bg-color-gray d-flex justify-content-center radius-6" style="height: 150px">
                                    <h1 class="color-black rbt-title-style-2 my-auto" style="font-size: 40px">
                                        TO #2
                                    </h1>
                                </div>
                                <div class="rbt-card-body">
                                    <h4 class="rbt-card-title" style="margin-bottom: 5px">Try Out UTBK #2</h4>
                                    <ul class="rbt-meta" style="margin-bottom: 1px">
                                        <li><p>Rp10.000</p></li>
                                        <span>|</span>
                                        <li><p>10 Poin</p></li>
                                    </ul>
                                    <div class="mb-4">
                                        <ul class="rbt-meta">
                                            <li><i class="feather-calendar"></i>4 - 10 April 2024</li>
                                        </ul>
                                    </div>
                                   

                                   <div class="read-more-btn">
                                       <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="event-details.html">
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

                        <!-- Start Single Event  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rbt-card event-grid-card variation-01 rbt-hover">
                                 <div class="rbt-card-img text-center py-4 bg-color-gray d-flex justify-content-center radius-6" style="height: 150px">
                                     <h1 class="color-black rbt-title-style-2 my-auto" style="font-size: 40px">
                                         TO #2
                                     </h1>
                                 </div>
                                 <div class="rbt-card-body">
                                     <h4 class="rbt-card-title" style="margin-bottom: 5px">Try Out UTBK #2</h4>
                                     <ul class="rbt-meta" style="margin-bottom: 1px">
                                         <li><p>Rp10.000</p></li>
                                         <span>|</span>
                                         <li><p>10 Poin</p></li>
                                     </ul>
                                     <div class="mb-4">
                                         <ul class="rbt-meta">
                                             <li><i class="feather-calendar"></i>4 - 10 April 2024</li>
                                         </ul>
                                     </div>
                                    
 
                                    <div class="read-more-btn">
                                        <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="event-details.html">
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

                         <!-- Start Single Event  -->
                       <div class="col-lg-4 col-md-6 col-12">
                        <div class="rbt-card event-grid-card variation-01 rbt-hover">
                             <div class="rbt-card-img text-center py-4 bg-color-gray d-flex justify-content-center radius-6" style="height: 150px">
                                 <h1 class="color-black rbt-title-style-2 my-auto" style="font-size: 40px">
                                     TO #2
                                 </h1>
                             </div>
                             <div class="rbt-card-body">
                                 <h4 class="rbt-card-title" style="margin-bottom: 5px">Try Out UTBK #2</h4>
                                 <ul class="rbt-meta" style="margin-bottom: 1px">
                                     <li><p>Rp10.000</p></li>
                                     <span>|</span>
                                     <li><p>10 Poin</p></li>
                                 </ul>
                                 <div class="mb-4">
                                     <ul class="rbt-meta">
                                         <li><i class="feather-calendar"></i>4 - 10 April 2024</li>
                                     </ul>
                                 </div>
                                

                                <div class="read-more-btn">
                                    <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="event-details.html">
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
                   </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Call To Action  -->
</main>
@endsection