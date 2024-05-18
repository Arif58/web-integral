@extends('web.layout-dashboard')
@section('title', 'Profil')
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title d-flex justify-content-between" style="
        border-bottom: 2px solid var(--color-border-2);">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Profil Saya
            </h4>
            <a href="/ubah-profil"><p class="font-weight-light">Ubah</p></a>
        </div>
        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 pt--30">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Nama Lengkap</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">Rivaldy Arief Nugraha</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Username</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">Arif</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Email</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">rivaldyarief@mail.ugm.ac.id</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Nomor Handphone</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">0895610769630</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Jenjang Sekolah</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">SMA/SMK/Sederajat</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Asal Sekolah</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">SMAN 1 Cilegon</div>
            </div>
        </div>
        <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Provinsi</div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="rbt-profile-content b2">Banten</div>
                </div>
            </div>
            <!-- End Profile Row  -->

                <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Kabupaten/Kota</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">Cilegon</div>
            </div>
        </div>
        <!-- End Profile Row  -->
    </div>

    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
        <div class="section-title d-flex justify-content-between" style="
        border-bottom: 2px solid var(--color-border-2);">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Target Jurusan
            </h4>
            <a href="/ubah-jurusan"><p class="font-weight-light">Ubah</p></a>
        </div>
        <div class="row pt--30">
            <div class="col-lg-12">
                <div class="rbt-course-grid-column active-grid-view">
                    <div class="course-grid-2">
                        <div class="rbt-card variation-01 rbt-hover" style="background-color: #616161">
                            <div class="rbt-card-img text-center" style="padding: 10px 80px 0px">
                                <img src="{{asset('/images/logo/pilihan-univ-1.png')}}" class="radius-10" alt="Course">
                            </div>
                            <div class="rbt-card-body text-center">
                                <h5 class="color-white mb--10">Universitas Siliwangi</h5>
                                <span class="color-white">Teknik Informatika</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-grid-2">
                        <div class="rbt-card variation-01 rbt-hover" style="background-color: #616161">
                            <div class="rbt-card-img text-center" style="padding: 10px 80px 0px">
                                <img src="{{asset('/images/logo/pilihan-univ-2.png')}}" class="radius-10" alt="Course">
                            </div>
                            <div class="rbt-card-body text-center">
                                <h5 class="color-white mb--10">Universitas Siliwangi</h5>
                                <span class="color-white">Teknik Informatika</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection