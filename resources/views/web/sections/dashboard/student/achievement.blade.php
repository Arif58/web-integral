@extends('web.layout-dashboard')
@section('title', 'Pencapaian')
@push('css')

    <style>
        span {
            font-weight: bold;
        }    
    </style>    
@endpush
@section('content')
    <div class="content">
        <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
            <div class="section-title">
                <h4 class="rbt-title-style-3 text-center">Pencapaian</h4>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rbt-course-grid-column">
                            <div class=" course-grid-3">
                                <div class="rbt-card variation-03 rbt-hover" style="padding: 0px; box-shadow: none;">
                                    <div class="rbt-card-img text-center">
                                        <img src="{{asset('/images/icons/3x-try-out.svg')}}" alt="Course">
                                    </div>
                                    <div class="rbt-card-badge text-center">
                                        <span>3 Try Out Completed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="course-grid-3">
                                <div class="rbt-card variation-03 rbt-hover" style="padding: 0px; box-shadow: none;">
                                    <div class="rbt-card-img text-center">
                                        <img src="{{asset('/images/icons/score-700.svg')}}" alt="Course">
                                        <div class="rbt-card-badge text-center">
                                            <span>700 Score Reached</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="course-grid-3">
                                <div class="rbt-card variation-03 rbt-hover" style="padding: 0px; box-shadow: none;">
                                    <div class="rbt-card-img text-center">
                                        <img src="{{asset('/images/icons/Vector.svg')}}" alt="Course">
                                        <div class="rbt-card-badge text-center">
                                            <span>5 Try Out Completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection