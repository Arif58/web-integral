@extends('web.layout-dashboard')
@section('title', 'Ubah Profil')
@section('content')
<div class="content">
    <ul class="page-list pb--20">
        <li class="rbt-breadcrumb-item me-2"><a href="/profil">Akun Saya</a></li>
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
        <form action="#" class="rbt-profile-row rbt-default-form row row--15">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="rbt-form-group">
                    {{-- <label for="firstname">Nama Lengkap</label> --}}
                    <input id="firstname" type="text" value="" placeholder="Nama Lengkap">
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
                <div class="rbt-form-group">
                    {{-- <label for="username">User Name</label> --}}
                    <input id="username" type="text" value="" placeholder="Username">
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
                    {{-- <label for="skill">Skill/Occupation</label> --}}
                    <input id="email" type="text" value="" placeholder="Email">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="filter-select rbt-modern-select">
                    {{-- <label for="displayname" class="">Display name publicly as</label> --}}
                    <select id="displayname" class="w-100 mb--20">
                        <option selected disabled>Provinsi</option>
                        <option>John</option>
                        <option>Due</option>
                        <option>Due John</option>
                        <option>johndue</option>
                        <option>John</option>
                        <option>Due</option>
                        <option>Due John</option>
                        <option>johndue</option>
                        <option>Due</option>
                        <option>Due John</option>
                        <option>johndue</option>
                        <option>John</option>
                        <option>Due</option>
                        <option>Due John</option>
                        <option>johndue</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="rbt-form-group">
                    <input id="phone" type="text" value="" placeholder="Nomor Handphone">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="filter-select rbt-modern-select">
                    <select id="city" class="w-100 mb--20">
                        <option selected disabled>Kabupaten/Kota</option>
                        <option>John</option>
                        <option>Due</option>
                        <option>Due John</option>
                        <option>johndue</option>
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
            <div class="col-12 mt--20">
                <div class="rbt-form-group text-center">
                    <a class="rbt-btn btn-sm" href="#" style="padding: 0px 120px">Simpan</a>
                </div>
            </div>
        </form>
        <!-- End Profile Row  -->
    </div>
</div>
@endsection