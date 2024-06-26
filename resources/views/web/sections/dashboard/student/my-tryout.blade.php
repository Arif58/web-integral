@extends('web.layout-dashboard')
@section('title', 'Try Out Saya')
@section('content')
    <div class="content">
        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center">Try Out Saya</h4>
            </div>
            @php
                $unfinishedTryOuts = $myTryOuts->where('start_test', null);
                $finishedTryOuts = $myTryOuts->where('end_test', '!=', null);
                $orderedOtherTryOuts = $otherTryOuts->sortByDesc('tryOut.start_date');
            @endphp
            <!-- Start Course Top  -->
                <div class="container">
                    <div class="rbt-sorting-list d-flex flex-wrap align-items-center justify-content-center">
                        <div class="rbt-short-item switch-layout-container border radius-round">
                            <ul class="course-switch-layout nav nav-tabs" id="rbt-myTab" role="tablist">
                                <li class="nav-item course-switch-item" role="presentation"><button class="active" id="registered-tab" data-bs-toggle="tab" data-bs-target="#registered" type="button" role="tab" aria-controls="registered" aria-selected="true"><span
                                                    class="text">Terdaftar</span></button>
                                </li>
                                <li class="nav-item course-switch-item" role="presentation"><button id="unfinished-tab" data-bs-toggle="tab" data-bs-target="#unfinished" type="button" role="tab" aria-controls="unfinished" aria-selected="false"><span
                                    class="text">Belum Dikerjakan</span></button>
                                </li>
                                <li class="nav-item course-switch-item" role="presentation"><button id="finished-tab" data-bs-toggle="tab" data-bs-target="#finished" type="button" role="tab" aria-controls="finished" aria-selected="false"><span
                                    class="text">Sudah Dikerjakan</span></button>
                                </li>
                                {{-- <li class="nav-item course-switch-item" role="presentation"><button id="others-tab" data-bs-toggle="tab" data-bs-target="#others" type="button" role="tab" aria-controls="others" aria-selected="false"><span
                                    class="text">Lainnya</span></button>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            <!-- End Course Top  -->

            <div class="container mt-5 pb-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="rbt-myTabContent">
                            {{-- tab terdaftar --}}
                            <div class="tab-pane fade show active" id="registered" role="tabpanel" aria-labelledby="registered-tab">
                                <div class="rbt-course-grid-column active-grid-view">
                                    @foreach ($myTryOuts as $item)
                                    @php
                                        $startDate = date('d', strtotime($item->tryOut->start_date));
                                        $startMonth = date('F Y', strtotime($item->tryOut->start_date));
                                        $endDate = date('d F Y', strtotime($item->tryOut->end_date));
                                        $tryOutDate = $startDate . ' - ' . $endDate;
                                        $isFinished = $item->end_test != null;
                                    @endphp
                                    <!-- Start Single Event  -->
                                    <div class="course-grid-2">
                                        <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                                            <div class="rbt-card-img text-center d-flex align-content-center flex-wrap justify-content-center radius-6 @if($isFinished) bg-gradient-21 @else bg-gradient-20 @endif">
                                                <div class="container text-center my-4">
                                                    <h1 class="color-white mb-0">
                                                        {{ $startDate }}
                                                        <p>{{$startMonth}}</p>
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="rbt-card-body">
                                                <h4 class="rbt-card-title mb--5">{{$item->tryOut->name}}</h4>
                                                <p class="description mb-4"><i class="feather-calendar"></i> {{$tryOutDate}}</p>
                                                <button class="rbt-btn btn-border btn-sm icon-hover radius-round text-center flex-wrap" href="#" style="font-size: 14px; padding: 0px;">
                                                    <span class="btn-text">@if($isFinished) Lihat Hasil @else Kerjakan Sekarang @endif</span>
                                                    <span class="btn-icon"><i class="feather-arrow-right"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach   
                                    <!-- End Single Event  -->
                                </div>
                            </div>

                            {{-- tab belum dikerjakan --}}
                            <div class="tab-pane fade" id="unfinished" role="tabpanel" aria-labelledby="unfinished-tab">
                                <div class="rbt-course-grid-column">   
                                    @foreach ($unfinishedTryOuts as $item)
                                    @php
                                        $startDate = date('d', strtotime($item->tryOut->start_date));
                                        $startMonth = date('F Y', strtotime($item->tryOut->start_date));
                                        $endDate = date('d F Y', strtotime($item->tryOut->end_date));
                                        $tryOutDate = $startDate . ' - ' . $endDate;
                                    @endphp
                                    <!-- Start Single Event  -->
                                    <div class="course-grid-2">
                                        <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                                            <div class="rbt-card-img text-center bg-gradient-20 d-flex align-content-center flex-wrap justify-content-center radius-6">
                                                <div class="container text-center my-4">
                                                    <h1 class="color-white mb-0">
                                                        {{ $startDate }}
                                                        <p>{{$startMonth}}</p>
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="rbt-card-body">
                                                <h4 class="rbt-card-title mb--5">{{$item->tryOut->name}}</h4>
                                                <p class="description mb-4"><i class="feather-calendar"></i> {{$tryOutDate}}</p>
                                                <button class="rbt-btn btn-border btn-sm icon-hover radius-round text-center flex-wrap" type="button" data-bs-toggle="modal" data-bs-target="#unfinishedModal" style="font-size: 14px; padding: 0px;" >
                                                    <span class="btn-text">Kerjakan Sekarang</span>
                                                    <span class="btn-icon"><i class="feather-arrow-right"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Event  -->
                                    @endforeach
                                </div>
                            </div>

                            {{-- tab yg sudah dikerjakan --}}
                            <div class="tab-pane fade" id="finished" role="tabpanel" aria-labelledby="finished-tab">
                                <div class="rbt-course-grid-column">
                                    @foreach ($finishedTryOuts as $item)
                                    @php
                                        $startDate = date('d', strtotime($item->tryOut->start_date));
                                        $startMonth = date('F Y', strtotime($item->tryOut->start_date));
                                        $endDate = date('d F Y', strtotime($item->tryOut->end_date));
                                        $tryOutDate = $startDate . ' - ' . $endDate;
                                    @endphp
                                    <!-- Start Single Event  -->
                                    <div class="course-grid-2">
                                        <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                                            <div class="rbt-card-img text-center bg-gradient-21 d-flex align-content-center flex-wrap justify-content-center radius-6">
                                                <div class="container text-center my-4">
                                                    <h1 class="color-white mb-0">
                                                        {{$startDate}}
                                                        <p>{{$startMonth}}</p>
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="rbt-card-body">
                                                <h4 class="rbt-card-title mb--5">{{$item->tryOut->name}}</h4>
                                                <p class="description mb-4"><i class="feather-calendar"></i> {{$tryOutDate}}</p>
                                                <a class="rbt-btn btn-border btn-sm icon-hover radius-round text-center flex-wrap" href="#" style="font-size: 14px; padding: 0px;">
                                                    <span class="btn-text">Lihat Hasil</span>
                                                    <span class="btn-icon"><i class="feather-arrow-right"></i>
                                                    </span>
                                                </a>
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
            </div>

            <div class="container mt-5">
                <div class="section-title">
                    <h4 class="rbt-title-style-3 text-center">Ikuti Try Out Lainnya</h4>
                    <div class="rbt-course-grid-column">
                        @foreach ($orderedOtherTryOuts as $index => $item)
                        @php
                            $startDate = date('d', strtotime($item->tryOut->start_date));
                            $startMonth = date('F Y', strtotime($item->tryOut->start_date));
                            $endDate = date('d F Y', strtotime($item->tryOut->end_date));
                            $tryOutDate = $startDate . ' - ' . $endDate;
                            $price = number_format($item->price, 0, ',', '.');
                        @endphp
                        <!-- Start Single Event  -->
                        <div class="course-grid-2">
                            <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                                <div class="rbt-card-img text-center bg-gradient-20 d-flex align-content-center flex-wrap justify-content-center radius-6">
                                    <div class="container text-center my-4">
                                        <h1 class="color-white mb-0">
                                            {{$startDate}}
                                            <p>{{$startMonth}}</p>
                                        </h1>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <h4 class="rbt-card-title mb--5">{{$item->tryOut->name}}</h4>
                                    <ul class="rbt-meta mb-0">
                                        <li><p class="description">Rp{{$price}}</p></li>
                                        <span>|</span>
                                        <li><p class="description">{{$item->ie_gems}} Poin</p></li>
                                    </ul>
                                    <p class="description mb-4"><i class="feather-calendar"></i> {{$tryOutDate}}</p>
                                    <button class="rbt-btn btn-border btn-sm icon-hover radius-round text-center flex-wrap" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$index}}" style="font-size: 14px; padding: 0px;" >
                                        <span class="btn-text">Daftar Sekarang</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Event  -->
                        @endforeach
                        
                    </div>
                </div> 
            </div>            
        </div>

        <!-- Start Modal Daftar -->
        @foreach ($orderedOtherTryOuts as $index => $item)    
        @php
            $startDate = date('d', strtotime($item->tryOut->start_date));
            $startMonth = date('F Y', strtotime($item->tryOut->start_date));
            $endDate = date('d F Y', strtotime($item->tryOut->end_date));
            $tryOutDate = $startDate . ' - ' . $endDate;
            $price = number_format($item->price, 0, ',', '.');
            $subTestCategory = $item->tryOut->subTests->groupBy('category_subtest_id');
        @endphp
        <div class="rbt-default-modal modal fade" id="exampleModal_{{$index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 800px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header pb--20" style="border-bottom: 1px solid">
                        <div class="rbt-card-img text-center py-4 radius-6" style="background-color: #616161; width: 50%">
                            <div class="container text-center my-4">
                                <h1 class="color-white">
                                    {{$startDate}}
                                    <p>{{$startMonth}}</p>
                                </h1>
                            </div>
                        </div>
                        <div class="container">
                            <h4 class="rbt-card-title mb--5">{{$item->tryOut->name}}</h4>
                            <ul class="rbt-meta mb-0">
                                <li><p class="description">Rp{{$price}}</p></li>
                                <span>|</span>
                                <li><p class="description">{{$item->ie_gems}} Poin</p></li>
                            </ul>
                            <p class="description mb-4"><i class="feather-calendar"></i> {{$tryOutDate}}</p>
                        </div>
                        <hr class="mt-5">
                    </div>
                    <div class="modal-body">
                        <div class="inner rbt-default-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="course-field mb--20" style="border-bottom: 1px solid #dee2e6">
                                        <div class="rbt-course-feature-inner">
                                            <div class="section-title">
                                                <h4 class="title mb-5">Fasilitas</h4>
                                            </div>
                                            <div class="mb--30">
                                                <!-- Start Feture Box  -->
                                                @php
                                                    //ubah ke array
                                                    $features = json_decode($item->features);
                                                @endphp
                                                <div>
                                                    @if($features)
                                                    <ul class="plan-offer-list">
                                                        @if($features->supported)
                                                            @foreach($features->supported as $data)
                                                            <li>
                                                                <i class="feather-check"></i>
                                                                {{trim($data)}}
                                                            </li>
                                                            @endforeach
                                                        @endif

                                                        @if ($features->not_supported)
                                                            @foreach($features->not_supported as $data)
                                                            <li class="off"><i class="feather-x"></i>{{trim($data)}}</li>
                                                            @endforeach
                                                            
                                                        @endif
                                                        
                                                    </ul>
                                                    @endif
                                                </div>
                                                <!-- End Feture Box  -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-field mb--20">
                                        <div class="rbt-course-feature-inner">
                                            <div class="section-title">
                                                <h4 class="title mb-5">Detail Try Out</h4>
                                            </div>
                                            <div class="mb--30">
                                                @foreach($subTestCategory as $subTest)
                                                <div class="mb-5">
                                                    <h5 class="title mb--10">{{$subTest->first()->categorySubtest->name}}</h5>

                                                    @foreach ($subTest as $itemSubTest)     
                                                    <!-- Start Feture Box  -->
                                                    <div class="mb-3">
                                                        <li>{{$itemSubTest->name}}</li>
                                                        <ul class="rbt-meta ms-4 mt-1">
                                                            <li>
                                                                <i class="feather-book"></i>
                                                                {{$itemSubTest->total_question}} Soal
                                                            </li>
                                                            <span>|</span>
                                                            <li>
                                                                <i class="feather-clock"></i>
                                                                {{$itemSubTest->duration}} Menit
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt--30 justify-content-center">
                        <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal">Batal</button>
                        <a href="{{route('payment', $item->id)}}"><button type="button" class="rbt-btn bg-primary btn-border btn-md radius-round-10" style="color: white">Daftar Sekarang</button></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Daftar -->
        @endforeach

        <!-- Start Modal Kerjakan  -->
        <div class="rbt-default-modal modal fade" id="unfinishedModal" tabindex="-1" aria-labelledby="unfinishedModalLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 800px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header pb--5 justify-content-center">
                        <h4 class="title">
                            Detail Try Out
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="inner rbt-default-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="course-field mb--20">
                                        <div class="rbt-course-feature-inner">
                                            <div class="mb--30">
                                                <div class="mb-5">
                                                    <h5 class="title mb--10">TPS (Tes Potensi Skolastik)</h5>
                                                    <!-- Start Feture Box  -->
                                                    <div class="mb-3">
                                                        <li>
                                                            Lorem Ipsum
                                                        </li>
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
                                                    <h5 class="title mb--10">Tes Literasi dan Penalaran Matematika</h5>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt--30 justify-content-center">
                        <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="rbt-btn btn-gradient btn-md radius-6" data-bs-toggle="modal" data-bs-target="#confirmModal" data-bs-dismiss="modal" style="color: white" >Kerjakan Sekarang</button>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Kerjakan  -->

         <!-- Start Modal Konfirmasi -->
         <div class="rbt-default-modal modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 800px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header pb--5 justify-content-center">
                        <h4 class="title">
                            Kerjakan Try Out!
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin mengerjakan sekarang? Anda tidak akan dapat kembali ke halaman sebelumnya, dan jika Anda mencoba kembali, jawaban Anda akan dikirimkan secara otomatis.</p>
                    </div>
                    <div class="modal-footer pt--30 justify-content-center" style="border-top: none">
                        <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal">Batal</button>
                        <a href="/pengerjaan-tryout"><button type="button" class="rbt-btn btn-gradient btn-md radius-6" style="color: white">Kerjakan Sekarang</button></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Konfirmasi -->
    </div>
@endsection