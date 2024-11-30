@extends('web.layout-dashboard')
@section('title', 'Detail User')
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Manajemen User</h4>
        </div>
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0 my-auto" style="font-size: 18px;">
                <a href="/manajemen-user" class="me-4"><i class="feather feather-arrow-left"></i></a><b>Daftar User / </b><span style="color: #9f9f9f; font-weight: normal">{{ $user->fullname }}</span>       
            </h4>
            <a data-id="{{ $user->id }}" class="rbt-btn btn-sm bg-color-danger delete-button" type="button" data-bs-toggle="modal" data-bs-target="#formModal" style="padding: 0 10px; height: 35px; line-height: 35px;">Hapus<i class="feather feather-trash"></i></a>
        </div>
        <div class="container" style="border: 1px solid #757575">
            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 pt--30">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Role</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->role }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Nama Lengkap</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->fullname }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Username</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->username }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Email</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->email }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Nomor Handphone</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->phone }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Jenjang Sekolah</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->level == 'kuliah' ? 'Kuliah' : strtoupper($user->level) }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Asal Sekolah</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">{{ $user->institution }}</div>
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            @php
                $cityId = $user->city_id ?? '';
            @endphp
                <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Provinsi</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    @if ($cityId != '')
                        <div class="rbt-profile-content b2">{{ $user->city->province->name }}</div>
                    @endif
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Kabupaten/Kota</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    @if($cityId != '')
                    <div class="rbt-profile-content b2">{{ $user->city->name }}</div>
                    @endif
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Target Jurusan 1</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    
                    <div class="rbt-profile-content b2">{{ $user->firstMajor?->university?->name }} - {{ $user->firstMajor?->name }}</div>
                    
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Target Jurusan 2</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    
                    <div class="rbt-profile-content b2">{{ $user->secondMajor?->university?->name }} - {{ $user->secondMajor?->name }}</div>
                    
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Minat dan Bakat</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    
                    <div class="rbt-profile-content b2">{{ $user->talentInterest?->name }}</div>
                    
                </div>
            </div>
            <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15 pb--30">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Dibuat pada tanggal:</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2"><span class="local_date">{{ $user->created_at }}</span></div>
                </div>
            </div>
            <!-- End Profile Row  -->
        </div>
        
    </div>
</div>
@endsection
@push('scripts')
<script>
    (function () {
        var dates = document.getElementsByClassName('local_date');
        for(var i = 0; i < dates.length; i++) {
            var date = moment.utc(dates[i].textContent);
            dates[i].textContent = date.local().format('DD MMMM YYYY HH:mm:ss');
        }
    })();

     // Handle delete button click
     $('.delete-button').on('click', function() {
        var userId = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data user setelah di hapus!",
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            buttonsStyling: true,
            width: '500px',
        }).then((result) => {
            // jika tombol ya di klik maka akan menghapus data
            if (result.isConfirmed) {
                $.ajax({
                    url: '/manajemen-user/delete/' + userId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.href = '/manajemen-user';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Error deleting user.',
                        });
                    }
                });
            }
        });
    });
</script>    
@endpush