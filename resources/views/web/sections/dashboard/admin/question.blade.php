@extends('web.layout-dashboard')
@section('title', 'Tryout Subtest')
@push('css')
    <style>
        .rbt-title-style-3 {
            font-size: 18px;
        }

        .rbt-btn.btn-sm {
            padding: 0 10px;
            height: 35px;
            line-height: 35px;
        }

        .bootstrap-select .dropdown-menu {
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

        .page-item.active .page-link {
            background: linear-gradient(rgb(29, 59, 100) 0%, rgb(55, 116, 155) 100%) !important;
            border-color: #dee2e6 !important;
        }

        .page-link {
            color: #757575;
        }

        p {
            margin-bottom: 5px;
        }

        .title-question {
            font-size: 16px;
            font-weight: bold;
            color: #616161;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

    <style type="text/css">
        .ck-editor__editable_inline {
            height: 300px;
        }
    </style>
@endpush
@section('content')
<div class="content">
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title">
            <h4 class="rbt-title-style-3 text-center">Try Out</h4>
        </div>
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3">
                <a href="{{ route('subtests', $subTest->try_out_id) }}" class="me-4"><i class="feather feather-arrow-left"></i></a>
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
            @if ($countQuestions < $subTest->total_question)
                <a class="rbt-btn btn-sm bg-color-success" type="button" href="{{ route('questions.create', $subTest->id) }}">Tambah Soal<i class="feather feather-plus"></i></a>
            @endif
        </div>
       
        <div style="margin-bottom: 24px;">
            <div style="display: flex; justify-content: end;">
                {{$questions->links('vendor.pagination.custom')}}
            </div>
            {{-- @php
                $countQuestion = $questions->count();
            @endphp
            <span>Total : {{ $countQuestion }} soal</span> --}}
            @foreach($questions as $key => $item)
            <div class="overflow-visible mt-5" style="padding: 20px; border: 1px solid #E0E0E0; border-radius: 6px;">
                <div class="row">
                    <div class="col-1">
                        {{ ++$no }}
                    </div>
                    <div class="col-9">
                        <label for="question_text" class="title-question">
                            Soal
                        </label>
                        <div class="row mb-2 pb-3">
                            {!! $item->question_text !!}
                        </div>
                        <label for="question_text" class="title-question">
                            Jawaban
                        </label>
                        @php
                            $answers = $item->questionChoices;
                            $statements = \App\Models\TestAnswer::select('statement')->where('question_id', $item->id)->distinct()->pluck('statement');
                        @endphp
                        <div style="border-bottom: 1px solid var(--color-border-2)">
                            @if($item->type !== 'pernyataan')
                            <div class="my-3">
                                @foreach ($answers as $answer)
                                @if ($item->type === 'isian_singkat')
                                    <p>{{ $answer->answer }}</p>
                                @else                               
                                <div class="d-flex mb-2">
                                    {{-- <div class="dot" style="top: 9px; position: relative;" ></div> --}}
                                    @if($answer->is_correct)
                                        <i class="feather feather-check text-success font-weight-bold text-end me-3 align-content-center"></i>
                                        {!! $answer->answer !!}
                                    @else
                                        <i class="feather feather-x text-danger font-weight-bold text-end me-3 align-content-center"></i>
                                        {!! $answer->answer !!}
                                    @endif
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @else
                            <table class="table table-bordered">
                                <thead style="background-color: #F5F5F5">
                                    <tr class="text-center">
                                        <th>Pernyataan</th>
                                        @foreach ($statements as $statement)
                                        <th class="statement-header">{!! $statement !!}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($answers as $answer)
                                    <tr>
                                        <td>{!! $answer->answer !!}</td>
                                        @foreach ($statements as $statement)
                                        <td class="text-center">
                                            @if($answer->statement == $statement)
                                                <i class="feather feather-check"></i>
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="mt-4">
                            <label for="question_text" class="title-question">
                                Pembahasan
                            </label>
                            <div class="row mb-2 pb-3">
                                {!! $item->answer_explanation !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-1 d-flex justify-content-center">
                        <a class="rbt-btn btn-sm bg-color-warning me-2" href="{{route('questions.edit', $item->id)}}"><i class="feather-edit pl--0"></i></a>
                        {{-- <form action="{{route('questions.destroy', $item->id)}}" method="post">
                            @csrf
                            <button class="rbt-btn btn-sm bg-color-danger" onclick="return confirm('Apakah anda yakin untuk menghapus pertanyaan?')"><i class="feather-trash pl--0"></i></button>
                        </form>                         --}}
                        <a type="button" class="rbt-btn btn-sm bg-color-danger delete-button" data-id="{{$item->id}}">
                            <i class="feather-trash pl--0"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
    
</div>
<!-- End Page Wrapper Area -->
<div class="rbt-progress-parent">
    <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
@endsection
@push('scripts')
<script src="{{ asset("js/vendor/backtotop.js")}}"></script>
<script>
     // menambahkan event click pada class delete-button
        $('.delete-button').on('click', function() {
            event.preventDefault();
            // mengambil id dari data-id pada button
            let id = $(this).data('id');
            // menampilkan alert konfirmasi dengan sweetalert
            Swal.fire({
                title: 'Anda yakin ingin menghapus soal ini?',
                icon: 'warning',
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
                        url: '/soal/delete/' + id,
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
                                    location.reload();
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
                                title: 'Error',
                                text: 'Error deleting Category Subtest.',
                            });
                        }
                    });
                }
            });
        });
</script>
@endpush
