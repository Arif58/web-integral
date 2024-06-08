@extends('web.layout-dashboard')
@section('title', 'Ubah Profil')
@push('css')
    <style>
        .checkout-form input, .checkout-form textarea, .rbt-default-form input, .rbt-default-form textarea {
            border: 0;
            border-bottom: 1px solid var(--color-badge-1);
            border-radius: 0;
        }

        .bootstrap-select .dropdown-menu{
            height: 170px;
        }

        .bootstrap-select {
            width: 100% !important;
        }
        .inner .show {
            max-height: 100%;
            font-size: 14px;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            font-size: 14px;
        }

        .message-info {
            position: relative;
        }

        .rbt-default-form input {
            margin-bottom: 0px;
        }

        .rbt-form-group {
            margin-bottom: 30px;
        }

        label {
            margin-bottom: 0px !important;
        }
        
    </style>
@endpush
@section('content')
<div class="content">
    <ul class="page-list pb--20">
        <li class="rbt-breadcrumb-item me-2"><a href="/profil-saya">Akun Saya</a></li>
        <li class="me-2">
            <div class="icon-right">/</div>
        </li>
        <li class="rbt-breadcrumb-item active">Ubah Profil</li>
    </ul>
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
        <!-- Start Profile Row  -->
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center border-bottom-0 pb--0 mb--20">Ubah Profil</h4>
        </div>
        <form action="{{ route('profile.update', $profile->id)}}" method="POST" class="rbt-profile-row rbt-default-form row row--15">
            @csrf
            @method('PUT')
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="rbt-form-group">
                    <label for="firstname">Nama Lengkap</label>
                    <input id="fullname" name="fullname" type="text" value="{{ $profile->fullname }}" placeholder="Nama Lengkap" class="form-control @error('fullname') is-invalid @enderror">
                    @error('fullname')
                        <span class="message-info">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="rbt-form-group">
                    <label for="username">User Name</label>
                    <input id="username" name="username" type="text" value="{{ $profile->username }}" placeholder="Username" class="form-control @error('username') is-invalid @enderror">
                    @error('username')
                        <span class="message-info">{{ $message }}</span>
                    @enderror
                </div>

                <div class="rbt-form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" value="{{ $profile->email }}" placeholder="Email" disabled>
                </div>

                <div class="rbt-form-group">
                    <label for="phone">Nomor Handphone</label>
                    <input id="phone" name="phone" type="text" value="{{ $profile->phone }}" placeholder="Nomor Handphone" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                        <span class="message-info">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="rbt-form-group">
                    <label for="level">Jenjang Sekolah</label>
                    <div class="filter-select rbt-modern-select">
                        <select id="level" name="level" class="w-100  form-control @error('level') is_invalid @enderror">
                            @foreach ($level as $key => $value)
                                <option value="{{$key}}" @if ($key == $profile->level) selected @endif>
                                    {{$value}}
                                </option>
                            @endforeach
                        </select>
                        @error('level')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="rbt-form-group">
                    <label for="institution">Asal Sekolah</label>
                    <input id="institution" name="institution" type="text" value="{{$profile->institution}}" placeholder="Asal Sekolah" class="form-control @error('institution') is_invalid @enderror">
                    @error('institution')
                        <span class="message-info">{{ $message }}</span>
                    @enderror
                </div>

                <div class="rbt-form-group">
                    <div class="filter-select rbt-modern-select">
                        <label for="province" class="">Provinsi</label>
                        <select id="province" name="province" class="select-picker w-100 ">
                            <option selected disabled value="">Pilih Provinsi</option>
                            @php
                                $oldProvince = $profile->city->province_id ?? '';
                            @endphp
                            @foreach ($province as $key => $value)
                                <option value="{{ $key }}" @if($key == $oldProvince) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('province')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="rbt-form-group">
                    <label for="city">Kabupaten/Kota</label>
                    <div class="filter-select rbt-modern-select">
                        <select id="city" name="city" class="select-picker w-100 " data-id="{{ $profile->city_id }}">
                        </select>
                        @error('city')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="rbt-form-group">
                    <label for="interest">Minat dan Bakat</label>
                    <div class="filter-select rbt-modern-select">
                        <select id="interest" name="interest" class="w-100 ">
                            <option selected disabled>Minat dan Bakat</option>
                            @foreach ($cluster as $key => $value)
                                <option value="{{ $key }}" @if($key == $profile->interest) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('interest')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class=" col-sm-3 col-md-3 col-lg-3 mb-3">
                    <a type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10 text-center" data-bs-dismiss="modal" style="width: 100%; color: black;" href="/profil-saya">Batal</a> 
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
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

        // Fungsi untuk mengambil data kota berdasarkan provinsi yang dipilih
        function populateCities(provinceId) {
            var citySelect = $('#city');
            citySelect.empty().append(new Option('Pilih Kabupaten/Kota', ''));
            var cityId = citySelect.data('id');

            if (provinceId) {
                $.ajax({
                    url: '/profil/get-city/' + provinceId,
                    method: 'GET',
                    success: function (data) {
                        data.forEach(function (city) {
                            var option = new Option(city.name, city.id);
                            if (city.id === cityId) {
                                $(option).prop('selected', true); // Menandai option yang sesuai dengan selectedCityId
                            }
                            citySelect.append(option);
                        });
                        citySelect.selectpicker('refresh'); // Inisialisasi ulang selectpicker
                    }
                });
            }
        }

        // Ketika halaman pertama kali dimuat, pilih kota berdasarkan province_id yang tersimpan
        var selectedProvinceId = $('#province').val();
        populateCities(selectedProvinceId);

        // Ketika nilai provinsi berubah, perbarui daftar kota
        $('#province').change(function () {
            var selectedProvinceId = $(this).val();
            populateCities(selectedProvinceId);
        });
    });
</script>

@endpush