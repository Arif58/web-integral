<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.layout.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .rbt-counterup {
            padding: 20px
        }

        .rbt-counterup .inner .rbt-round-icon {
            margin-bottom: 0px !important;
        }

        .rbt-counterup .inner .content .counter {
            font-weight: 400;
            font-size: 40px;
        }

        .rbt-title-style-2 {
            font-size: 14px;
            font-weight: 400;
        }

        /* .rbt-round-icon {
            margin-right: 15px !important;
            margin-left: 10px !important;
        } */

        .tryout-info {
            width: 100%;
        }

        .rbt-btn.btn-gradient {
            border-radius: 5px;
            line-height: normal;
            height: auto;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .dot {
            width: 7px; /* Ubah ukuran sesuai kebutuhan */
            height: 7px; /* Ubah ukuran sesuai kebutuhan */
            background-color: black; /* Warna titik */
            border-radius: 50%; /* Membuatnya bulat */
            /* display: inline-block; Membuatnya inline */
            margin-right: 15px; /* Memberi jarak antara titik dengan teks */
        }
    </style>
</head>
<body>
    @php
        $startDate = date('d', strtotime($participant->tryOut->start_date));
        $startMonth = date('F Y', strtotime($participant->tryOut->start_date));
        $endDate = date('d F Y', strtotime($participant->tryOut->end_date));
        $tryOutDate = $startDate . ' - ' . $endDate;
    @endphp
    <header class="rbt-header rbt-header-10">
        @include('web.layout.header-dashboard')
    </header>
    <!-- Start breadcrumb Area -->
    <div class="rbt-breadcrumb-default ptb--50 ptb_md--50 ptb_sm--30 bg-gradient-18">
        <div class="container">
            <div class="d-flex">
                <div>
                    <h3 class=" color-white mb-0">
                        <a href="/tryout-saya"><i class="feather-arrow-left"></i></a>
                    </h3> 
                </div>
                <div style="width: 100%">
                    <div>
                        <div class="breadcrumb-inner text-center">
                            <h2 class="title color-white mb-5" style="font-size: 26px">Hasil Try Out
                            </h2>
                        </div>
                </div>
                <div>
                    <div class="breadcrumb-inner text-center">
                        <h1 class="title color-white mb-5">{{$participant->tryOut->name}}
                        </h1>
                    </div>
                </div>
                <div>
                    <div class="breadcrumb-inner text-center">
                        <p class="description mb-4 text-white">
                            <i class="feather-calendar"></i> 
                            {{$tryOutDate}}
                        </p>
                    </div>
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
                    <div class="row g-5">
                        <div class="col-lg-3">
                            <!-- Start Dashboard Sidebar  -->
                            <div class="rbt-default-sidebar rbt-shadow-box" style="top: 10px;">
                                <div class="inner">
                                    <div class="content-item-content">

                                        <div class="rbt-default-sidebar-wrapper">
                                            <nav class="mainmenu-nav">
                                                <h5 class="text-center">
                                                    Nilai Kamu
                                                </h5>
                                                <div class=" bg-gradient-19-top-to-bottom mx-5 d-flex align-content-center justify-content-center" style="padding: 30px 10px; border-radius: 5px;">
                                                    <h2 class="text-center mb-0 text-white">{{$participant->average_score}}</h2>
                                                </div>
                                                <p class="text-center mb-3" style="margin-top: 20px">Nilai Rata-Rata Peserta :</p>
                                                <h3 class="text-center mb-0" style="color: #DC7E3F">
                                                    {{$averageAllParticipantScore}}
                                                </h3>
                                            </nav>

                                    
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Dashboard Sidebar  -->

                            <!-- Start Dashboard Sidebar  -->
                            <div class="rbt-default-sidebar rbt-shadow-box" style="margin-top: 30px;">
                                <div class="inner">
                                    <div class="content-item-content">

                                        <div class="rbt-default-sidebar-wrapper">
                                            <nav class="mainmenu-nav">
                                                <h5 class="text-center">
                                                    Peringkat Kamu
                                                </h5>
                                                <div class=" bg-gradient-23 mx-5 d-flex align-content-center justify-content-center" style="padding: 30px 10px; border-radius: 5px;">
                                                    <h2 class="text-center mb-0 text-white">{{$rankParticipant}}</h2>
                                                </div>
                                            </nav>

                                    
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Dashboard Sidebar  -->

                              <!-- Start Dashboard Sidebar  -->
                              <div class="rbt-default-sidebar rbt-shadow-box" style="margin-top: 30px;">
                                <div class="inner">
                                    <div class="content-item-content">

                                        <div class="rbt-default-sidebar-wrapper">
                                            <nav class="mainmenu-nav">
                                                <div style="border-bottom: 2px solid var(--color-border-2)">
                                                    <h5 class="text-center">
                                                        Target Jurusan 1
                                                    </h5>
                                                    <div class="mx-4 justify-content-center" style="padding: 10px 10px; border-radius: 5px; border: 1px solid #3D76A6; margin-bottom: 15px;">
                                                        <p class="text-center mb-2" style="font-weight: 400; color: #424242">{{$firstMajor->university->name}}</p>
                                                        <p class="text-center mb-0" style="font-weight: 300; color: #9F9F9F">{{$firstMajor->name}}</p>
                                                    </div>
                                                </div>

                                                <div style="border-bottom: 2px solid var(--color-border-2); margin-top: 15px">
                                                    <h5 class="text-center">
                                                        Target Jurusan 2
                                                    </h5>
                                                    <div class="mx-4 justify-content-center" style="padding: 10px 10px; border-radius: 5px; border: 1px solid #3D76A6; margin-bottom: 15px;">
                                                        <p class="text-center mb-2" style="font-weight: 400; color: #424242">{{$secondMajor->university->name}}</p>
                                                        <p class="text-center mb-0" style="font-weight: 300; color: #9F9F9F">{{$secondMajor->name}}</p>
                                                    </div>
                                                </div>
                                            </nav>

                                    
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Dashboard Sidebar  -->
                        </div>
                        <div class="col-lg-9">
                            <div class="content">
                                {{-- start tryout info --}}
                                <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
                                    <h5 class="rbt-title-style-3 text-center">
                                        Detail Try Out
                                    </h5>
                                    <div class="row g-5">

                                        {{-- <!-- Start Single Card  -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed" style="background: #EFFFF6;">
                                                <div class="inner d-flex">
                                                    <div class="rbt-round-icon" style="background:#DFF9EA;">
                                                        <i class=" feather-check-square" style="color: #226666"></i>
                                                    </div>
                                                    <div class="content align-content-center tryout-info">
                                                        <h3 class="counter without-icon" style="color: #226666"><span>67</span>
                                                        </h3>
                                                        <span class="rbt-title-style-2 d-block">Jumlah Soal Benar</span>
                                                    </div>
                                                </div>
                                            </div>
    
                                        </div>
                                        <!-- End Single Card  -->
    
                                        <!-- Start Single Card  -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed" style="background: #F9F0A6;">
                                                <div class="inner d-flex">
                                                    <div class="rbt-round-icon" style="background: #F7EA86;">
                                                        <i class="feather-book-open" style="color: #DC7E3F"></i>
                                                    </div>
                                                    <div class="content align-content-center tryout-info">
                                                        <h3 class="counter without-icon">
                                                            <span style="color: #DC7E3F">
                                                                {{$totalAnswered}}
                                                            </span>
                                                            <span style="color: #E7A446">
                                                                / {{$totalQuestion}}
                                                            </span>
                                                            
                                                        </h3>
                                                        <span class="rbt-title-style-2 d-block">Jumlah Soal Dikerjakan</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Card  --> --}}
                                    </div>

                                    {{-- start pembahasan soal --}}
                                    <div class="mt-5 py-4" style="border: 1px solid var(--color-border-2); border-radius: 5px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-center">
                                                    Pembahasan Soal
                                                </h5>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a class="rbt-btn btn-gradient rbt-shadow-box" href="#">
                                                    Lihat Pembahasan Soal <i class="feather-download"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- end pembahasan soal --}}

                                    {{-- start detail skor --}}
                                    <div class="mt-5">
                                        <div class="mb-5">
                                            <h5 class="mb-4">
                                                TPS (Test Potensi Skolastik)
                                            </h5>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="dot"></div>
                                                <div class="d-flex justify-content-between" style="width: 100%">
                                                    <div>Penalaran Umum</div>
                                                    <div>400</div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="dot"></div>
                                                <div class="d-flex justify-content-between" style="width: 100%">
                                                    <div>Kemampuan Kuantitatif</div>
                                                    <div>400</div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    {{-- end detail skor --}}
                                </div>
                                {{-- end tryout info --}}

                                {{-- start leaderboard --}}
                                <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
                                    <h5 class="rbt-title-style-3 text-center">
                                        Leaderboard
                                    </h5>
                                    
                                </div>
                                {{-- end leaderboard --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card Style -->
    
</body>
</html>