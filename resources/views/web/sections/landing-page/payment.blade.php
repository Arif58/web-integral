@extends('web.layout')
@section('title', 'Pembayaran')
@section('content')
<main class="rbt-main-wrapper">
    
      <!-- Start breadcrumb Area -->
      <div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner text-center">
                        <h2 class="title">Pembelian Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area -->
    <form action="">
        @csrf
        <div class="checkout_area bg-color-white rbt-section-gap">
            <div class="container">
                <div class="row g-5 checkout-form">

                    <div class="col-lg-8">
                        <div class="checkout-content-wrapper">

                            <!-- Billing Address -->
                            <div id="billing-form">
                                <h4 class="checkout-title">Billing Address</h4>

                                <div class="row">

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>First Name*</label>
                                        <input type="text" placeholder="First Name">
                                    </div>

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Last Name*</label>
                                        <input type="text" placeholder="Last Name">
                                    </div>

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Email Address*</label>
                                        <input type="email" placeholder="Email Address">
                                    </div>

                                    <div class="col-md-6 col-12 mb--20">
                                        <label>Phone no*</label>
                                        <input type="text" placeholder="Phone number">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="checkout-content-wrapper mt-5">
                            <h4 class="checkout-title">Opsi Pembayaran</h4>
                            <div class="row">
                                <div class="col-12 mb--20">
                                    <div class="rbt-accordion-style rbt-accordion-04 accordion">
                                        <div class="accordion" id="accordionExampleb2">
                                            <div class="accordion-item card">
                                                <h2 class="row accordion-header card-header pr--15">
                                                        <p class="col mb--0">IE Gems</p>
                                                        <div class="col form-check form-switch justify-content-end">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                            
                                                        </div>
                                                </h2>
                                            </div>

                                            <div class="accordion-item card">
                                                <h2 class="accordion-header card-header" id="headingTwo2">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                                        E-wallet
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo2" class="accordion-collapse collapse" aria-labelledby="headingTwo2" data-bs-parent="#accordionExampleb2">
                                                    <div class="accordion-body card-body">
                                                        <input type="checkbox" id="gopay" name="payment_method" value="gopay" >
                                                        <label for="gopay">Gopay</label><br>
                                                        <input type="checkbox" id="ovo" name="payment_method" value="ovo" >
                                                        <label for="ovo">OVO</label><br>
                                                        <input type="checkbox" id="shopeepay" name="payment_method" value="shopeepay" >
                                                        <label for="shopeepay">ShopeePay</label><br>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header card-header" id="headingTwo3">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">
                                                        Virtual Account
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo3" class="accordion-collapse collapse" aria-labelledby="headingTwo3" data-bs-parent="#accordionExampleb2">
                                                    <div class="accordion-body card-body">
                                                        <input type="radio" id="bri" name="payment_method" value="bri">
                                                        <label for="bri">VA BRI</label><br>
                                                        <input type="radio" id="bni" name="payment_method" value="bni">
                                                        <label for="bni">VA BNI</label><br>
                                                        <input type="radio" id="bca" name="payment_method" value="bca">
                                                        <label for="bca">VA BCA</label><br>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header card-header" id="headingTwo4">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
                                                       Transfer (Verifikasi Manual)
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo4" class="accordion-collapse collapse" aria-labelledby="headingTwo4" data-bs-parent="#accordionExampleb2">
                                                    <div class="accordion-body card-body">
                                                       
                                                    </div>
                                                </div>
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

                                    <ul>
                                        <li>Try Out UTBK #1 <span>Rp10.000</span></li>
                                    </ul>

                                    <p style="border-bottom-width: 0px">Total <span style="font-size: 20px">Rp10.000</span></p>

                                </div>

                            </div>

                            <!-- Payment Method -->
                            <div class="col-12 mb--60">
                                <div class="mt--40">
                                    <button class="rbt-btn btn-gradient hover-icon-reverse w-100">
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