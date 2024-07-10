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

        .row>* {
            padding-right: 0;
        }

        p {
            margin-bottom: 5px;
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
                <a href="{{route('questions', $question->sub_test_id)}}" class="me-4"><i class="feather feather-arrow-left"></i></a>
                <b>Daftar Try Out / </b>
                <b>{{ $question->subTest->tryOut->name }} / </b>
                <span style="color: #9f9f9f; font-weight: normal">{{ $question->subTest->name }}</span>       
            </h4>
        </div>
        
        {{-- subtest --}}
        <div class="section-title mb-4">
            <h4 class="rbt-title-style-3 pb--0 border-bottom-0 text-center" style="font-size: 18px;">
                Edit Pertanyaan
            </h4>
        </div>
       
        <div class="inner checkout-form" style="margin-bottom: 24px;">
            <form action="{{route('questions.update', $question->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="sub_test_id" value="{{$question->sub_test_id}}">
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <div class="mb-5">
                    <label for="question_text">
                        Soal
                    </label>
                    <textarea name="question_text" id="editor" class="@error('question_text') is-invalid @enderror">{{ $question->question_text }}</textarea>
                    @error('question_text')
                        <span class="message-info">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="type">
                        Tipe Soal
                    </label>
                    <div class="d-flex justify-content-between">
                        @foreach ($types as $key => $value)
                        <div class="single-method">
                            <input type="radio" name="type" value="{{$key}}" id="type_{{$key}}" {{ $question->type == $key ? 'checked' : '' }}>
                            <label for="type_{{$key}}">{{$value}}</label>
                        </div>
                        @endforeach                           
                    </div>
                    @error('type')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror
                    {{-- <input type="hidden" name="initalType" value="{{$question->type}}"> --}}
                </div>

                <div class="mb-5">
                    <div class="d-flex justify-content-between mb-4">
                        <label for="answer">
                            Jawaban
                        </label>
                        <div id=add-answer>

                        </div>
                        {{-- <button type="button" class="btn btn-primary" id="add-answer">Tambah Jawaban</button> --}}
                    </div>
                    <div id="answer-fields"></div>
                    @error('answers')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror

                    @error('is_correct')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror 

                    {{-- @error('statement')
                        <span class="message-info">
                            {{$message}}
                        </span>
                    @enderror --}}
                </div>

                <div class="row mt-5">
                    <div class="col-4">
                        <a type="button" class="rbt-btn btn-border btn-md bg-color-white radius-round-10 text-center" data-bs-dismiss="modal" style="width: 100%; color: black;" href="{{route('questions', $question->sub_test_id)}}">Batal</a> 
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
            insert: {
                    type: 'inline'
                },
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
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
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
                        // 'exportPDF','exportWord', '|',
                        // 'findAndReplace', 'selectAll', '|',
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
                    showPreviews: false
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
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
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
    }

    function createCKEditor(element, config) {
        CKEDITOR.ClassicEditor.create(element, config);
    }

    createCKEditor(document.getElementById("editor"), ckEditorQuestionConfig);

    const initialType = @json($question->type);
    const answerData = @json($testAnswer);

    document.addEventListener('DOMContentLoaded', function () {
        const answerFieldsContainer = document.getElementById('answer-fields');
        const typeRadios = document.querySelectorAll('input[name="type"]');
        const soalOld = document.getElementById('question');
        const buttonAddAnswerFieldContainer = document.getElementById('add-answer');

        function getAnswerFields(type) {

            if(type == 'pilihan_ganda') {
                createPilihanGandaFields();
            } else if(type == 'pilihan_ganda_majemuk') {
                createPilihanGandaMajemukFields();
            } else if(type == 'pernyataan') {
                createPernyataanFields();
            } else if(type == 'isian_singkat') {
                createIsianSingkatFields();
            }
        }

        getAnswerFields(initialType);

        typeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                answerFieldsContainer.innerHTML = '';
                buttonAddAnswerFieldContainer.innerHTML = '';
                getAnswerFields(this.value);
            });
        });

        function createPilihanGandaFields() {
            if (initialType === 'pilihan_ganda') {
                answerData.forEach((answer, index) => {
                    const i = index + 1;
                    const div = document.createElement('div');
                    div.classList.add('d-flex', 'align-items-center', 'mb-2');

                    const textarea = document.createElement('textarea');
                    textarea.name = `answers[${i}]`;
                    textarea.id = `answer-editor-${i}`;
                    textarea.classList.add('form-control', 'me-2');
                    textarea.value = answer.answer;

                    const hiddenInputIdAnswer = document.createElement('input');
                    hiddenInputIdAnswer.type = 'hidden';
                    hiddenInputIdAnswer.name = `id_answers[${i}]`;
                    hiddenInputIdAnswer.value = answer.id;

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
                    // radio.classList.add('form-check-input');
                    // Add the checked attribute based on is_correct property
                    if (answer.is_correct) {
                        radio.checked = true;
                    }

                    div.appendChild(hiddenInput);
                    div.appendChild(hiddenInputIdAnswer);
                    divRadio.appendChild(radio);
                    divRadio.appendChild(label);
                    div.appendChild(divRadio);
                    div.appendChild(textarea);
                    answerFieldsContainer.appendChild(div);

                    createCKEditor(textarea, ckEditorQuestionConfig);
                })
            } else {
                for (let i = 1; i <= 5; i++) {
                        const div = document.createElement('div');
                        div.classList.add('d-flex', 'align-items-center', 'mb-2');
                        // div.style.cssText = 'border: 1px solid #E0E0E0; border-radius: 5px; padding: 0px 10px;'

                        const textarea = document.createElement('textarea');
                        textarea.name = `answers[${i}]`;
                        textarea.id = `answer-editor-${i}`;
                        textarea.classList.add('form-control', 'me-2');

                        const hiddenInputIdAnswer = document.createElement('input');
                        hiddenInputIdAnswer.type = 'hidden';
                        hiddenInputIdAnswer.name = `id_answers[${i}]`;
                        hiddenInputIdAnswer.value = '';

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

                        div.appendChild(hiddenInput);
                        div.appendChild(hiddenInputIdAnswer);
                        divRadio.appendChild(radio);
                        divRadio.appendChild(label);
                        div.appendChild(divRadio);
                        div.appendChild(textarea);
                        answerFieldsContainer.appendChild(div);

                        createCKEditor(textarea, ckEditorQuestionConfig);
                    }
            }
        }

        function createPilihanGandaMajemukFields() {
            if (initialType === 'pilihan_ganda_majemuk') {
                answerData.forEach ((answer, index) => {
                    const div = document.createElement('div');
                    const i = index + 1;

                    div.classList.add('d-flex', 'align-items-center', 'mb-2');
                    // div.style.cssText = 'border: 1px solid #E0E0E0; border-radius: 5px; padding: 0px 10px;'

                    const hiddenInputIdAnswer = document.createElement('input');
                    hiddenInputIdAnswer.type = 'hidden';
                    hiddenInputIdAnswer.name = `id_answers[${i}]`;
                    hiddenInputIdAnswer.value = answer.id;

                    const textarea = document.createElement('textarea');
                    textarea.name = `answers[${i}]`;
                    textarea.id = `answer-editor-${i}`;
                    textarea.classList.add('form-control', 'me-2');
                    textarea.value = answer.answer;

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
                    // Add the checked attribute based on is_correct property
                    if (answer.is_correct) {
                        checkbox.checked = true;
                    }

                    //menampilkan alert ketika lebih dari 2 checkbox yang dipilih
                    checkbox.addEventListener('change', function () {
                        const checkedCheckboxes = document.querySelectorAll('input[name^="is_correct"]:checked');
                        if (checkedCheckboxes.length > 2) {
                            alert('Anda hanya dapat memilih maksimal 2 jawaban yang benar.');
                            this.checked = false;
                        }
                    });

                    div.appendChild(hiddenInputIdAnswer);
                    divCheckbox.appendChild(hiddenInput);
                    divCheckbox.appendChild(checkbox);
                    divCheckbox.appendChild(label);
                    div.appendChild(divCheckbox);
                    div.appendChild(textarea);
                    answerFieldsContainer.appendChild(div);

                    createCKEditor(textarea, ckeditorAnswerConfig);
                })
            } else {
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

                        const hiddenInputIdAnswer = document.createElement('input');
                        hiddenInputIdAnswer.type = 'hidden';
                        hiddenInputIdAnswer.name = `id_answers[${i}]`;
                        hiddenInputIdAnswer.value = '';

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

                        div.appendChild(hiddenInputIdAnswer);
                        divCheckbox.appendChild(hiddenInput);
                        divCheckbox.appendChild(checkbox);
                        divCheckbox.appendChild(label);
                        div.appendChild(divCheckbox);
                        div.appendChild(textarea);
                        answerFieldsContainer.appendChild(div);

                        createCKEditor(textarea, ckeditorAnswerConfig);
                    }
            }
        }

        function createIsianSingkatFields() {
            if (initialType === 'isian_singkat') {
                const div = document.createElement('div');
                div.classList.add('d-flex', 'align-items-center', 'mb-2');

                const inputIdAnswer = document.createElement('input');
                inputIdAnswer.type = 'hidden';
                inputIdAnswer.name = 'id_answers[]';
                inputIdAnswer.value = answerData[0].id ?? null;

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'answers';
                input.value = answerData[0].answer ?? null;
                input.classList.add('form-control', 'me-2', 'w-100');

                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = 'is_correct';
                radio.value = 1;
                radio.classList.add('form-check-input');

                div.appendChild(input);
                div.appendChild(radio);
                div.appendChild(inputIdAnswer);
                answerFieldsContainer.appendChild(div);
            } else {
                const div = document.createElement('div');
                div.classList.add('d-flex', 'align-items-center', 'mb-2');

                const inputIdAnswer = document.createElement('input');
                inputIdAnswer.type = 'hidden';
                inputIdAnswer.name = 'id_answers[]';
                inputIdAnswer.value = '';

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
                div.appendChild(inputIdAnswer);
                answerFieldsContainer.appendChild(div);
            } 
        }

        function createPernyataanFields() {
            const addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.classList.add('btn', 'btn-primary');
            addButton.textContent = 'Tambah Pernyataan';
            addButton.addEventListener('click', fieldStatement);

            buttonAddAnswerFieldContainer.appendChild(addButton);
            if (initialType === 'pernyataan') {
                answerData.forEach ((answer, index) => {
                    const div = document.createElement('div');
                    const i = index + 1;

                    div.classList.add('row', 'align-items-center', 'mb-2');
                    // div.classList.add('col')

                    const divNumber = document.createElement('div');
                    // divNumber.classList.add('col-1')
                    divNumber.style.cssText = 'width: 4%; padding-right: 0'

                    const divAnswerOption = document.createElement('div');
                    divAnswerOption.classList.add('col-6')

                    const divStatement = document.createElement('div');
                    divStatement.classList.add('col-5')

                    const divButton = document.createElement('div');
                    // divButton.classList.add('col-1')
                    divButton.style.cssText = 'width: fit-content;'

                    const number = document.createElement('span');
                    number.classList.add('me-2');
                    number.textContent = i;

                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `is_correct[${i}]`;
                    hiddenInput.value = 1;

                    const hiddenInputIdAnswer = document.createElement('input');
                    hiddenInputIdAnswer.type = 'hidden';
                    hiddenInputIdAnswer.name = `id_answers[${i}]`;
                    hiddenInputIdAnswer.value = answer.id;

                    const answerOption = document.createElement('input');
                    answerOption.type = 'text';
                    answerOption.name = `answers[${i}]`;
                    answerOption.classList.add('form-control', 'me-2','w-100');
                    answerOption.value = answer.answer;

                    const statement = document.createElement('input');
                    statement.type = 'text';
                    statement.name = `statements[${i}]`;
                    statement.classList.add('form-control', 'me-2', 'w-100');
                    statement.value = answer.statement;
                    
                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.classList.add('btn', 'border', 'border-danger');
                    // removeButton.textContent = iconRemove;
                    removeButton.addEventListener('click', function() {
                        div.remove();
                        updateNumbers();
                    })

                    const iconRemove = document.createElement('i');
                    iconRemove.classList.add('feather', 'feather-trash', 'text-danger');
                    removeButton.appendChild(iconRemove);

                    div.appendChild(hiddenInput);
                    divNumber.appendChild(number);
                    divAnswerOption.appendChild(answerOption);
                    divStatement.appendChild(statement);
                    div.appendChild(hiddenInputIdAnswer);
                    divButton.appendChild(removeButton);
                    div.appendChild(divNumber);
                    div.appendChild(divAnswerOption);
                    div.appendChild(divStatement);
                    div.appendChild(divButton);

                    answerFieldsContainer.appendChild(div);
                })
            } else {
                fieldStatement();
            }
        }

        function updateNumbers() {
            const divs = answerFieldsContainer.children;
            for (let i = 0; i < divs.length; i++) {
                const numberSpan = divs[i].querySelector('span');
                numberSpan.textContent = (i + 1) + '.';
            }
        }

        function fieldStatement() {
            const div = document.createElement('div');
                div.classList.add('row', 'align-items-center', 'mb-2');

                const divNumber = document.createElement('div');
                // divNumber.classList.add('col-1')
                divNumber.style.cssText = 'width: 4%; padding-right: 0'

                const divAnswerOption = document.createElement('div');
                divAnswerOption.classList.add('col-6')

                const divStatement = document.createElement('div');
                divStatement.classList.add('col-5')

                const divButton = document.createElement('div');
                // divButton.classList.add('col-1')
                divButton.style.cssText = 'width: fit-content;'

                const number = document.createElement('span');
                number.classList.add('me-2');
                number.textContent = answerFieldsContainer.children.length + 1;

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `is_correct[]`;
                hiddenInput.value = 1;

                const hiddenInputIdAnswer = document.createElement('input');
                hiddenInputIdAnswer.type = 'hidden';
                hiddenInputIdAnswer.name = `id_answers[]`;
                hiddenInputIdAnswer.value = '';

                const answerOption = document.createElement('input');
                answerOption.type = 'text';
                answerOption.name = 'answers[]';
                answerOption.classList.add('form-control', 'me-2','w-100');
                answerOption.placeholder = 'Pernyataan';

                const statement = document.createElement('input');
                statement.type = 'text';
                statement.name = 'statements[]';
                statement.classList.add('form-control', 'me-2', 'w-100');
                statement.placeholder = 'Jawaban Benar';

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('btn', 'border', 'border-danger');
                removeButton.addEventListener('click', function() {
                    div.remove();
                    updateNumbers();
                })

                const iconRemove = document.createElement('i');
                iconRemove.classList.add('feather', 'feather-trash', 'text-danger');
                removeButton.appendChild(iconRemove);

                div.appendChild(hiddenInput);
                div.appendChild(hiddenInputIdAnswer);
                divNumber.appendChild(number);
                divAnswerOption.appendChild(answerOption);
                divStatement.appendChild(statement);
                divButton.appendChild(removeButton);
                div.appendChild(divNumber);
                div.appendChild(divAnswerOption);
                div.appendChild(divStatement);
                div.appendChild(divButton);

                answerFieldsContainer.appendChild(div);
        }

        
    });

</script>
@endpush