<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil</title>
    @include('web.layout.head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .checkout-form input, .checkout-form textarea, .rbt-default-form input, .rbt-default-form textarea {
            border: 0;
            border-bottom: 1px solid var(--color-badge-1);
            border-radius: 0;
            margin-bottom: 0px;
        }

        .rbt-form-group {
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="rbt-elements-area bg-color-white rbt-section-gap d-flex">
    <div class="container">
        <div class="rbt-shadow-box overflow-visible">
            <div class="rbt-section-title">
                <h4 class="rbt-title-style-3 font-size-30 text-center">Yuk lengkapi profilmu!</h4>
            </div>
            <!-- Start Profile Row  -->
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center border-bottom-0 pb--0 mb--30">Profil Saya</h4>
            </div>
            <form action="{{route('complete-profile.update', $profile->id)}}" method="POST" class="rbt-profile-row rbt-default-form row row--15">
                @method('PUT')
                @csrf
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="firstname">Nama Lengkap</label> --}}
                        <label for="fullname" class=" mb--0">Nama Lengkap</label>
                        <input id="fullname" name="fullname" type="text" value="{{old('fullname')}}" placeholder="Nama Lengkap">
                        @error('fullname')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="rbt-form-group">
                        <label for="phone" class="mb--0">Nomor Handphone</label>
                        <input id="phone" name="phone" type="text" value="{{old('phone')}}" placeholder="Nomor Handphone">
                        @error('phone')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="rbt-form-group">
                        <label for="level" class="mb--0">Jenjang Sekolah</label>
                        <div class="filter-select rbt-modern-select">
                            <select id="level" name="level" class="w-100">
                                @foreach ($level as $key => $value)
                                    <option value="{{$key}}" @if (old('level') == $key) selected @endif>
                                        {{$value}}
                                    </option>
                                @endforeach
                            </select>
                            @error('level')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        <label for="institution" class="mb--0">Asal Sekolah</label>
                        <input id="institution" name="institution" type="text" value="{{old('institution')}}" placeholder="Asal Sekolah">
                        @error('institution')
                            <span class="message-info">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="rbt-form-group">
                        <div class="filter-select rbt-modern-select">
                            <label for="province" class="mb--0">Provinsi</label>
                            <select id="province" name="province" class="select-picker w-100 " data-live-search="true">
                                <option selected disabled value="">Pilih Provinsi</option>
                                {{-- @php
                                    $provinceId = $profile->city->province_id ?? '';
                                @endphp --}}
                                @foreach ($province as $key => $value)
                                    <option value="{{ $key }}" @if(old('province') == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('province')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="rbt-form-group">
                        <div class="filter-select rbt-modern-select">
                            <label for="city" class="mb--0">Kabupaten/Kota</label>
                            <select id="city" name="city" class="select-picker w-100 " data-id="{{old('city')}}" data-live-search="true">
                                <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                            </select>
                            @error('city')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
    
                <div class="col-12">
                    <div class="rbt-form-group">
                        <div class="filter-select rbt-modern-select">
                            <label for="interest" class="mb--0">Minat dan Bakat</label>
                            <select id="interest" name="interest" class="w-100 ">
                                <option selected disabled>Minat dan Bakat</option>
                                @foreach ($cluster as $key => $value)
                                    <option value="{{ $key }}" @if(old('interest') == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('interest')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="section-title">
                    <h4 class="rbt-title-style-3 text-center border-bottom-0 pb--0 mb--30">Target Jurusan</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    {{-- <h6>Target Jurusan 1</h6> --}}
    
                    <div class="rbt-form-group">
                        <label for="first_university">Target Perguruan Tinggi 1</label>
                        <div class="filter-select rbt-modern-select">
                            <select id="first_university" name="first_university" class="select-picker w-100 " data-live-search="true">
                                <option value="" selected disabled>Pilih Universitas</option>
                                {{-- @php
                                    $firstMajor = $profile->firstMajor->university_id ?? '';
                                @endphp --}}
                                @foreach ($university as $key => $value)
                                    <option value="{{ $key }}" @if (old('first_university') == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('first_university')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="rbt-form-group">
                        <label for="first_major">Target Jurusan 1</label>
                        <div class="filter-select rbt-modern-select">
                            <select id="first_major" name="first_major" class="select-picker w-100 " data-id="{{old('first_major')}}" data-live-search="true">
                                <option value="" selected disabled>Pilih Program Studi</option>
                            </select>
                            @error('first_major')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    {{-- <h6>Target Jurusan 2</h6> --}}
    
                    <div class="rbt-form-group">
                        <label for="second_university">Target Perguruan Tinggi 2</label>
                        <div class="filter-select rbt-modern-select">
                            <select id="second_university" name="second_university" class="select-picker w-100 " data-live-search="true">
                                <option value="" selected disabled>Pilih Universitas</option>
                                {{-- @php
                                    $secondMajor = $profile->secondMajor->university_id ?? '';
                                @endphp --}}
                                @foreach ($university as $key => $value)
                                    <option value="{{ $key }}" @if (old('second_university') == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('second_university')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="rbt-form-group">
                        <label for="second_university">Target Perguruan Tinggi 2</label>
                        <div class="filter-select rbt-modern-select">
                            <select id="second_major" name="second_major" class="select-picker w-100 " data-id="{{old('second_major')}}" data-live-search="true">
                                <option value="" selected disabled>Pilih Program Studi</option>
                            </select>
                            @error('second_major')
                                <span class="message-info">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-5 mt--20">
                        <button type="submit" class="rbt-btn btn-gradient btn-md text-center hover-icon-reverse" style="color: white; border-radius: 4px; width: 100%">
                            <span class="icon-reverse-wrapper">
                                <span class="btn-text">Simpan</span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            </span>
                        </button>
                    </div>
                </div>
                
            </form>
            <!-- End Profile Row  -->
        </div>
    </div>
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
    
            // Fungsi untuk mengambil data jurusan berdasarkan universitas yang dipilih
            function populateMajor(universityId, majorSelect) {
                // var majorSelect = $('#city');
                majorSelect.empty().append(new Option('Pilih Program Studi', ''));
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
    @include('web.layout.js')
    <script>
        @if (session('status') == 'success')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('status') == 'error')
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('message') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>