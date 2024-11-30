@extends('web.layout-dashboard')
@section('title', 'Pencapaian')
@push('css')

    <style>
        span {
            font-weight: bold;
        }    


        .rbt-card .rbt-card-body .rbt-card-title {
            font-size: 22px;
        }

        .rbt-card-img {
            
        }

        .progress .progress-bar{
            visibility: visible !important;
        }

        .progress {
            height: 20px;
        }

        .card-image {
            width: 190px;
        }

        .rbt-card.variation-03 {
            text-align: center;
        }
        
        .badge-active {
            border: 1px solid #70A4C6;
        }
    </style>    
@endpush
@section('content')
    <div class="content">
        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center mb--0">Pencapaian</h4>
            </div>
            <div class="container">
                <div class="row">

                    <!-- Start Single Card  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="rbt-card variation-03 rbt-hover @if($isCompletedThreeTryOuts) badge-active @endif">
                            <button class="thumbnail-link border-0" type="button" data-bs-toggle="modal" data-bs-target="#completedThreeTryOuts" data-bs-dismiss="modal" style="background: transparent;">
                            <div class="rbt-card-img">
                                <img @if($isCompletedThreeTryOuts) src="{{asset('images/badges/Badges 3x Challenger - ON.svg')}}" @else src="{{asset('images/badges/Badges 3x Challenger - OFF.svg')}}" @endif  alt="Card image">
                                    
                            </div>
                            <div class="rbt-card-body d-block">
                                <h5 class="rbt-card-title text-center" @if(!$isCompletedThreeTryOuts) style="color: gray" @endif>
                                    3x Challenger
                                </h5>
                            </div>
                        </button>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="rbt-card variation-03 rbt-hover @if($isCompletedFiveTryOuts) badge-active @endif">
                            <button class="thumbnail-link border-0" type="button" data-bs-toggle="modal" data-bs-target="#completedFiveTryOuts" data-bs-dismiss="modal" style="background: transparent;">
                            <div class="rbt-card-img">
                                    <img @if($isCompletedFiveTryOuts) src="{{asset('images/badges/Badges 5x Challenger - ON.svg')}}" @else src="{{asset('images/badges/Badges 5x Challenger - OFF.svg')}}" @endif alt="Card image">
                                    
                                </div>
                                <div class="rbt-card-body d-block">
                                    <h5 class="rbt-card-title text-center" @if(!$isCompletedFiveTryOuts) style="color: gray" @endif>
                                        5x Challenger
                                    </h5>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="rbt-card variation-03 rbt-hover @if($isScoreOneTryOutAboveSixHundredsFifty) badge-active @endif">
                            <button class="thumbnail-link border-0" type="button" data-bs-toggle="modal" data-bs-target="#sixHundredsFiftyStar" data-bs-dismiss="modal" style="background: transparent;">
                            <div class="rbt-card-img">
                                <img @if($isScoreOneTryOutAboveSixHundredsFifty) src="{{asset('images/badges/Badges 650 Star - ON.svg')}}" @else src="{{asset('images/badges/Badges 650 Star - OFF.svg')}}" @endif alt="Card image">
                                    
                            </div>
                            <div class="rbt-card-body d-block">
                                <h5 class="rbt-card-title text-center" @if(!$isScoreOneTryOutAboveSixHundredsFifty) style="color: gray" @endif>
                                    650 Star
                                </h5>
                            </div>
                        </button>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="rbt-card variation-03 rbt-hover @if($isScoreThreeTryOutsAboveSixHundredsFifty) badge-active @endif">
                            <button class="thumbnail-link border-0" type="button" data-bs-toggle="modal" data-bs-target="#sixHundredsFiftySpecialist" data-bs-dismiss="modal" style="background: transparent;">
                            <div class="rbt-card-img">
                                    <img @if($isScoreThreeTryOutsAboveSixHundredsFifty) src="{{asset('images/badges/Badges 650 Specialist - ON.svg')}}" @else src="{{asset('images/badges/Badges 650 Specialist - OFF.svg')}}" @endif alt="Card image">
                                    
                                </div>
                                <div class="rbt-card-body d-block">
                                    <h5 class="rbt-card-title text-center" @if(!$isScoreThreeTryOutsAboveSixHundredsFifty) style="color: gray" @endif>
                                        650 Specialist
                                    </h5>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="rbt-card variation-03 rbt-hover @if($isTenRankingOneTryOut) badge-active @endif">
                            <button class="thumbnail-link border-0" type="button" data-bs-toggle="modal" data-bs-target="#topTenRookie" data-bs-dismiss="modal" style="background: transparent;">
                            <div class="rbt-card-img">
                                    <img @if($isTenRankingOneTryOut) src="{{asset('images/badges/Badges Top 10 Rookie - ON.svg')}}" @else src="{{asset('images/badges/Badges Top 10 Rookie - OFF.svg')}}" @endif alt="Card image">
                                    
                                </div>
                                <div class="rbt-card-body d-block">
                                    <h5 class="rbt-card-title text-center"><a href="course-details.html" @if(!$isTenRankingOneTryOut) style="color: gray" @endif>Top 10 Rookie</a>
                                    </h5>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="rbt-card variation-03 rbt-hover @if($isTenRankingThreeTryOuts) badge-active @endif">
                            <button class="thumbnail-link border-0" type="button" data-bs-toggle="modal" data-bs-target="#topTenSpecialist" data-bs-dismiss="modal" style="background: transparent;">
                            <div class="rbt-card-img">
                                    <img @if($isTenRankingThreeTryOuts) src="{{asset('images/badges/Badges Top 10 Pro - ON.svg')}}" @else src="{{asset('images/badges/Badges Top 10 Pro - OFF.svg')}}" @endif alt="Card image">
                                    
                                </div>
                                <div class="rbt-card-body d-block">
                                    <h5 class="rbt-card-title text-center"><a href="course-details.html" @if(!$isTenRankingThreeTryOuts) style="color: gray" @endif>Top 10 Pro</a>
                                    </h5>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                </div>
            </div>
        </div>

        <!-- Start Modal 3 Try Out Completed -->
        <div class="rbt-default-modal modal fade" id="completedThreeTryOuts" tabindex="-1" aria-labelledby="completedThreeTryOutsLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header">
                        <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img @if($isCompletedThreeTryOuts) src="{{asset('images/badges/Badges 3x Challenger - ON.svg')}}" @else src="{{asset('images/badges/Badges 3x Challenger - OFF.svg')}}" @endif  alt="Card image" class="card-image">
                                
                        </div>
                       
                    </div>
                    <div class="modal-footer pt--5 justify-content-center" style="border-top: none">
                        <h5 class="rbt-card-title text-center mb-3" @if(!$isCompletedThreeTryOuts) style="color: gray" @endif>
                            Melaksanakan 3 kali TO
                        </h5>
                        @if(!$isCompletedThreeTryOuts)
                        <div class="single-progress w-100">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-19 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".0.5s" role="progressbar" style="width: {{($countCompletedTryOuts / 3) * 100 }}%;" aria-valuenow="{{$countCompletedTryOuts}}" aria-valuemin="0" aria-valuemax="3">
                                    {{$countCompletedTryOuts}}/3
                                </div>
                            </div>
                        </div>
                        @endif
                        <span class="text-center" style="font-weight: 200;">@if($isCompletedThreeTryOuts) Hebat! Kamu telah menyelesaikan 3 Try Out! @else Selesaikan 3 Try Out untuk membuka Pencapaian ini. @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal 3 Try Out Completed -->

        <!-- Start Modal 5 Try Out Completed -->
        <div class="rbt-default-modal modal fade" id="completedFiveTryOuts" tabindex="-1" aria-labelledby="completedFiveTryOutsLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header">
                        <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img @if($isCompletedFiveTryOuts) src="{{asset('images/badges/Badges 5x Challenger - ON.svg')}}" @else src="{{asset('images/badges/Badges 5x Challenger - OFF.svg')}}" @endif  alt="Card image" class="card-image">
                                
                        </div>
                       
                    </div>
                    <div class="modal-footer pt--5 justify-content-center" style="border-top: none">
                        <h5 class="rbt-card-title text-center mb-3" @if(!$isCompletedFiveTryOuts) style="color: gray" @endif>
                            Melaksanakan 5 kali TO
                        </h5>
                        @if(!$isCompletedFiveTryOuts)
                        <div class="single-progress w-100">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-19 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".0.5s" role="progressbar" style="width: {{($countCompletedTryOuts / 5) * 100 }}%;" aria-valuenow="{{$countCompletedTryOuts}}" aria-valuemin="0" aria-valuemax="5">
                                    {{$countCompletedTryOuts}}/5
                                </div>
                            </div>
                        </div>
                        @endif
                        <span class="text-center" style="font-weight: 200;">@if($isCompletedThreeTryOuts) Hebat! Kamu telah menyelesaikan 5 Try Out! @else Selesaikan 5 Try Out untuk membuka Pencapaian ini. @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal 5 Try Out Completed -->

        <!-- Start Modal 650 Star -->
        <div class="rbt-default-modal modal fade" id="sixHundredsFiftyStar" tabindex="-1" aria-labelledby="sixHundredsFiftyStarLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header">
                        <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img @if($isScoreOneTryOutAboveSixHundredsFifty) src="{{asset('images/badges/Badges 650 Star - ON.svg')}}" @else src="{{asset('images/badges/Badges 650 Star - OFF.svg')}}" @endif  alt="Card image" class="card-image">
                                
                        </div>
                       
                    </div>
                    <div class="modal-footer pt--5 justify-content-center" style="border-top: none">
                        <h5 class="rbt-card-title text-center mb-3" @if(!$isScoreOneTryOutAboveSixHundredsFifty) style="color: gray" @endif>
                            Mendapatkan rata-rata skor lebih dari 650 di 1 TO
                        </h5>
                        @if(!$isScoreOneTryOutAboveSixHundredsFifty)
                        <div class="single-progress w-100">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-19 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".0.5s" role="progressbar" style="width: {{($countTryOutsWithScoreAboveSixHundredsFifty / 1) * 100 }}%;" aria-valuenow="{{$countTryOutsWithScoreAboveSixHundredsFifty}}" aria-valuemin="0" aria-valuemax="5">
                                    {{$countTryOutsWithScoreAboveSixHundredsFifty}}/1
                                </div>
                            </div>
                        </div>
                        @endif
                        <span class="text-center" style="font-weight: 200;">@if($isScoreOneTryOutAboveSixHundredsFifty) Keren! Kamu telah mencapai nilai 650 di 1 Try Out! @else Capai nilai 650 atau lebih di 1 Try Out untuk membuka Pencapaian ini. @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal 650 Star -->

        <!-- Start Modal 650 Specialist -->
        <div class="rbt-default-modal modal fade" id="sixHundredsFiftySpecialist" tabindex="-1" aria-labelledby="sixHundredsFiftySpecialistLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header">
                        <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img @if($isScoreThreeTryOutsAboveSixHundredsFifty) src="{{asset('images/badges/Badges 650 Specialist - ON.svg')}}" @else src="{{asset('images/badges/Badges 650 Specialist - OFF.svg')}}" @endif  alt="Card image" class="card-image">
                                
                        </div>
                       
                    </div>
                    <div class="modal-footer pt--5 justify-content-center" style="border-top: none">
                        <h5 class="rbt-card-title text-center mb-3" @if(!$isScoreThreeTryOutsAboveSixHundredsFifty) style="color: gray" @endif>
                            Mendapatkan rata-rata skor lebih dari 650 di 3 TO
                        </h5>
                        @if(!$isScoreThreeTryOutsAboveSixHundredsFifty)
                        <div class="single-progress w-100">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-19 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".0.5s" role="progressbar" style="width: {{($countTryOutsWithScoreAboveSixHundredsFifty / 3) * 100 }}%;" aria-valuenow="{{$countTryOutsWithScoreAboveSixHundredsFifty}}" aria-valuemin="0" aria-valuemax="5">
                                    {{$countTryOutsWithScoreAboveSixHundredsFifty}}/3
                                </div>
                            </div>
                        </div>
                        @endif
                        <span class="text-center" style="font-weight: 200;">@if($isScoreThreeTryOutsAboveSixHundredsFifty) Keren! Kamu telah mencapai nilai 650 di 3 Try Out! @else Capai nilai 650 atau lebih di 3 Try Out untuk membuka Pencapaian ini. @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal 650 Specialist -->

        <!-- Start Modal Top 10 Rookie -->
        <div class="rbt-default-modal modal fade" id="topTenRookie" tabindex="-1" aria-labelledby="topTenRookieLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header">
                        <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img @if($isTenRankingOneTryOut) src="{{asset('images/badges/Badges Top 10 Rookie - ON.svg')}}" @else src="{{asset('images/badges/Badges Top 10 Rookie - OFF.svg')}}" @endif  alt="Card image" class="card-image">
                                
                        </div>
                       
                    </div>
                    <div class="modal-footer pt--5 justify-content-center" style="border-top: none">
                        <h5 class="rbt-card-title text-center mb-3" @if(!$isTenRankingOneTryOut) style="color: gray" @endif>
                            Mendapat peringkat 10 besar di 1 TO
                        </h5>
                        @if(!$isTenRankingOneTryOut)
                        <div class="single-progress w-100">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-19 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".0.5s" role="progressbar" style="width: {{($userHasTenRanking / 1) * 100 }}%;" aria-valuenow="{{$userHasTenRanking}}" aria-valuemin="0" aria-valuemax="1">
                                    {{$userHasTenRanking}}/1
                                </div>
                            </div>
                        </div>
                        @endif
                        <span class="text-center" style="font-weight: 200;">@if($isTenRankingOneTryOut) Keren! Kamu telah mencapai nilai 650 di 1 Try Out! @else Capai nilai 650 atau lebih di 1 Try Out untuk membuka Pencapaian ini. @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Top 10 Rookie -->

        <!-- Start Modal Top 10 Pro -->
        <div class="rbt-default-modal modal fade" id="topTenSpecialist" tabindex="-1" aria-labelledby="topTenSpecialistLabel" aria-hidden="true" style="background: transparent">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
                <div class="modal-content" style="padding: 30px">
                    <div class="modal-header">
                        <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img @if($isTenRankingThreeTryOuts) src="{{asset('images/badges/Badges Top 10 Pro - ON.svg')}}" @else src="{{asset('images/badges/Badges Top 10 Pro - OFF.svg')}}" @endif  alt="Card image" class="card-image">
                                
                        </div>
                       
                    </div>
                    <div class="modal-footer pt--5 justify-content-center" style="border-top: none">
                        <h5 class="rbt-card-title text-center mb-3" @if(!$isTenRankingThreeTryOuts) style="color: gray" @endif>
                            Mendapat peringkat 10 besar di 3 TO
                        </h5>
                        @if(!$isTenRankingThreeTryOuts)
                        <div class="single-progress w-100">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-19 wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".0.5s" role="progressbar" style="width: {{($userHasTenRanking / 3) * 100 }}%;" aria-valuenow="{{$userHasTenRanking}}" aria-valuemin="0" aria-valuemax="3">
                                    {{$userHasTenRanking}}/3
                                </div>
                            </div>
                        </div>
                        @endif
                        <span class="text-center" style="font-weight: 200;">@if($isTenRankingThreeTryOuts) Keren! Kamu telah mencapai nilai 650 di 3 Try Out! @else Capai nilai 650 atau lebih di 3 Try Out untuk membuka Pencapaian ini. @endif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Top 10 Pro -->
    </div>
@endsection

