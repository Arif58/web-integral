@extends('web.layout-dashboard')
@section('title', 'Tambah Pertanyaan')
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
            width: fit-content;
        }

        .ck.ck-editor {
            width: 100% !important;
        }

        .ck-editor__editable_inline {
            height: 200px;
        }

    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
@endpush
@section('content')
<div class="content">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--30">
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3">
                <a href="{{route('questions', $subTest->id)}}" class="me-4"><i class="feather feather-arrow-left"></i></a>
                <b>Daftar Try Out / </b>
                <b>{{ $subTest->tryOut->name }} / </b>
                <span style="color: #9f9f9f; font-weight: normal">{{ $subTest->name }}</span>       
            </h4>
        </div>
        
        {{-- subtest --}}
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0 text-center" style="font-size: 18px;">
                Tambah Pertanyaan
            </h4>
        </div>
       
        <div class="inner checkout-form" style="margin-bottom: 24px;">
            <form action="{{route('questions.store', $subTest->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sub_test_id" value="{{$subTest->id}}">
                <div class="mb-5">
                    <label for="question_text">
                        Soal
                    </label>
                    <textarea name="question_text" id="editor">{{ old('question_text') }}</textarea>
                    @error('question_text')
                        <span class="message-info">{{$message}}</span>
                    @enderror
                </div>
                <input type="hidden" id="question" value="{{old('question_text')}}">

                <div class="mb-5">
                    <label for="type">
                        Tipe Soal
                    </label>
                    <div class="d-flex justify-content-between">
                        @foreach ($types as $key => $value)
                        <div class="single-method">
                            <input type="radio" name="type" value="{{$key}}" id="type_{{$key}}" {{ old('type') == $key ? 'checked' : '' }}>
                            <label for="type_{{$key}}">{{$value}}</label>
                        </div>
                        @endforeach                           
                    </div>
                    @error('type')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="answer">
                        Jawaban
                    </label>
                    <div id="answer-fields"></div>
                    {{-- @error('answers')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror

                    @error('is_correct')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror 

                    @error('statement')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror --}}
                </div>

                <div class="row mt-5">
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
@endsection
@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    const ckeditorAnswerConfig = {
        // CKEditor configuration
        // ckfinder: {
        //     // uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        // },
        fileBrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
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
        toolbar: {
            items: [
                'subscript', 'superscript', '|',
                'uploadImage',
                'specialCharacters',
            ],
            shouldNotGroupWhenFull: true
        },
        removePlugins: [
            'AIAssistant',
            'CKBox',
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
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ]
    }

    const ckEditorQuestionConfig = {
            // ckfinder: {
            //     uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            // },
            // filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            // filebrowserUploadMethod: 'form',
            image: {
                insert: {
                    type: 'inline'
                },
                toolbar: [
                    'toggleImageCaption', 'imageTextAlternative',
                    // 'ckboxImageEdit',
                    'imageStyle:inline',
                    'imageStyle:wrapText', 'imageStyle:breakText',
                    'imageStyle:side',
                    'positionImageLeft',
                    'positionImageCenter', 'positionImageRight',
                    'resizeImage',
                    'imageStyle:full',
                    
                ]
            },
            toolbar: {
                items: [
                    'findAndReplace', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: 'Isi Soal',
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
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // htmlSupport: {
            //     allow: [
            //         {
            //             name: /.*/,
            //             attributes: true,
            //             classes: true,
            //             styles: true
            //         }
            //     ]
            // },
            // htmlEmbed: {
            //     showPreviews: true
            // },
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
            removePlugins: [
                'AIAssistant',
                'CKBox',
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
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced',
                'CaseChange',
                'easyImage',
            ]
    }

    function createCKEditor(element, config) {
        CKEDITOR.ClassicEditor.create(element, config);
    }
    document.addEventListener('DOMContentLoaded', function () {
        const answerFieldsContainer = document.getElementById('answer-fields');
        const typeRadios = document.querySelectorAll('input[name="type"]');
        const soalOld = document.getElementById('question');

        typeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                answerFieldsContainer.innerHTML = '';
                if (this.value === 'pilihan_ganda') {
                    for (let i = 1; i <= 5; i++) {
                        const div = document.createElement('div');
                        div.classList.add('d-flex', 'align-items-center', 'mb-2');
                        // div.style.cssText = 'border: 1px solid #E0E0E0; border-radius: 5px; padding: 0px 10px;'

                        const textarea = document.createElement('textarea');
                        textarea.name = `answers[${i}]`;
                        textarea.id = `answer-editor-${i}`;
                        textarea.classList.add('form-control', 'me-2');

                        // Tambahkan input hidden dengan nilai 0
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = `is_correct[${i}]`;
                        hiddenInput.value = 0;

                        const divRadio = document.createElement('div');
                        divRadio.classList.add('single-method');

                        const label = document.createElement('label');
                        label.htmlFor = `correct_answer_${i}`;

                        const radio = document.createElement('input');
                        radio.type = 'radio';
                        radio.name = `is_correct[${i}]`;
                        radio.id = `correct_answer_${i}`;
                        radio.value = 1;
                        radio.classList.add('form-check-input');

                        divRadio.appendChild(hiddenInput);
                        divRadio.appendChild(radio);
                        divRadio.appendChild(label);
                        div.appendChild(divRadio);
                        div.appendChild(textarea);
                        answerFieldsContainer.appendChild(div);

                        createCKEditor(textarea, ckEditorQuestionConfig);
                    }
                } else if(this.value === 'pilihan_ganda_majemuk') {
                    for (let i = 1; i <= 5; i++) {
                        const div = document.createElement('div');
                        div.classList.add('d-flex', 'align-items-center', 'mb-2');
                        // div.style.cssText = 'border: 1px solid #E0E0E0; border-radius: 5px; padding: 0px 10px;'

                        const textarea = document.createElement('textarea');
                        textarea.name = `answers[${i}]`;
                        textarea.id = `answer-editor-${i}`;
                        textarea.classList.add('form-control', 'me-2');

                        const divCheckbox = document.createElement('div');
                        divCheckbox.classList.add('single-method');

                        // Tambahkan input hidden dengan nilai 0
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = `is_correct[${i}]`;
                        hiddenInput.value = 0;

                        const label = document.createElement('label');
                        label.htmlFor = `correct_answer_${i}`;

                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = `is_correct[${i}]`;
                        checkbox.id = `correct_answer_${i}`;
                        checkbox.value = 1;
                        checkbox.classList.add('form-check-input');

                        //menampilkan alert ketika lebih dari 2 checkbox yang dipilih
                        checkbox.addEventListener('change', function () {
                            const checkedCheckboxes = document.querySelectorAll('input[name^="is_correct"]:checked');
                            if (checkedCheckboxes.length > 2) {
                                alert('Anda hanya dapat memilih maksimal 2 jawaban yang benar.');
                                this.checked = false;
                            }
                        });

                        divCheckbox.appendChild(hiddenInput);
                        divCheckbox.appendChild(checkbox);
                        divCheckbox.appendChild(label);
                        div.appendChild(divCheckbox);
                        div.appendChild(textarea);
                        answerFieldsContainer.appendChild(div);

                        createCKEditor(textarea, ckeditorAnswerConfig);
                    }
                } else if (this.value === 'pernyataan') {
                     createPernyataanFields();
                    
                } else if (this.value === 'isian_singkat') {
                        const div = document.createElement('div');
                        div.classList.add('d-flex', 'align-items-center', 'mb-2');

                        // const textarea = document.createElement('textarea');
                        // textarea.name = 'answers';
                        // textarea.id = 'answer-editor';
                        // textarea.classList.add('form-control', 'me-2');

                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = 'answers';
                        input.classList.add('form-control', 'me-2', 'w-100');

                        const radio = document.createElement('input');
                        radio.type = 'radio';
                        radio.name = 'is_correct';
                        radio.value = 1;
                        radio.classList.add('form-check-input');

                        div.appendChild(input);
                        div.appendChild(radio);
                        answerFieldsContainer.appendChild(div);

                       createCKEditor(textarea, ckeditorAnswerConfig);
                    }
                });
        });

        function createPernyataanFields() {
            const div = document.createElement('div');
            div.classList.add('d-flex', 'align-items-center', 'mb-2');

            const number = document.createElement('span');
            number.classList.add('me-2');
            number.textContent = answerFieldsContainer.children.length + 1 + '.';


            const answerOption = document.createElement('input');
            answerOption.type = 'text';
            answerOption.name = 'answer[]';
            answerOption.classList.add('form-control', 'me-2','w-100');
            answerOption.placeholder = 'Option';

            const statement = document.createElement('input');
            statement.type = 'text';
            statement.name = 'statement[]';
            statement.classList.add('form-control', 'me-2', 'w-100');
            statement.placeholder = 'Jawaban Benar';

            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.classList.add('btn', 'btn-primary');
            addButton.textContent = 'Tambah';
            addButton.addEventListener('click', createPernyataanFields);

            div.appendChild(number);
            div.appendChild(answerOption);
            div.appendChild(statement);
            div.appendChild(addButton);
            answerFieldsContainer.appendChild(div);
        }

        // CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        //     // ckfinder: {
        //     //     // uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        //     // },
        //     fileBrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        //     image: {
        //         toolbar: [
        //             'toggleImageCaption', 'imageTextAlternative',
        //             'ckboxImageEdit',
        //             'imageStyle:inline',
        //             'imageStyle:wrapText', 'imageStyle:breakText',
        //             'positionImageLeft',
        //             'positionImageCenter', 'positionImageRight',
        //             'resizeImage',
        //             'imageStyle:full',
        //             'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
        //             'imageInlineEditing'
        //         ]
        //     },
        //     toolbar: {
        //         items: [
        //             'findAndReplace', '|',
        //             'heading', '|',
        //             'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
        //             'bulletedList', 'numberedList', 'todoList', '|',
        //             'outdent', 'indent', '|',
        //             'undo', 'redo',
        //             '-',
        //             'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
        //             'alignment', '|',
        //             'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
        //             'specialCharacters', 'horizontalLine', 'pageBreak', '|',
        //             'textPartLanguage'
        //         ],
        //         shouldNotGroupWhenFull: true
        //     },
        //     list: {
        //         properties: {
        //             styles: true,
        //             startIndex: true,
        //             reversed: true
        //         }
        //     },
        //     heading: {
        //         options: [
        //             { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        //             { model: 'heading1', title: 'Heading 1', class: 'ck-heading_heading1' },
        //             { model: 'heading2', title: 'Heading 2', class: 'ck-heading_heading2' },
        //             { model: 'heading3', title: 'Heading 3', class: 'ck-heading_heading3' },
        //             { model: 'heading4', title: 'Heading 4', class: 'ck-heading_heading4' },
        //             { model: 'heading5', title: 'Heading 5', class: 'ck-heading_heading5' },
        //             { model: 'heading6', title: 'Heading 6', class: 'ck-heading_heading6' }
        //         ]
        //     },
        //     placeholder: 'Welcome to CKEditor 5!',
        //     fontFamily: {
        //         options: [
        //             'default',
        //             'Arial, Helvetica, sans-serif',
        //             'Courier New, Courier, monospace',
        //             'Georgia, serif',
        //             'Lucida Sans Unicode, Lucida Grande, sans-serif',
        //             'Tahoma, Geneva, sans-serif',
        //             'Times New Roman, Times, serif',
        //             'Trebuchet MS, Helvetica, sans-serif',
        //             'Verdana, Geneva, sans-serif'
        //         ],
        //         supportAllValues: true
        //     },
        //     fontSize: {
        //         options: [10, 12, 14, 'default', 18, 20, 22],
        //         supportAllValues: true
        //     },
        //     htmlSupport: {
        //         allow: [
        //             {
        //                 name: /.*/,
        //                 attributes: true,
        //                 classes: true,
        //                 styles: true
        //             }
        //         ]
        //     },
        //     htmlEmbed: {
        //         showPreviews: true
        //     },
        //     link: {
        //         decorators: {
        //             addTargetToExternalLinks: true,
        //             defaultProtocol: 'https://',
        //             toggleDownloadable: {
        //                 mode: 'manual',
        //                 label: 'Downloadable',
        //                 attributes: {
        //                     download: 'file'
        //                 }
        //             }
        //         }
        //     },
        //     removePlugins: [
        //         'AIAssistant',
        //         'CKBox',
        //         'MultiLevelList',
        //         'RealTimeCollaborativeComments',
        //         'RealTimeCollaborativeTrackChanges',
        //         'RealTimeCollaborativeRevisionHistory',
        //         'PresenceList',
        //         'Comments',
        //         'TrackChanges',
        //         'TrackChangesData',
        //         'RevisionHistory',
        //         'Pagination',
        //         'WProofreader',
        //         'MathType',
        //         'SlashCommand',
        //         'Template',
        //         'DocumentOutline',
        //         'FormatPainter',
        //         'TableOfContents',
        //         'PasteFromOfficeEnhanced',
        //         'CaseChange'
        //     ]
        // });
        createCKEditor(document.getElementById("editor"), ckEditorQuestionConfig);
    });
</script>
@endpush