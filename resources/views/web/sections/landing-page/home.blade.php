@extends('web.layout')
@section('title', 'Home')
@section('content')
    <main class="rbt-main-wrapper">
        <!-- Start Banner Area -->
        <div class="rbt-banner-area rbt-banner-7 bg-gradient-1 theme-shape header-transperent-spacer">
            <div class="wrapper w-100">
                <div class="container">
                    <div class="row g-5 justify-content-between align-items-center">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="content">
                                <div class="inner">
                                    <h1 class="title">Lorem Ipsum</h1>
                                    <p class="description">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi, quas dolorem! Iure aliquid quidem nisi ad esse ex fugiat, aliquam debitis provident dolorem, vitae tenetur autem enim amet placeat adipisci!
                                    </p>
                                    <div class="rbt-button-group justify-content-start mt--30">
                                        <a class="rbt-btn btn-gradient" href="#">
                                            <span>Daftar Sekarang</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="thumbnail-wrapper">
                                <div class="thumbnail text-end">
                                    <img src="{{asset('images/banner/language-club.png')}}" alt="Education Images">
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
                <div class="row g-5">
                    <!-- Start Service Grid  -->
                    <div class="col-lg-2 col-xl-2 col-xxl-2 col-md-3 col-sm-4 col-6">
                        <div class="service-card service-card-5 variation-2">
                            <div class="inner">
                                <div class="icon">
                                    <a href="#"><img src="{{ asset('images/category/image/web-design.jpg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Bimbel SD</a></h6>
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
                                    <a href="#"><img src="{{ asset("images/category/image/graphic-design.jpg") }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Bimbel SMP</a></h6>
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
                                    <a href="#"><img src="{{ asset('images/category/image/software.jpg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Bimbel SMA</a></h6>
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
                                    <a href="#"><img src="{{ asset('images/category/image/mobile.jpg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Bimbel UTBK</a></h6>
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
                                    <a href="#"><img src="{{ asset('images/category/image/finance.jpg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Bimbel Ujian Mandiri</a></h6>
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
                                    <a href="#"><img src="{{ asset('images/category/image/arts.jpg') }}" alt="Shape Images"></a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="#">Bimbel Mahasiswa</a></h6>
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
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-01.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Martha Maldonado</h5>
                                        <span>Executive Chairman <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">After the launch, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
 
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-07.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Mildred W. Diaz</h5>
                                        <span>Executive Officer <i>@ Yelp</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Online leaning, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-08.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Christopher H. Win</h5>
                                        <span>Product Designer <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Remote learning, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-01.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Martha Maldonado</h5>
                                        <span>Executive Chairman <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">University managemnet, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
                </div>
            </div>
    
            <div class="scroll-animation-wrapper mt--30">
                <div class="scroll-animation scroll-left-right">
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-01.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Martha Maldonado</h5>
                                        <span>Executive Chairman <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">After the launch, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-02.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Michael D. Lovelady</h5>
                                        <span>CEO <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Histudy education, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-03.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Valerie J. Creasman</h5>
                                        <span>Executive Designer <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Our educational, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-04.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Hannah R. Sutton</h5>
                                        <span>Executive Chairman <i>@ Facebook</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">People says about, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-05.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Pearl B. Hill</h5>
                                        <span>Chairman SR <i>@ Facebook</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Like this histudy, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-06.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Mandy F. Wood</h5>
                                        <span>SR Designer <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Educational template, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-07.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Mildred W. Diaz</h5>
                                        <span>Executive Officer <i>@ Yelp</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Online leaning, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-08.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Christopher H. Win</h5>
                                        <span>Product Designer <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">Remote learning, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
    
                    <!-- Start Single Testimonial  -->
                    <div class="single-column-20">
                        <div class="rbt-testimonial-box">
                            <div class="inner">
                                <div class="clint-info-wrapper">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/client-01.png" alt="Clint Images">
                                    </div>
                                    <div class="client-info">
                                        <h5 class="title">Martha Maldonado</h5>
                                        <span>Executive Chairman <i>@ Google</i></span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="subtitle-3">University managemnet, vulputate at sapien sit amet,
                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus velit.</p>
                                    <a class="rbt-btn-link" href="#">Read Project Case Study<i
                                    class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            {{-- <p class="description has-medium-font-size mt--20">There are many variations of passages of the
                                Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="row row--15 mt_dec--30">
                    <!-- Start Single Team  -->
                    <div class="col-lg-4 col-md-6 col-12 mt--30">
                        <div class="rbt-team team-style-default style-three rbt-hover">
                            <div class="inner">
                                <div class="thumbnail"><img src="{{asset("images/team/team-07.jpg")}}" alt="Corporate Template"></div>
                                <div class="content">
                                    <h2 class="title">Alejandro</h2>
                                    <h6 class="subtitle theme-gradient">Math Teacher</h6>
                                    <span class="team-form">
                            <i class="feather-map-pin"></i>
                            <span class="location">CO Miego, AD,USA</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team  -->
    
                    <!-- Start Single Team  -->
                    <div class="col-lg-4 col-md-6 col-12 mt--30">
                        <div class="rbt-team team-style-default style-three rbt-hover">
                            <div class="inner">
                                <div class="thumbnail"><img src="{{ asset("images/team/team-08.jpg") }}" alt="Corporate Template"></div>
                                <div class="content">
                                    <h2 class="title">John Due</h2>
                                    <h6 class="subtitle theme-gradient">Depertment Head</h6>
                                    <span class="team-form">
                            <i class="feather-map-pin"></i>
                            <span class="location">CO Miego, AD,USA</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team  -->
    
                    <!-- Start Single Team  -->
                    <div class="col-lg-4 col-md-6 col-12 mt--30">
                        <div class="rbt-team team-style-default style-three rbt-hover">
                            <div class="inner">
                                <div class="thumbnail"><img src="{{ asset("images/team/team-09.jpg") }}" alt="Corporate Template"></div>
                                <div class="content">
                                    <h2 class="title">Joo Bieden</h2>
                                    <h6 class="subtitle theme-gradient">Math Teacher</h6>
                                    <span class="team-form">
                            <i class="feather-map-pin"></i>
                            <span class="location">CO Miego, AD,USA</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Team  -->
                </div>
    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="load-more-btn mt--60 text-center">
                            <a class="rbt-btn rbt-marquee-btn" href="#">
                                <span data-text="View All Teacher">
                                    View All Teacher
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <!-- End Prestasi Area  -->

        <!-- Start About Us Area  -->
        <div class="rbt-about-area about-style-1 bg-color-extra2 rbt-section-gap">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <img src="{{ asset("images/about/about-06.png") }}" alt="About Images">
                        </div>
                    </div>
                    <div class="col-lg-6" >
                        <div class="inner pl--50 pl_sm--5">
                            <div class="section-title text-start">
                                <span class="subtitle bg-primary-opacity">About Integral Education</span>
                                <h2 class="title">Apa itu Integral Education?</h2>
                                <p class="description mt--20">Integral Education memfasilitasi siswa SD, SMP, SMA, dan Mahasiswa dalam mempersiapkan kegiatan belajar menghadapi ujian, olimpiade, dan persiapan masuk PTN bagi siswa SMA. Integral Education telah meluluskan puluhan siswa SMA ke perguruan tinggi diantaranya UI, UGM, IPB, UNDIP, UNPAD, dan lain-lain.</p>
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
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--30">
                        <div class="team">
                            <div class="thumbnail"><img src="{{ asset("images/team/team-05.jpg") }}"  alt="Blog Images">
                            </div>
                            <div class="content">
                                <h4 class="title">Aaron Griffin</h4>
                                <p class="designation">Depertment Head</p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team  -->
    
                    <!-- Start Single Team  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--30">
                        <div class="team">
                            <div class="thumbnail"><img src="{{ asset("images/team/team-09.jpg") }}"  alt="Blog Images">
                            </div>
                            <div class="content">
                                <h4 class="title">Rafiq Bali</h4>
                                <p class="designation">Depertment Head</p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team  -->
    
                    <!-- Start Single Team  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--30">
                        <div class="team">
                            <div class="thumbnail"><img src="{{ asset("images/team/team-03.jpg") }}"  alt="Blog Images">
                            </div>
                            <div class="content">
                                <h4 class="title">Fatima Usa</h4>
                                <p class="designation">Depertment Head</p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team  -->
    
                    <!-- Start Single Team  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt--30">
                        <div class="team">
                            <div class="thumbnail"><img src="{{ asset("images/team/team-03.jpg") }}"  alt="Blog Images">
                            </div>
                            <div class="content">
                                <h4 class="title">John Due</h4>
                                <p class="designation">Depertment Head</p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Team  -->
    
                </div>
            </div>
        </div>
        <!-- End Tutor Area  -->

        <!-- Start Flow Pendaftaran Area  -->
        <div class="rbt-advance-tab-area rbt-section-gapTop bg-color-white">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title">Alur Pendaftaran</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 mt_md--30 mt_sm--30 order-2 order-lg-1">
                        <div class="advance-tab-button advance-tab-button-1">
                            <ul class="nav nav-tabs tab-button-list" id="aboutmyTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#" class="nav-link tab-button active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">
                                        <div class="tab">
                                            <h4 class="title">Alur Pendaftaran Bimbel Offline & Online</h4>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#" class="nav-link tab-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                        <div class="tab">
                                            <h4 class="title">Alur Pendaftaran Try Out UTBK</h4>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12 order-1 order-lg-2">
                        <div class="tab-content">
                            <div class="tab-pane fade advance-tab-content-1 active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset("images/tab/tabs-03.jpg")}}"alt="advance-tab-image">
                                </div>

                            </div>
                            <div class="tab-pane fade advance-tab-content-1" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset("images/tab/tabs-02.jpg")}}"alt="advance-tab-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Flow Pendaftaran Tab  -->

        
    </main>
@endsection