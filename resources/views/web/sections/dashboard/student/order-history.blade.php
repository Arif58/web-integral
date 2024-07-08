@extends('web.layout-dashboard')
@section('title', 'Pencapaian')
@section('content')
    <div class="content">
        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center">Riwayat Pembelian</h4>
            </div>
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
                        @endphp
                        <!-- Start Single Event  -->
                        <div class="course-grid-2 mb-4">
                            <div class="rbt-card card-list-2 event-list-card variation-01 rbt-hover d-block">
                                {{-- <div class="rbt-card-img text-center d-flex align-content-center flex-wrap justify-content-center radius-6 bg-gradient-20">
                                    <div class="container text-center my-4">
                                        <h3 class="color-white mb-0">
                                            {{$startDate}} - {{$endDate}}
                                            <p>{{$startMonth}}</p>
                                        </h3>
                                    </div>
                                </div> --}}
                                <div class="rbt-card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div style="font-size: small">
                                            <span>Tanggal Pembelian: </span>
                                            <p style="font-size: small">{{ date('d F Y', strtotime($order->created_at)) }}</p>
                                        </div>
                                        <span class="badge @if($order->status === 'success') bg-success @elseif($order->status === 'pending') bg-warning @elseif($order->status === 'failed') bg-danger @endif align-content-center">{{$order->status}}</span>
                                    </div>
                                    {{-- <p class="description mb-4"><i class="feather-calendar"></i>{{$tryOutDate}}</p> --}}
                                    <h4 class="rbt-card-title mb--5">{{$order->product->tryOut->name}}</h4>
                                    <p class="description mb-1 mt-2">Total Harga: </p>
                                    @if($order->payment_method === 'qris')
                                    <h5>Rp{{number_format($order->total_price, 0, ',', '.');}}</h5>
                                    @else
                                    <h5>{{$order->total_price}} Gems</h5>
                                    @endif

                                    @if($order->status == 'pending' && $order->snap_token != null)
                                    <a class="rbt-btn btn-border btn-sm icon-hover radius-round text-center flex-wrap" href="{{route('payment-qris', $order->snap_token)}}" style="font-size: 14px; padding: 0px;">
                                        <span class="btn-text">Bayar</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i>
                                        </span>
                                    </a>
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