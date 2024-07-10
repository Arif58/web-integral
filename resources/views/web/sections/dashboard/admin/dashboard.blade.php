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
                    <canvas id="participantTryoutChart"></canvas>
                </div>
                <div class="mb-3">
                    <canvas id="totalIncome"></canvas>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        let products = @json($products);

        //grafik peserta
        let tryout = @json($tryoutParticipant);
        let tryoutNameList = [];
        let tryoutTotalParticipant = [];

        products.forEach((product) => {
            tryoutNameList.push(product.name);
            let total = 0;
            tryout.forEach((tryoutData) => {
                if (tryoutData.tryout_id === product.tryout_id) {
                    total += tryoutData.total;
                } else {
                    total += 0;
                }
            });
            tryoutTotalParticipant.push(total);
        });


        const participantTryoutChart = document.getElementById('participantTryoutChart');
        const dataParticipant = new Chart(participantTryoutChart, {
            type: 'bar',
            data: {
                labels: tryoutNameList,
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: tryoutTotalParticipant,
                    backgroundColor: 'rgb(220, 126, 63)',
                    borderWidth: 4,
                }]
            },
            options: {
                plugins: {
                    subtitle: {
                        display: true,
                        text: 'Jumlah Peserta Try Out',
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
                    beginAtZero: true
                }
                }
            }
        });


        //grafik pendapatan
        let income = @json($tryoutIncome);
        let incomeNameList = [];
        let incomeTotal = [];

        products.forEach((product) => {
            incomeNameList.push(product.name);
            let total = 0;
            income.forEach((incomeData) => {
                if (incomeData.tryout_id === product.tryout_id) {
                    total = incomeData.total;
                } else {
                    total = 0;
                }
            });
            incomeTotal.push(total);
        });

        const totalIncome = document.getElementById('totalIncome');
        const dataIncome = new Chart(totalIncome, {
            type: 'bar',
            data: {
                labels: incomeNameList,
                datasets: [{
                    label: 'Total Pendapatan',
                    data: incomeTotal,
                    backgroundColor: 'rgb(69, 143, 128)',
                    borderWidth: 4,
                }]
            },
            options: {
                plugins: {
                    subtitle: {
                        display: true,
                        text: 'Total Pendapatan Try Out',
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
                    beginAtZero: true
                }
                }
            }
        });
    </script>
@endpush
