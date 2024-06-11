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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>


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
            <a class="rbt-btn btn-sm bg-color-success" type="button" href="{{route('questions.create', $subTest->id)}}">Tambah Soal<i class="feather feather-plus"></i></a>
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
</div>
@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    $('#formModal').on('shown.bs.modal', function () {
        
    })
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                ckfinder: {
                        // uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                },
                image: {
                    toolbar: [ 
                        'toggleImageCaption', 'imageTextAlternative', 
                        'ckboxImageEdit',
                        'imageStyle:inline', 
                        'imageStyle:wrapText', 'imageStyle:breakText', 
                        'positionImageLeft', 
                        'positionImageCenter', 'positionImageRight', 
                        'resizeImage', 
                        'imageStyle:full', 
                        'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
                        'imageInlineEditing'
                    ]

                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Welcome to CKEditor 5!',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
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
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    // 'CKFinder',
                    // 'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'MultiLevelList',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
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