@extends('web.layout-dashboard')
@section('title', 'Ubah Target Jurusan')
@section('content')
<div class="content">
    <ul class="page-list pb--20">
        <li class="rbt-breadcrumb-item me-2"><a href="/profil">Akun Saya</a></li>
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
        <form action="#" class="rbt-profile-row rbt-default-form row row--15">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h6>Pilih Jurusan 1</h6>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h6>Pilih Jurusan 2</h6>
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
                    <a class="rbt-btn btn-sm btn-border-gradient radius-6" href="/profil" style="padding: 0px 120px; background: var(--gradient-11)">Batal</a>
                    <a class="rbt-btn btn-sm btn-gradient radius-6" href="#" style="padding: 0px 120px">Simpan</a>
                </div>
            </div>
        </form>
        <!-- End Profile Row  -->
    </div>
</div>
@endsection