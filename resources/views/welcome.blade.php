@extends('web.layout-auth')
@push('cdn')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush
@section('content')
<form action="POST">
    <select id="province" name="province" class="w-100 mb--20">
        <option selected disabled value="">Provinsi</option>
    </select>
    <br>
    <select id="regency" name="regency" class="w-100 mb--20">
        <option selected disabled value="">Kabupaten/Kota</option>
    </select>
</form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            // Mengambil data provinsi dari API
            $.ajax({
                url: 'https://wilayah.id/api/provinces.json',
                method: 'GET',
                success: function (data) {
                    var provinceSelect = $('select[name="province"]');
                    // console.log(data['data']);
                    data['data'].forEach(function (province) {
                        provinceSelect.append('<option value="' + province.code + '">' + province.name + '</option>');
                        console.log(province.name, province.code)
                    });
                }
            });

            // Mengambil data kabupaten berdasarkan provinsi yang dipilih
            $('#province').change(function () {
                var provinceId = $(this).val();
                var regencySelect = $('#regency');
                regencySelect.empty().append(new Option('Pilih Kabupaten', ''));

                if (provinceId) {
                    $.ajax({
                        url: 'https://wilayah.id/api/regencies/' + provinceId + '.json',
                        method: 'GET',
                        success: function (data) {
                            data.forEach(function (regency) {
                                regencySelect.append(new Option(regency.name, regency.id));
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush