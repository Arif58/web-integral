@extends('web.layout')
@section('title', 'Pembayaran')
@section('content')
<main class="rbt-main-wrapper">
    <!-- Start Breadcrumb Area -->
    <div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-22">
        <div class="container">
            <div class="d-flex">
                <div>
                    <h3>
                        <a href="/tryout-saya"><i class="feather-arrow-left"></i></a>
                    </h3>
                </div>

                <div style="width: 100%">
                    <div class="breadcrumb-inner text-center">
                        <h2 class="title"><i class="feather-shopping-cart"></i></h2>
                    </div>

                    <div class="breadcrumb-inner text-center">
                        <h2 class="title">Pembelian Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{route('checkout')}}" method="post">
        @csrf
        <div class="checkout_area bg-color-white rbt-section-gap">
            <div class="container">
                <div class="row g-5 checkout-form">

                    <div class="col-lg-8">
                        <div class="checkout-content-wrapper">

                            <!-- Billing Address -->
                            <div id="billing-form">
                                <h4 class="checkout-title">Data Diri</h4>

                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="fullname" value="{{$user->fullname}}">
                                    <input type="hidden" name="phone" value="{{$user->phone}}">

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Nama Lengkap</label>
                                        <input type="text" value="{{$user->fullname}}" disabled>
                                    </div>

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Username</label>
                                        <input type="text" value="{{$user->username}}" disabled>
                                    </div>

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Email</label>
                                        <input type="email" value="{{$user->email}}" disabled>
                                    </div>

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Nomor Handphone</label>
                                        <input type="text" value="{{$user->phone}}" disabled>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="checkout-content-wrapper mt-5">
                            <h4 class="checkout-title">Opsi Pembayaran</h4>
                            <div class="row">
                                <div class="col-12 mb--20">
                                    <div class="rbt-accordion-style rbt-accordion-04 accordion">
                                        <div class="accordion single-method" id="accordionExampleb2">
                                            <div class="accordion-item card">
                                                <h2 class="row accordion-header card-header pr--15">
                                                    <input type="radio" name="payment_method" id="ie_gems" value="ie_gems">
                                                    <label for="ie_gems">
                                                        <img src="{{asset('images/icons/diamond.svg')}}" alt="" style="width: 50px; height: 30px;" class="mx-3">IE Gems
                                                    </label>
                                                    <div style="font-size: 12px; font-weight: 200; padding-left: 90px;">Jumlah IE Gems : {{$user->ie_gems}}</div>
                                                </h2>
                                            </div>

                                            <div class="accordion-item card">
                                                <h2 class="row accordion-header card-header pr--15">
                                                    <input type="radio" name="payment_method" id="qris" value="qris">
                                                    <label for="qris">
                                                        <img src="{{asset('images/icons/logo-qris.svg')}}" alt="" style="width: 50px;" class="mx-3">qris
                                                    </label>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <!-- Cart Total -->
                            <div class="col-12">
                                <div class="checkout-cart-total">

                                    <h4 class="checkout-title">Ringkasan Pembelian</h4>
                                    @php
                                        $startDate = date('d', strtotime($product->tryOut->start_date));
                                        $endDate = date('d F Y', strtotime($product->tryOut->end_date));
                                        $tryOutDate = $startDate . ' - ' . $endDate;
                                    @endphp
                                    <ul>
                                        <li class="mb-0" style="font-size: 16px; font-weight: normal;">{{$product->tryOut->name}} <span id="price"></span></li>
                                        <li class="mt-0" style="font-size: 12px; font-weight: 100;"><i class="feather-calendar me-2"></i>{{$tryOutDate}}</li>
                                    </ul>

                                    <p style="border-bottom-width: 0px; font-size: 18px; font-weight: normal;">Total <span style="font-size: 20px" id="price"></span></p>
                                    <input type="hidden" name="total_price" value="" id="total_price_input">

                                </div>

                            </div>

                            <!-- Payment Method -->
                            <div class="col-12 mb--60">
                                <div class="mt--40">
                                    <button type="submit" class="rbt-btn btn-gradient hover-icon-reverse w-100" id="pay-button" disabled>
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">Bayar Sekarang</span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </span>
                                    </button>
                                </div>
                    
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</main>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const price = @json($product->price);
        const ieGems = @json($product->ie_gems);
        const orderButton = document.querySelector('#pay-button');
        const priceFields = document.querySelectorAll('#price');
        const totalPriceInput = document.querySelector('#total_price_input');

        function updateButtonState() {
            orderButton.disabled = ![...paymentMethods].some(method => method.checked);
        }

        function updatePriceDisplay(selectedMethod) {
            priceFields.forEach(field => {
                if (selectedMethod.id === 'ie_gems') {
                    field.innerHTML = `
                        <img src="{{ asset('images/icons/diamond.svg') }}" alt="" style="width: 30px; height: 20px;">
                        ${ieGems} IE Gems
                    `;
                    totalPriceInput.value = ieGems;
                } else {
                    field.innerHTML = new Intl.NumberFormat('id-ID', { 
                        style: 'currency', 
                        currency: 'IDR',
                        minimumFractionDigits: 0 
                    }).format(price);
                    totalPriceInput.value = price;
                }
            });
        }

        paymentMethods.forEach(method => {
            method.addEventListener('change', function () {
                updateButtonState();
                updatePriceDisplay(this);
            });
        });

        updateButtonState(); // Initial state check
    });
</script>
@endpush