@extends('web.layout-dashboard')
@section('title', 'Tryout Subtest')
@push('css')
    <style>
        .rbt-title-style-3{
            font-size: 18px;
        }

        .rbt-btn.btn-sm {
            padding: 0 10px; 
            height: 35px; 
            line-height: 35px;
        }

        .bootstrap-select .dropdown-menu{
            height: 70px;
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

        .rbt-modern-select .bootstrap-select button.btn-light {
            border: 1px solid var(--color-badge-1);
            border-radius: 6px;
        }

        .checkout-form input {
            margin-bottom: 0px;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <style type="text/css">
        .ck-editor__editable_inline {
            height: 300px;
        }
    </style>
@endpush
@section('content')
<div class="content">
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Try Out</h4>
        </div>
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3">
                <a href="{{route('subtests', $subTest->try_out_id)}}" class="me-4"><i class="feather feather-arrow-left"></i></a>
                <b>Daftar Try Out / </b>
                <b>{{ $subTest->tryOut->name }} / </b>
                <span style="color: #9f9f9f; font-weight: normal">{{ $subTest->name }}</span>       
            </h4>
        </div>
        
        {{-- subtest --}}
        <div class="section-title d-flex justify-content-between mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0" style="font-size: 18px;">
                Soal
            </h4>
            <button class="rbt-btn btn-sm bg-color-success" type="button" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Soal<i class="feather feather-plus"></i></button>
        </div>
        <div style="margin-bottom: 24px;">
            @php
                $countQuestion = $questions->count();
            @endphp
            <span>Total : {{$countQuestion}} soal</span>
            @foreach($questions as $key => $item)
            <div class="rbt-shadow-box overflow-visible mt-3">
                <div class="row">
                    <div class="col-1">
                        {{++$no}}
                    </div>
                    <div class="col-10">
                        <div class="row mb-2 pb-3" style="border-bottom: 1px solid var(--color-border-2)">
                            {{$item->question_text}}
                        </div>
                        @php
                            $answers = $item->questionChoices;
                        @endphp
                        <ul>
                            @foreach ($answers as $answer)
                            <li>
                                <p @if($answer->is_correct) style="color: green" @endif>{{$answer->answer}}</p>
                            </li>
                        @endforeach
                        </ul>
                       
                        
                    </div>
                    <div class="col-1">
                        <button class="rbt-btn btn-sm bg-color-danger" type="button" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editSubtest({{$item->id}})">Edit</button>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
     <!-- Start Modal create tutor -->
     <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 1000px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Tambah Subtes
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="{{ route('questions.store', $subTest->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb--30">
                                    <label for="question_text" class="form-label">Soal</label>
                                    <textarea name="question_text" id="editor"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                                </div>
                                <div class="col-8">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal create tutor -->

    <!-- Start Modal edit tutor -->
    <div class="rbt-default-modal modal fade @if($errors->any()) show @endif" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" style="background: transparent" @if($errors->any()) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px;">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header pb--5 justify-content-center">
                    <h4 class="title">
                        Ubah Subtest Kategori
                    </h4>
                </div>
                <div class="modal-body" style="border-top: 1px solid #dee2e6">
                    <div class="inner checkout-form">
                        <form action="" id="editSubtest" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="subtestId" name="subtestId">
                            <div class="row">
                                
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10" data-bs-dismiss="modal" style="width: 100%; color: black;">Batal</button> 
                                </div>
                                <div class="col-8">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal edit tutor -->
</div>
@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'undo', 'redo',
                    '|', 'heading',
                    '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                    '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                    '-', // break point
                    '|', 'alignment',
                    'link', 'uploadImage', 'blockQuote', 'codeBlock',
                    '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                ],
                shouldNotGroupWhenFull: true
            },
            htmlEmbed: {
                showPreviews: true
            },
            // Ensure these plugins are loaded
            extraPlugins: [ 'Subscript', 'Superscript' ],
            // Enable other necessary features
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [
                    9,
                    11,
                    13,
                    'default',
                    17,
                    19,
                    21
                ],
                supportAllValues: true
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>


<script>
    // JavaScript untuk menampilkan kembali modal jika ada error validasi
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('name') || $errors->has('category_subtest_id') || $errors->has('duration') || $errors->has('total_question'))
            var formModal = new bootstrap.Modal(document.getElementById('formModal'));
            formModal.show();
        @endif
    });
</script>
<script>
    (function () {
        var dates = document.getElementsByClassName('local_date');
        for(var i = 0; i < dates.length; i++) {
            var date = moment.utc(dates[i].textContent);
            dates[i].textContent = date.local().format('DD MMMM YYYY, HH:mm');
        }
    })();
</script>    
@endpush