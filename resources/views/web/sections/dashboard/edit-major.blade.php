@extends('web.layout-dashboard')
@section('title', 'Ubah Target Jurusan')
@push('css')
    <style>
        .rbt-dashboard-content {
            overflow: visible;
        }

        .bootstrap-select .dropdown-menu{
            height: auto;
        }

        .bootstrap-select {
            width: 100% !important;
        }
        .inner .show {
            max-height: 300px;
            font-size: 14px;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            font-size: 14px;
        }

        .message-info {
            position: relative;
        }
/* 
        .rbt-form-group {
            margin-bottom: 20px;
        } */
        
    </style>
@endpush
@section('content')
<div class="content">
    <ul class="page-list pb--20">
        <li class="rbt-breadcrumb-item me-2"><a href="/profil-saya">Akun Saya</a></li>
        <li class="me-2">
            <div class="icon-right">/</div>
        </li>
        <li class="rbt-breadcrumb-item active">Ubah Target Jurusan</li>
    </ul>
    <div class="section-title">
        <h4 class="rbt-title-style-3 border-bottom-0 pb--0 mb--20">Ubah Target Jurusan</h4>
    </div>
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
        <!-- Start Profile Row  -->
        <form action="{{route('profile.update-major', $profile->id)}}" method="POST" class="rbt-profile-row rbt-default-form row row--15">
            @method('PUT')
            @csrf
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h6>Pilih Jurusan 1</h6>

                <div class="rbt-form-group">
                    {{-- <label for="lastname">Last Name</label> --}}
                    <div class="filter-select rbt-modern-select">
                        <select id="first_university" name="first_university" class="select-picker w-100 mb--20" data-live-search="true">
                            <option value="" selected disabled>Pilih Universitas</option>
                            @php
                                $firstMajor = $profile->firstMajor->university_id ?? '';
                            @endphp
                            @foreach ($university as $key => $value)
                                <option value="{{ $key }}" @if ($key == $firstMajor) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="rbt-form-group">
                    {{-- <label for="lastname">Last Name</label> --}}
                    <div class="filter-select rbt-modern-select">
                        <select id="first_major" name="first_major" class="select-picker w-100 mb--20" data-id="{{$profile->first_major}}" data-live-search="true">
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h6>Pilih Jurusan 2</h6>

                <div class="rbt-form-group">
                    {{-- <label for="lastname">Last Name</label> --}}
                    <div class="filter-select rbt-modern-select">
                        <select id="second_university" name="second_university" class="select-picker w-100 mb--20" data-live-search="true">
                            <option value="" selected disabled>Pilih Universitas</option>
                            @php
                                $secondMajor = $profile->secondMajor->university_id ?? '';
                            @endphp
                            @foreach ($university as $key => $value)
                                <option value="{{ $key }}" @if ($key == $secondMajor) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="rbt-form-group">
                    {{-- <label for="lastname">Last Name</label> --}}
                    <div class="filter-select rbt-modern-select">
                        <select id="second_major" name="second_major" class="select-picker w-100 mb--20" data-id="{{$profile->second_major}}" data-live-search="true">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-sm-1 col-md-3 col-lg-3 mb-3">
                    <a type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10 text-center" data-bs-dismiss="modal" style="width: 100%; color: black;" href="/profil-saya">Batal</a> 
                </div>
                <div class="col-sm-1 col-md-3 col-lg-3">
                    <button type="submit" class="rbt-btn btn-gradient btn-md" style="color: white; border-radius: 4px; width: 100%">Simpan</button>
                </div>
            </div>
        </form>
        <!-- End Profile Row  -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        // Fungsi untuk mengambil data jurusan berdasarkan universitas yang dipilih
        function populateMajor(universityId, majorSelect) {
            // var majorSelect = $('#city');
            majorSelect.empty().append(new Option('Pilih Jurusan', ''));
            var majorId = majorSelect.data('id');

            if (universityId) {
                $.ajax({
                    url: '/profil/get-major/' + universityId,
                    method: 'GET',
                    success: function (data) {
                        data.forEach(function (major) {
                            var option = new Option(major.name, major.id);
                            if (major.id === majorId) {
                                $(option).prop('selected', true); // Menandai option yang sesuai dengan selectedmajorId
                            }
                            majorSelect.append(option);
                        });
                        majorSelect.selectpicker('refresh'); // Inisialisasi ulang selectpicker
                    }
                });
            }
        }

        // Ketika halaman pertama kali dimuat, pilih kota berdasarkan province_id yang tersimpan
        var selectedFirstUniversityId = $('#first_university').val();
        var firstMajorSelect = $('#first_major');

        var selectedSecondUniversityId = $('#second_university').val();
        var secondMajorSelect = $('#second_major');
        populateMajor(selectedFirstUniversityId, firstMajorSelect);
        populateMajor(selectedSecondUniversityId, secondMajorSelect);

        // Ketika nilai first major berubah, perbarui daftar jurusan
        $('#first_university').change(function () {
            var selectedFirstUniversityId = $(this).val();
            populateMajor(selectedFirstUniversityId, firstMajorSelect);
        });

        // Ketika nilai second major berubah, perbarui daftar jurusan
        $('#second_university').change(function () {
            var selectedSecondUniversityId = $(this).val();
            populateMajor(selectedSecondUniversityId, secondMajorSelect);
        });
    });
</script>

@endpush