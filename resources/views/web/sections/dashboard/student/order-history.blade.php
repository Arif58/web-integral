@extends('web.layout-dashboard')
@section('title', 'Pencapaian')
@section('content')
    <div class="content">
        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center">Riwayat Pembelian</h4>
            </div>
            @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span>{{ session('status') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach ($orders as $order)
                        @php
                            $startDate = date('d', strtotime($order->product->tryOut->start_date));
                            $startMonth = date('F Y', strtotime($order->product->tryOut->start_date));
                            $endDate = date('d', strtotime($order->product->tryOut->end_date));
                            $tryOutDate = $startDate . ' - ' . $endDate;
                            // $isFinished = $item->end_test != null;

                            //menampilkan tanggal dan waktu
                            // $expiredDate = date('d F Y ', strtotime($order->expired_at));
                            $isExpired = $order->expired_at < $dateTimeNow;

                            $expiredDate = date('d F Y H:i', strtotime($order->expired_at));
                        @endphp
                        <!-- Start Single Event  -->
                        <div class="course-grid-2 mb-4">
                            <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover">
                                <div class="rbt-card-img text-center d-flex align-content-center flex-wrap justify-content-center radius-6 bg-gradient-20" style="height: 140px;">
                                    <div class="container text-center my-4">
                                        <h3 class="color-white mb-0">
                                            {{$startDate}} 
                                            <p>{{$startMonth}}</p>
                                        </h3>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div style="font-size: small">
                                            <span>Tanggal Pembelian: </span>
                                            <span style="font-size: small">{{ date('d F Y H:i', strtotime($order->created_at)) }}</span>
                                        </div>
                                        <span class="badge 
                                        @if($order->status === 'success') bg-success 
                                        @elseif($order->status === 'pending') 
                                            @if ($isExpired)
                                                bg-danger
                                            @else
                                                bg-warning
                                            @endif
                                        @elseif($order->status === 'failed') bg-danger 
                                        @endif align-content-center">@if($isExpired) Failed @else{{$order->status}} @endif</span>
                                    </div>
                                    {{-- <p class="description mb-4"><i class="feather-calendar"></i>{{$tryOutDate}}</p> --}}
                                    <h4 class="rbt-card-title mb--5">{{$order->product->tryOut->name}}</h4>
                                    {{-- <div class="d-flex justify-content-end">
                                    </div> --}}
                                    <p class="description mb-1 mt-2">Total Harga: </p>
                                    @if($order->payment_method === 'qris')
                                    <h5>Rp{{number_format($order->total_price, 0, ',', '.');}}</h5>
                                    @else
                                    <h5>{{$order->total_price}} Gems</h5>
                                    @endif

                                    @if($order->status == 'pending' && $order->snap_token != null)
                                        @if (!$isExpired)
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="font-size: small">
                                            <span>Batas Waktu Pembayaran: </span>
                                            <span>{{ $expiredDate }}</span>
                                        </div>
                                        
                                        <a class="rbt-btn btn-border btn-sm icon-hover radius-round text-center flex-wrap" href="{{route('payment-qris', $order->snap_token)}}" style="font-size: 14px; padding: 0px;">
                                            <span class="btn-text">Bayar</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i>
                                            </span>
                                        </a>
                                        @endif

                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Single Event  -->
                        @endforeach
                    </div>
                    <div>
                        {{$orders->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection