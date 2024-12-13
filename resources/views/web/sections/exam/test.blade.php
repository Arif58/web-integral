<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @include('web.layout.head')
    <style>
        @media only screen and (max-width: 767px) {
            .rbt-header .rbt-header-wrapper .header-right {
                flex-basis: 10%;
            }

            .rbt-header .rbt-header-wrapper .header-left {
                flex-basis: 20%;
            }

            .rbt-main-navigation .mainmenu-nav p {
                font-size: 10px;
                margin-top: 2px !important;
            }

            .rbt-main-navigation .mainmenu-nav h5 {
                font-size: 14px;
                margin-bottom: 2px;
            }
        }

        /* Media query untuk layar sangat kecil */
        @media (max-width: 480px) {
            .rbt-btn {
                font-size: 1.1rem !important;
                /* padding: 6px 12px !important; */
            }
        }

        .single-method p{
            display: contents;
        }

        .button-group {
            display: flex;
            justify-content: center;
        }

        input[type=checkbox], input[type=radio] {
            position: fixed;
            /* width: fit-content; */
        }

        .rbt-btn {
            background: white !important;
            color: #757575 !important;
        }

        .single-method {
            border: 1px solid #E0E0E0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px !important;
        }

        p {
            margin-bottom: 5px;
        }

        .scrollable {
            max-height: 500px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        /* label {
            display: inline !important;
        } */

        .btn-choices {
            display: inline !important;
        }
        

    </style>
</head>
<body class="rbt-header-sticky">
    <header class="rbt-header rbt-header-10">
        <div class="rbt-sticky-placeholder"></div>
        <div class="rbt-header-wrapper header-space-betwween header-sticky">
            <div class="container-fluid">
                <div class="mainbar-row rbt-navigation-center align-items-center">
                    <div class="header-left rbt-header-content">
                        <div class="header-info">
                            <div class="logo">
                                <a href="/">
                                    <img src="{{ asset('images/logo/logo_IE.png') }}" alt="Education Logo Images">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="rbt-main-navigation">
                        <nav class="mainmenu-nav text-center">
                            <p class="color-white mb-0 mt-4" style="font-weight: 100">{{$subTest->categorySubtest->name}}</p>
                            <h5 class="color-white">{{$subTest->name}}</h5>
                        </nav>
                    </div>

                    <div class="header-right">
                        <div style="color: white"><i class="feather-clock me-2"></i><span id="time"></span></div>

                        @if (Auth::check())
                            
                        <!-- Navbar Icons -->
                        <ul class="quick-access">

                            <li class="account-access rbt-user-wrapper d-none d-xl-block">
                                <a href="#" style="color: white"><i class="feather-user"></i>{{ Auth::user()->username }}</a>                        
                                
                            </li>

                        </ul>
                        @endif
                        {{-- <div class="row rbt-btn-wrapper d-none d-xl-block">
                            <div class="col-lg">
                                
                            </div>
                            
                        </div> --}}

                        <!-- Start Mobile-Menu-Bar -->
                        {{-- <div class="mobile-menu-bar d-block d-xl-none">
                            <div class="hamberger">
                                <button class="hamberger-button rbt-round-btn">
                                    <i class="feather-menu"></i>
                                </button>
                            </div>
                        </div> --}}
                        <!-- Start Mobile-Menu-Bar -->

                    </div>
                </div>
            </div>
        </div>
        <a class="rbt-close_side_menu" href="javascript:void(0);"></a>
    </header>
    <!-- Start Card Style -->
    <div class="rbt-dashboard-area mt--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-5">
                        <div class="col-lg-4">
                            <!-- Start Dashboard Sidebar  -->
                            <div class="rbt-default-sidebar sticky-top rbt-shadow-box" style="top: 90px;">
                                <div class="inner">
                                    <div class="content-item-content">

                                        <div class="rbt-default-sidebar-wrapper">
                                            <nav class="mainmenu-nav">
                                                <h5 class="rbt-title-style-3">
                                                    Nomor Soal
                                                </h5>
                                                <div class="row justify-content-center">
                                                    @foreach ($questions as $index => $question)     
                                                    <div class="col-2 text-center me-3 mb-3" style="border: 1px solid var(--color-border-2); padding: 10px; border-radius: 5px;" id="question_number_{{$index}}" role="button">
                                                        {{ $index+1 }}
                                                    </div>
                                                    @endforeach
                                                    

                                                </div>
                                            </nav>

                                    
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Dashboard Sidebar  -->
                        </div>
                        <div class="col-lg-8">
                            <div class="content">
                                <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
                                    <h5 class="rbt-title-style-3" id="question_number">

                                    </h5>
                                    <div class="scrollable">
                                        <div id="question_text">
    
                                        </div>
                                        {{-- {!! $item->question_text !!} --}}
                                        <div>
                                            <div id="question_container" class="question-container">
                                                <h5 id="question_number"></h5>
                                                <div id="question_text"></div>
                                                <div id="answer"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 button-group">

                                        <button class="rbt-btn btn-sm me-4" id="prev_button" style=" border: 1px solid #70A4C6; cursor:pointer;"><label for=""><i class="feather-arrow-left"></i> Sebelumnya</label></button>
                                        <div class="doubt-btn rbt-btn btn-sm me-4" id="doubt_button" style="border: 1px solid rgb(112, 164, 198)">
                                            
                                        </div>
                                        <button class="rbt-btn btn-sm" id="save_button"></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card Style -->
    @include('web.layout.js')
    <script>
        function formattedDate(dateObject, useUTC = false) {
            function padZero(num) {
                return num.toString().padStart(2, '0');
            }

            let year = useUTC ? dateObject.getUTCFullYear() : dateObject.getFullYear();
            let month = padZero(useUTC ? dateObject.getUTCMonth() + 1 : dateObject.getMonth() + 1);
            let day = padZero(useUTC ? dateObject.getUTCDate() : dateObject.getDate());
            let hours = padZero(useUTC ? dateObject.getUTCHours() : dateObject.getHours());
            let minutes = padZero(useUTC ? dateObject.getUTCMinutes() : dateObject.getMinutes());
            let seconds = padZero(useUTC ? dateObject.getUTCSeconds() : dateObject.getSeconds());

            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }


        function submitAnswers(redirectUrl = null) {
                let answers = JSON.parse(localStorage.getItem('answers')) || {};
                let participantId = @json($participantId);
                let subTest = @json($subTest);
                let subTestId = subTest.id;
                let lengthSubTest = @json($lengthSubTest);

                // endTest = new Date();
                let endTest = new Date();
                let endTestUTC = new Date(endTest.toISOString())
                let endTestFormatted = formattedDate(endTestUTC, true);
                
                let requestBody;
                //ketika sisa subtest yang harus dikerjakan hanya 1
                if (lengthSubTest == 1) {
                    requestBody = JSON.stringify({
                        participant_id: participantId,
                        answers: answers,
                        endTest: endTestFormatted,
                        ieGems: 3,
                        subTestId: subTestId,
                    });
                } else {
                    requestBody = JSON.stringify({
                        participant_id: participantId,
                        answers: answers,
                        subTestId: subTestId,
                    });
                }
                
                fetch('/exam/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: requestBody,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if(redirectUrl){
                            localStorage.removeItem('answers');
                            window.location.href = redirectUrl;
                        } else {
                            //ketika masih ada subtest yang harus dikerjakan
                            if (lengthSubTest > 1) {
                                //hapus answers pada local storage
                                localStorage.removeItem('answers');
                                localStorage.removeItem('doubtQuestions');
                                window.location.href = `/exam/${participantId}`;
                            } else {
                                localStorage.removeItem('answers');
                                localStorage.removeItem('doubtQuestions');
                                window.location.href = `/exam/finish/${participantId}`;
                            }
                        }
                    } else {
                        alert(data.message);
                    }
                });
        }
        

        function countdown(start_time, duration, elementId) {
            var countDownDate = start_time + duration * 60 * 1000;
            
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById(elementId).innerHTML = hours + ":" + minutes + ":" + seconds;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "EXPIRED";
                    Swal.fire({
                        title: 'Waktu Anda telah habis',
                        text: 'Waktu Anda untuk menjawab telah habis.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        submitAnswers();
                    });
                }
            }, 1000);
        }

        function mark(index, questionId) {
            let answers = JSON.parse(localStorage.getItem('answers')) || {};
            let doubtQuestions = JSON.parse(localStorage.getItem('doubtQuestions')) || [];
            let answer = answers[questionId];
            if (doubtQuestions.includes(questionId)) {
                    markDoubt(index); // Gunakan fungsi markDoubt untuk menandai pertanyaan
            } else {
                if (answer) {
                    if (answer.length > 0) {    //ketika jawaban tidak kosong
                        answer.forEach((item, i) => {
                            // cek apakah item adalah array atau bukan
                            if(Array.isArray(item)) {   //ketika question type isian singkat dan pernyataan
                                if (answer[0][1] == '') {   //ketika jawaban kosong
                                    let questionNumber = document.getElementById('question_number_' + index);
                                    questionNumber.style.background = 'white';
                                    questionNumber.style.color = 'black';
                                } else {    //ketika jawaban tidak kosong
                                    let questionNumber = document.getElementById('question_number_' + index);
                                    questionNumber.style.background = 'var(--gradient-10)';
                                    questionNumber.style.color = 'white';
                                }
                            } else { //ketika question type pilihan ganda dan pilihan ganda majemuk
                                let questionNumber = document.getElementById('question_number_' + index);
                                questionNumber.style.background = 'var(--gradient-10)';
                                questionNumber.style.color = 'white';
                            }
                            
                        });
                    } else {    //ketika jawaban kosong
                        let questionNumber = document.getElementById('question_number_' + index);
                        questionNumber.style.background = 'white';
                        questionNumber.style.color = 'black';
                    }
                }
            }

        }

        function markDoubt(index) {
            let questionNumber = document.getElementById('question_number_' + index);
            questionNumber.style.background = '#9F9F9F';
            questionNumber.style.color = 'white';
        }

        function markAllQuestion(){
            let answers = JSON.parse(localStorage.getItem('answers')) || {};
            // Ambil daftar pertanyaan yang diragukan dari localStorage
            // let doubtQuestions = JSON.parse(localStorage.getItem('doubtQuestions')) || [];
            let questions = @json($questions);
            questions.forEach((question, index) => {
                let keyAnswers = question.id;
                mark(index, keyAnswers);
                // if (doubtQuestions.includes(keyAnswers)) {
                //     markDoubt(index); // Gunakan fungsi markDoubt untuk menandai pertanyaan
                // }
            });
            
        }

        // Usage example
        document.addEventListener('DOMContentLoaded', (event) => {

            // Prevent back navigation
            history.pushState(null, null, location.href);

            //tambahkan event listener sweetalert ketika user menekan tombol back
            window.addEventListener('popstate', function (event) {
                Swal.fire({
                    title: 'Anda yakin ingin keluar?',
                    text: "Jika Anda keluar, semua jawaban akan dikirim dan Anda tidak bisa melanjutkan pengerjaan Try Out.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DC7E3F',
                    cancelButtonColor: 'transparent',
                    confirmButtonText: 'Ya, keluar',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    buttonsStyling: true,
                    width: '500px',
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitAnswers('/tryout-saya');
                    } else {
                        history.pushState(null, null, location.href);
                    }
                });
            });
            // let endTest = new Date();
            // let endTestUTC = new Date(endTest.toISOString())
            // let endTestFormatted = formattedDate(endTest);
            // let endTestFormattedUTC = formattedDate(endTestUTC, true);
            
            // console.log("end test utc: "+endTestUTC);
            // console.log("end test: "+endTest)
            // console.log("end test formatted: "+endTestFormatted);
            // console.log("end test formatted utc: "+endTestFormattedUTC);

            let subTest = @json($subTest);
            // let start_time = JSON.parse(localStorage.getItem('start_test'));
            // console.log(start_time);
            let startTest = @json($startTest);
            // Mengonversi string ke objek Date
            const dateObject = new Date(startTest.replace(" ", "T"));

            // Mendapatkan timestamp dalam milidetik
            let start_time = dateObject.getTime();
            countdown(start_time, subTest.duration, 'time');
            // countdown(start_time, 900, 'time');

            let currentQuestionIndex = 0;
            let questions = @json($questions);
            let totalQuestions = questions.length;
            let answers = JSON.parse(localStorage.getItem('answers')) || {};

            // Ambil semua tombol dengan id yang dimulai dengan 'btn_question_'
            const questionButtons = document.querySelectorAll('[id^="question_number_"]');

            function loadQuestion(index) {
                let question = questions[index];
                document.getElementById('question_number').innerHTML = `Nomor Soal ${index + 1}`;
                document.getElementById('question_text').innerHTML = question.question_text;
                // document.getElementById('question_number_'+index).style.border = '1px solid #DC7E3F';
            }

            function saveAnswer(index, answer) {
                let answers = JSON.parse(localStorage.getItem('answers')) || {};
                answers[index] = answer;
                localStorage.setItem('answers', JSON.stringify(answers));
            }

            function loadTestAnswer(index) {
                let choices = questions[index].question_choices;
                document.getElementById('answer').innerHTML = ''; // Clear previous answers
                let answers = JSON.parse(localStorage.getItem('answers')) || {};

                // menentukan key dari data answers yang ingin diambil
                let keyAnswers = questions[index].id

                let answer = answers[keyAnswers];

                if (questions[index].type === 'pilihan_ganda') {
                    for (let i = 0; i < choices.length; i++) {
                        const divRadio = document.createElement('div');
                        divRadio.classList.add('single-method');

                        let choice = choices[i];
                        let input = document.createElement('input');
                        input.type = 'radio';
                        input.name = 'answer';
                        input.value = choice.id;
                        input.id = 'choice_' + choice.id;
                        input.addEventListener('change', (event) => {
                            // saveAnswer(questions[index].id, [choice.id]);
                            saveCurrentAnswer();
                            mark(currentQuestionIndex, questions[index].id);
                        });
                        if (answer == choice.id) {
                            input.checked = true;
                        }

                        let label = document.createElement('label');
                        label.htmlFor = 'choice_' + choice.id;
                        label.innerHTML = choice.answer;
                        label.style.width = '100%';

                        divRadio.appendChild(input);
                        divRadio.appendChild(label);
                        document.getElementById('answer').appendChild(divRadio);
                    }
                } else if (questions[index].type === 'pilihan_ganda_majemuk') {
                    for (let i = 0; i < choices.length; i++) {
                        const divRadio = document.createElement('div');
                        divRadio.classList.add('single-method');

                        let choice = choices[i];
                        let input = document.createElement('input');
                        input.type = 'checkbox';
                        input.name = 'answer';
                        input.value = choice.id;
                        input.id = 'choice_' + choice.id;
                        
                        input.addEventListener('change', (event) => {
                            const checkedCheckboxes = document.querySelectorAll('input[name="answer"]:checked');
                            if (checkedCheckboxes.length > 2) {
                                event.target.checked = false;
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Perhatian',
                                    text: 'Anda hanya bisa memilih maksimal 2 jawaban.',
                                    showConfirmButton: true,
                                    timer: 2000
                                });
                                return;
                            }
                            // saveAnswer(questions[index].id, [choice.id]);
                            saveCurrentAnswer();
                            mark(currentQuestionIndex, questions[index].id);
                        });
                        if (answer) {
                            for (let j = 0; j < answer.length; j++) {
                                if (answer[j] == choice.id) {
                                    input.checked = true;
                                }
                            }
                        }

                        let label = document.createElement('label');
                        label.htmlFor = 'choice_' + choice.id;
                        label.innerHTML = choice.answer;
                        label.style.width = '100%';

                        divRadio.appendChild(input);
                        divRadio.appendChild(label);
                        document.getElementById('answer').appendChild(divRadio);
                    }
                } else if (questions[index].type === 'isian_singkat') {

                    let choice_id = choices[0].id;
                    let input = document.createElement('input');
                    input.type = 'text';
                    input.name = 'answer';
                    input.id = 'answer_' + choice_id;
                    if (answer) {
                        answer.forEach((item) => {
                            input.value = item[1];
                        });
                    }
                    // input.value = '';
                    input.style.border = '1px solid #E0E0E0';
                    input.addEventListener('input', (event) => {
                        let answer = [choice_id, event.target.value];
                        // saveAnswer(questions[index].id, [answer]);
                        saveCurrentAnswer();
                        mark(currentQuestionIndex, questions[index].id);
                    });
                    document.getElementById('answer').appendChild(input);
                } else if (questions[index].type === 'pernyataan') {
                    let table = document.createElement('table');
                    table.classList.add('table', 'table-bordered');

                    let thead = document.createElement('thead');
                    thead.style.backgroundColor = '#F5F5F5';

                    let tr = document.createElement('tr');
                    tr.classList.add('text-center');

                    let thPernyataan = document.createElement('th');
                    thPernyataan.textContent = 'Pernyataan';
                    tr.appendChild(thPernyataan);

                    let statement = [];
                    choices.forEach((choice) => {
                        if (!statement.includes(choice.statement)) {
                            statement.push(choice.statement);
                        }
                    });

                    statement.forEach((item) => {
                        let th = document.createElement('th');
                        th.classList.add('statement-header');
                        th.textContent = item;
                        tr.appendChild(th);
                    });

                    thead.appendChild(tr);
                    table.appendChild(thead);

                    let tbody = document.createElement('tbody');

                    choices.forEach((choice, i) => {
                        let tr = document.createElement('tr');
                        tr.classList.add('single-method');

                        let tdAnswer = document.createElement('td');
                        tdAnswer.innerHTML = choice.answer;
                        tr.appendChild(tdAnswer);

                        let question_id = choice.question_id;

                        statement.forEach((item, index) => {
                            let choice_id = choice.id;

                            let td = document.createElement('td');
                            td.classList.add('text-center');

                            let input = document.createElement('input');
                            input.type = 'radio';
                            input.name = `answer_${i}`;
                            input.value = item;
                            //membuat id yang unik
                            input.id = `answer_${choice_id}_${index}`;

                            let label = document.createElement('label');
                            label.classList.add('btn-choices');
                            label.htmlFor = `answer_${choice_id}_${index}`;
                            // label.style.position = 'absolute';

                            input.addEventListener('change', (event) => {
                                let answer = [choice_id, input.value];
                                // saveAnswer(question_id, answer); gajadi dipake diganti sama fungsi saveCurrentAnswer
                                saveCurrentAnswer();
                                mark(currentQuestionIndex, question_id);
                            });

                            if (answer) {
                                answer.forEach((answer) => {
                                    if (answer[0] == choice_id && answer[1] == item) {
                                        input.checked = true;
                                    }
                                });
                            }

                            td.appendChild(input);
                            td.appendChild(label);

                            tr.appendChild(td);
                        });

                        tbody.appendChild(tr);
                    });

                    table.appendChild(tbody);
                    document.getElementById('answer').appendChild(table);
                }
            }

            function buttonHandle($index) {
                let prevButton = document.getElementById('prev_button');
                let saveButton = document.getElementById('save_button');

                if ($index == 0) {
                    prevButton.style.display = 'none';
                } else {
                    prevButton.style.display = 'block';
                }

                if ($index == totalQuestions - 1) {
                    saveButton.setAttribute('style', 'background: var(--gradient-10) !important; color: white !important; border: 1px solid #E7A446 !important;');
                    saveButton.innerHTML = 'Selesai <i class="feather-arrow-right"></i>';
                } else {
                    saveButton.setAttribute('style', 'background: white !important; color: black !important; border: 1px solid #E7A446 !important;');
                    saveButton.innerHTML = 'Selanjutnya <i class="feather-arrow-right"></i>';
                }
            }

            function showQuestion(index) {
                if (index < 0 || index >= totalQuestions) return;
                currentQuestionIndex = index;
                loadQuestion(index);
                loadTestAnswer(index);
                buttonHandle(index);
                doubtQuestion(index);
            }

            function saveCurrentAnswer() {
                if (questions[currentQuestionIndex].type === 'pilihan_ganda_majemuk' || questions[currentQuestionIndex].type === 'pilihan_ganda') {
                    let answer = [];
                    document.querySelectorAll('input[name="answer"]:checked').forEach((input) => {
                        answer.push(input.value);
                    });
                    saveAnswer(questions[currentQuestionIndex].id, answer);
                } else if (questions[currentQuestionIndex].type === 'isian_singkat') {
                    let answer = [];
                    let input = document.querySelector('input[name="answer"]');
                    let choice_id = input.id.split('_')[1];
                    let value = input.value;
                    answer.push([choice_id, value]);

                    saveAnswer(questions[currentQuestionIndex].id, answer);
                } else if (questions[currentQuestionIndex].type === 'pernyataan') {
                    let answer = [];
                    document.querySelectorAll('input[type="radio"]:checked').forEach((input) => {
                        let choice_id = input.id.split('_')[1];
                        let statement = input.value;
                        answer.push([choice_id, statement]);
                    });
                    saveAnswer(questions[currentQuestionIndex].id, answer);
                }
            }

            document.getElementById('prev_button').addEventListener('click', () => {
                saveCurrentAnswer();
                if (currentQuestionIndex > 0) {
                    showQuestion(currentQuestionIndex - 1);
                }
            });
          
            //membuat fungsi untuk menandai soal yang diragukan
            function doubtQuestion(index) {
                let questionId = questions[index].id;
                document.getElementById('doubt_button').innerHTML = '';
                //membuat tombol ragu-ragu pada setiap nomor soal menggunakan checkbox
                let doubtButton = document.createElement('input');
                doubtButton.type = 'checkbox';
                doubtButton.id = 'doubt_' + index;
                doubtButton.name = 'doubt';
                doubtButton.value = index;
                doubtButton.style.display = 'none';

                let doubtQuestions = JSON.parse(localStorage.getItem('doubtQuestions')) || [];
                // Periksa apakah questionId ada di dalam doubtQuestions
                if (doubtQuestions.includes(questionId)) {
                    doubtButton.checked = true; // Tandai checkbox sebagai aktif
                }

                let doubtLabel = document.createElement('label');
                doubtLabel.htmlFor = 'doubt_' + index;
                doubtLabel.innerHTML = 'Ragu-Ragu';

                let doubtButtonContainer = document.getElementById('doubt_button');
                doubtButtonContainer.appendChild(doubtButton);
                doubtButtonContainer.appendChild(doubtLabel);


                doubtButton.addEventListener('change', (event) => {
                    let questionNumber = document.getElementById('question_number_' + index);
                    // Ambil daftar soal ragu-ragu dari localStorage
                    let doubtQuestions = JSON.parse(localStorage.getItem('doubtQuestions')) || [];

                    if (event.target.checked) {
                        // Tambahkan ID soal ke daftar jika belum ada
                        if (!doubtQuestions.includes(questionId)) {
                            doubtQuestions.push(questionId);
                        }
                        localStorage.setItem('doubtQuestions', JSON.stringify(doubtQuestions));
                        mark(index, questionId)
                    } else {
                        // Hapus ID soal dari daftar
                        doubtQuestions = doubtQuestions.filter(id => id !== questionId);
                        localStorage.setItem('doubtQuestions', JSON.stringify(doubtQuestions));
                        mark(index, questionId)
                    }
                });

            }

            document.getElementById('save_button').addEventListener('click', () => {
                saveCurrentAnswer();
                if (currentQuestionIndex < totalQuestions - 1) {
                    showQuestion(currentQuestionIndex + 1);
                } else if (currentQuestionIndex === totalQuestions - 1) {
                    Swal.fire({
                        title: 'Anda yakin ingin menyimpan jawaban?',
                        text: "Periksa kembali jawaban Anda sebelum menyimpan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DC7E3F',
                        cancelButtonColor: 'transparent',
                        confirmButtonText: 'Ya, saya yakin',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        buttonsStyling: true,
                        width: '600px',
                        heightAuto: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //send answer to server
                            submitAnswers();
                        }
                    });
                }
            });

            // Loop melalui setiap tombol dan tambahkan event listener
            questionButtons.forEach(button => {
                const index = button.id.split('_')[2]; // Ambil index dari id tombol
                //ubah jadi integer
                let indexInt = parseInt(index, 10);

                button.addEventListener('click', () => {
                    saveCurrentAnswer();
                    showQuestion(indexInt);
                });
            });


            showQuestion(0); // Load the first question
            markAllQuestion();
        });
    </script>
</body>
</html>