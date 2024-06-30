@extends('web.layout-exam')
@push('css')
    <style>
        @media only screen and (max-width: 767px) {
           .course-sidebar {
                max-width: 355px;
           }
        }
    </style>
@endpush
@section('content')
<div class="content">
    <div class="inner" style="max-width: 455px;">

        <div class="text-center">
            <img src="{{{asset('images/banner/clap.svg')}}}" class="mb-4" alt="">
            <h5>
                Selamat kamu sudah menyelesaikan {{ $participant->tryOut->name }}!
            </h5>
            <p style="font-size: 16px; font-weight: normal; margin-bottom: 15px;">
                Kamu mendapatkan 3 IE Gems.
            </p>
            <div class="d-flex justify-content-center" style="margin-bottom: 15px; font-weight: bold; color: #212121">
                <div class="py-2" style="width: 150px; border: 1px solid #DC7E3F; border-radius: 20px;">
                    <img src="{{asset('images/icons/diamond.svg')}}" alt="">
                    +3 IE Gems
                </div>
            </div>
            <p style="font-size: 16px; font-weight: normal; margin-bottom: 20px;">
                IE Gems bisa digunakan untuk membeli Try Out UTBK Integral Education lainnya.
            </p>

        </div>
            
        <div class="content-item-content mt-4">
            <div class="buy-now-btn">
                <a class="rbt-btn btn-gradient w-100 d-block text-center radius-10" id="start_exam_button" href="/dashboard">
                    <span class="btn-text">Lihat Progress Saya</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection