@extends('web.layout-dashboard')
@section('title', 'Profil Saya')
@push('css')
    <style>
        .edit {
            margin-bottom: 0;
            color: #DC7E3F;
            text-decoration: underline;
        }

        .rbt-card {
            box-shadow: none;
            border: 1px solid var(--color-border-2);
        }
        .rbt-card-body h5 {
            color: var(--color-body);
        }

        .section-title {
            border-bottom: 1px solid var(--color-border-2);
        }
    </style>
    
@endpush
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title d-flex justify-content-between">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Profil Saya
            </h4>
            @if($profile->role == 'student')
            <a href="{{route('profile.edit', $profile->id)}}"><p class="font-weight-light edit">Ubah</p></a>
            @endif
        </div>
        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 pt--30">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Nama Lengkap</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">{{ $profile->fullname }}</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Username</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">{{ $profile->username }}</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Email</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">{{ $profile->email }}</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        @if($profile->role == 'student')
        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Nomor Handphone</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">{{ $profile->phone }}</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Jenjang Sekolah</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">{{ $profile->level }}</div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Asal Sekolah</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">{{ $profile->institution }}</div>
            </div>
        </div>
        <!-- End Profile Row  -->

            <!-- Start Profile Row  -->
            <div class="rbt-profile-row row row--15 mt--15">
                <div class="col-lg-4 col-md-4">
                    <div class="rbt-profile-content b2">Provinsi</div>
                </div>
                @php
                    $cityId = $profile->city_id ?? '';
                @endphp
                <div class="col-lg-8 col-md-8">
                    @if($cityId != '')
                    <div class="rbt-profile-content b2">{{$profile->city->province->name }}</div>
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
                @if ($cityId != '')
                <div class="rbt-profile-content b2">{{ $profile->city->name }}</div>
                @endif
            </div>
        </div>
        <!-- End Profile Row  -->
    </div>

    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
        <div class="section-title d-flex justify-content-between">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0">
                Target Jurusan
            </h4>
            <a href="{{route('profile.edit-major', $profile->id)}}"><p class="font-weight-light edit">Ubah</p></a>
        </div>
        @php
            $firstMajor = $profile->first_major ?? '';
            $secondMajor = $profile->second_major ?? '';
        @endphp
        <div class="row pt--30">
            <div class="col-lg-12">
                <div class="rbt-course-grid-column active-grid-view">
                    @if ($firstMajor != '')
                    <div class="course-grid-2">
                        <div class="rbt-card variation-01 rbt-hover">
                            <div class="rbt-card-img text-center" style="padding: 10px 80px 0px">
                                <img src="{{asset('/images/logo/College-1.svg')}}" class="radius-10" alt="Course">
                            </div>
                            <div class="rbt-card-body text-center">
                                
                                <h5 class="mb--10">{{$profile->firstMajor->university->name}}</h5>
                                <span>{{$profile->firstMajor->name}}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($secondMajor != '')
                    <div class="course-grid-2">
                        <div class="rbt-card variation-01 rbt-hover">
                            <div class="rbt-card-img text-center" style="padding: 10px 80px 0px">
                                <img src="{{asset('/images/logo/College-2.svg')}}" class="radius-10" alt="Course">
                            </div>
                            <div class="rbt-card-body text-center">
                                <h5 class="mb--10">{{$profile->secondMajor->university->name}}</h5>
                                <span>{{$profile->secondMajor->name}}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection