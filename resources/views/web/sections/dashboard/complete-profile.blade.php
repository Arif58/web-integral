<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil</title>
    @include('web.layout.head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class="rbt-elements-area bg-color-white rbt-section-gap d-flex">
    <div class="container">
        <div class="rbt-shadow-box overflow-visible">
            <div class="rbt-section-title">
                <h4 class="rbt-title-style-3 font-size-30 text-center">Yuk lengkapi profilmu!</h4>
            </div>
            <!-- Start Profile Row  -->
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center border-bottom-0 pb--0 mb--20">Profil Saya</h4>
            </div>
            <form action="#" class="rbt-profile-row rbt-default-form row row--15">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="firstname">Nama Lengkap</label> --}}
                        <input id="firstname" type="text" value="" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="phonenumber">Phone Number</label> --}}
                        <input id="school" type="text" value="" placeholder="Asal Sekolah">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        <input id="phone" type="text" value="" placeholder="Nomor Handphone">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="filter-select rbt-modern-select">
                        {{-- <label for="displayname" class="">Display name publicly as</label> --}}
                        <select id="province" name="province" class="selectpicker w-100 mb--20">
                            <option selected disabled value="">Provinsi</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="lastname">Last Name</label> --}}
                        <div class="filter-select rbt-modern-select">
                            <select id="displayname" class="w-100 mb--20">
                                <option selected disabled>Jenjang Sekolah</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA/SMK</option>
                                <option>Kuliah</option>
                            </select>
                        </div>
                    </div>
                </div>   
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="filter-select rbt-modern-select">
                        <select id="regency" name="regency" class="selectpicker w-100 mb--20">
                            <option selected disabled value="">Kabupaten/Kota</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="filter-select rbt-modern-select">
                        <select id="city" class="w-100 mb--20">
                            <option selected disabled>Minat dan Bakat</option>
                            <option>John</option>
                            <option>Due</option>
                            <option>Due John</option>
                            <option>johndue</option>
                        </select>
                    </div>
                </div>
                <div class="section-title">
                    <h4 class="rbt-title-style-3 text-center border-bottom-0 pb--0 mb--20">Target Jurusan</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="lastname">Last Name</label> --}}
                        <div class="filter-select rbt-modern-select">
                            <select id="displayname" class="w-100 mb--20">
                                <option selected disabled>Universitas Gadjah Mada</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA/SMK</option>
                                <option>Kuliah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="lastname">Last Name</label> --}}
                        <div class="filter-select rbt-modern-select">
                            <select id="displayname" class="w-100 mb--20">
                                <option selected disabled>Universitas Padjajaran</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA/SMK</option>
                                <option>Kuliah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="lastname">Last Name</label> --}}
                        <div class="filter-select rbt-modern-select">
                            <select id="displayname" class="w-100 mb--20">
                                <option selected disabled>Kedokteran</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA/SMK</option>
                                <option>Kuliah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="rbt-form-group">
                        {{-- <label for="lastname">Last Name</label> --}}
                        <div class="filter-select rbt-modern-select">
                            <select id="displayname" class="w-100 mb--20">
                                <option selected disabled>Informatika</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA/SMK</option>
                                <option>Kuliah</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt--20">
                    <div class="rbt-form-group text-center">
                        <a class="rbt-btn btn-sm" href="#" style="padding: 0px 120px">Simpan</a>
                    </div>
                </div>
            </form>
            <!-- End Profile Row  -->
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var provinceSelect = $('#province');
            if (provinceSelect.length) {
                console.log("Element <select> province ditemukan");
            } else {
                console.error("Element <select> province tidak ditemukan");
            }
            // Mengambil data provinsi dari API
            $.ajax({
                url: 'https://wilayah.id/api/provinces.json',
                method: 'GET',
                success: function (data) {
                    var provinceSelect = $('select[name="province"]');
                    data['data'].forEach(function (province) {
                        provinceSelect.append('<option data-id="'+province.code+'" value="' + province.name + '">' + province.name + '</option>');
                    });
                    provinceSelect.selectpicker('refresh');
                }
            });

            // Mengambil data kabupaten berdasarkan provinsi yang dipilih
            $('#province').change(function () {
                var selectedOption = $(this).find('option:selected');
                var provinceId = selectedOption.data('id');
                $('#province_id').val(provinceId); // Simpan ID provinsi ke input hidden
                
                var regencySelect = $('#regency');
                regencySelect.empty().append(new Option('Pilih Kabupaten', ''));
                regencySelect.selectpicker('refresh'); // Inisialisasi ulang selectpicker

                if (provinceId) {
                    $.ajax({
                        url: 'https://wilayah.id/api/regencies/' + provinceId + '.json',
                        method: 'GET',
                        success: function (data) {
                            data['data'].forEach(function (regency) {
                                regencySelect.append(new Option(regency.name, regency.id));
                            });
                            regencySelect.selectpicker('refresh'); // Inisialisasi ulang selectpicker
                        }
                    });
                }
            });
        });
    </script>
    @include('web.layout.js')
</body>