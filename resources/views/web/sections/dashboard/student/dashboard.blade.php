@extends('web.layout-dashboard')
@section('title', 'Dashboard')
@push('css')
    <style>
        .card-caption {
            font-size: 14px;
            font-weight: 400;
            color: #6c757d;
        }

        .color-old-blue {
            color: #326595 !important;
        }

        .color-green {
            color: #327A73 !important;
        }

        .color-orange {
            color: #DC7E3F !important;
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center">Dashboard</h4>
            </div>
            <div class="row g-5">
                
                <div class="mb-3">
                    <canvas id="tryoutChart"></canvas>
                </div>
                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed" style="background: #E3EFF5;">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background: #BBD6E7;">
                                {{-- <i class="feather-book-open color-old-blue"></i> --}}
                                <img src="{{asset('/images/icons/doc-success.svg')}}" alt="">
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-old-blue"><span class="odometer" data-count="{{$finishedExams}}">{{$finishedExams}}</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block card-caption color-old-blue">Try Out Dikerjakan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed" style="background: #EFFFF6;">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background:#DFF9EA;">
                                {{-- <i class="feather-monitor color-green"></i> --}}
                                <img src="{{asset('/images/icons/doc-fail.svg')}}" alt="">
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-green"><span class="odometer" data-count="{{$unfinishedExams}}">{{$unfinishedExams}}</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block card-caption color-green">Try Out Belum Dikerjakan</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Single Card  -->

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed" style="background: #F9F0A6;">
                        <div class="inner">
                            <div class="rbt-round-icon" style="background: #F7EA86;">
                                {{-- <i class="feather-award color-orange"></i> --}}
                                <img src="{{asset('/images/icons/doc-add.svg')}}" alt="">
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-orange"><span class="odometer" data-count="{{$registeredExams}}">{{$registeredExams}}</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block card-caption color-orange">Try Out Terdaftar</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        //rata-rata nilai peserta tryout
        let tryOutAvg = @json($tryOutAvg);

        //rata-rata nilai user
        let participantScore = @json($participantScore);

        let tryOutName = [];
        let tryOutAvgScore = [];
        let participantScoreData = [];

        participantScore.forEach(participant => {
            tryOutName.push(participant.name);
            //bulatkan nilai user ke 2 angka dibelakang koma
            participantScoreData.push(Math.round(participant.average_score * 100) / 100);

            let averageScore = 0;
            tryOutAvg.forEach(avg => {
                if (participant.tryout_id === avg.tryout_id) {
                    if (avg.avg_score === null) {
                        averageScore += 0;
                    } else {
                        averageScore += avg.avg_score;
                    }
                } else {
                    averageScore += 0;
                }
            });
            //bulatkan average score ke 2 angka dibelakang koma
            averageScore = Math.round((averageScore) * 100) / 100;
            tryOutAvgScore.push(averageScore);
        });
        // console.log(tryOutAvgScore);




        const ctx = document.getElementById('tryoutChart');
    
        const data = new Chart(ctx, {
        type: 'line',
        data: {
            labels: tryOutName,
            datasets: [{
            label: 'Nilai Kamu',
            data: participantScoreData,
            borderColor: 'rgb(231, 164, 70)',
            borderWidth: 4,
            },
            {
            label: 'Nilai Rata-rata Peserta',
            data: tryOutAvgScore,
            borderColor: 'rgb(50, 101, 149)',
            borderWidth: 4,
            }]
        },
        options: {
            plugins: {
                subtitle: {
                    display: true,
                    text: 'Progress Try Out Kamu',
                    font: {
                        size: 18
                    },
                    align: 'start',
                    padding: {
                        top: 10,
                        bottom: 20,
                    }
                
            },
                tooltips: {

                }
            },
            scales: {
            y: {
                beginAtZero: false
            }
            }
        }
        });
    </script>
@endpush
