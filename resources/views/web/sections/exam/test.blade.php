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

    </style>
</head>
<body>
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
                            <p class="color-white mb-0 mt-4" style="font-weight: 100">Test Potensi Skolastik</p>
                            <h5 class="color-white">Kemampuan Penalaran Umum</h5>
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
    <div class="rbt-dashboard-area rbt-section-gapBottom mt--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-5">
                        <div class="col-lg-4">
                            <!-- Start Dashboard Sidebar  -->
                            <div class="rbt-default-sidebar sticky-top rbt-shadow-box" style="top: 10px;">
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
                                    <div id="question_text">

                                    </div>
                                    {{-- {!! $item->question_text !!} --}}
                                    <div>
                                        <div id="question_container" class="question-container">
                                            <h5 id="question_number"></h5>
                                            <div id="question_text"></div>
                                            <div id="answer">

                                            </div>
                                            {{-- <input type="text" id="answer"> --}}
                                            <div class="mt-5 button-group">

                                                <button class="rbt-btn btn-sm me-4" id="prev_button" style=" border: 1px solid #70A4C6"><i class="feather-arrow-left"></i> Sebelumnya</button>
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
        </div>
    </div>
    <!-- End Card Style -->
    <script>
        function formattedDate(dateObject) {
            function padZero(num) {
                return num.toString().padStart(2, '0');
            }

            let year = dateObject.getFullYear();
            let month = padZero(dateObject.getMonth() + 1);
            let day = padZero(dateObject.getDate());
            let hours = padZero(dateObject.getHours());
            let minutes = padZero(dateObject.getMinutes());
            let seconds = padZero(dateObject.getSeconds());

            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }

         function submitAnswers() {
                let answers = JSON.parse(localStorage.getItem('answers')) || {};
                let participantId = @json($participantId);
                let subTestCurrentIndex = JSON.parse(localStorage.getItem('subTestCurrentIndex'));
                let lengthSubTest = JSON.parse(localStorage.getItem('subTestId')).length;
                
                let startTest = JSON.parse(localStorage.getItem('start_test'));
                //convert startTest to date
                startTest = new Date(startTest);
                startTestFormatted = formattedDate(startTest);

                endTest = new Date();
                endTestFormatted = formattedDate(endTest);
                
                let requestBody;
                if (subTestCurrentIndex == 0) {
                    requestBody = JSON.stringify({
                        participant_id: participantId,
                        answers: answers,
                        startTest: startTestFormatted,
                        endTest: endTestFormatted,
                    });
                } else {
                    requestBody = JSON.stringify({
                        participant_id: participantId,
                        answers: answers,
                        endTest: endTestFormatted,
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
                        if (subTestCurrentIndex < lengthSubTest - 1) {
                            subTestCurrentIndex++;
                            localStorage.setItem('subTestCurrentIndex', subTestCurrentIndex);
                            //hapus answers pada local storage
                            localStorage.removeItem('answers');
                            window.location.href = `/exam/${participantId}`;
                        } else {
                            alert(data.message);
                            //hapus answers,subtestId, subTestCurrentIndex, start test pada local storage
                            localStorage.removeItem('answers');
                            localStorage.removeItem('subTestId');
                            localStorage.removeItem('subTestCurrentIndex');
                            localStorage.removeItem('start_test');
                            window.location.href = '/tryout-saya';
                        }
                    } else {
                        alert('Gagal menyimpan jawaban');
                    }
                });
        }

        function countdown(start_time, duration, elementId) {
            var countDownDate = start_time + duration * 60 * 1000;
            // var countDownDate = start_time + 500 * 60 * 1000;
            
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
                    alert('Waktu Anda telah habis');
                    submitAnswers();
                }
            }, 1000);
        }

        function mark(index) {
            let questionNumber = document.getElementById('question_number_' + index);
            questionNumber.style.background = 'var(--gradient-10)';
            questionNumber.style.color = 'white';
        }

        function markAllQuestion(){
            let answers = JSON.parse(localStorage.getItem('answers')) || {};
            let questions = @json($questions);
            questions.forEach((question, index) => {
                let keyAnswers = question.id;
                let answer = answers[keyAnswers];
                if (answer) {
                    if (answer.length > 0) {
                        let questionNumber = document.getElementById('question_number_' + index);
                        questionNumber.style.background = 'var(--gradient-10)';
                        questionNumber.style.color = 'white';
                    }
                }
            });
        }

        // Usage example
        document.addEventListener('DOMContentLoaded', (event) => {
            let subTest = @json($subTest);
            let start_time = JSON.parse(localStorage.getItem('start_test'));
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
                            saveAnswer(questions[index].id, choice.id);
                            mark(currentQuestionIndex);
                        });
                        if (answer == choice.id) {
                            input.checked = true;
                        }

                        let label = document.createElement('label');
                        label.htmlFor = 'choice_' + choice.id;
                        label.innerHTML = choice.answer;

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
                            saveAnswer(questions[index].id, choice.id);
                            mark(currentQuestionIndex);
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
                    input.addEventListener('change', (event) => {
                        let answer = [choice_id, event.target.value];
                        saveAnswer(questions[index].id, answer);
                        mark(currentQuestionIndex);
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
                        tdAnswer.textContent = choice.answer;
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
                            label.htmlFor = `answer_${choice_id}_${index}`;
                            label.style.position = 'absolute';

                            input.addEventListener('change', (event) => {
                                let answer = [choice_id, input.value];
                                saveAnswer(question_id, answer);
                                mark(currentQuestionIndex);
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
                saveButton.style.background = 'white';

                if ($index == 0) {
                    prevButton.style.display = 'none';
                } else {
                    prevButton.style.display = 'block';
                }

                if ($index == totalQuestions - 1) {
                    saveButton.style.background = 'var(--gradient-10) !important';
                    saveButton.innerHTML = 'Selesai <i class="feather-arrow-right"></i>';
                } else {
                    saveButton.innerHTML = 'Selanjutnya <i class="feather-arrow-right"></i>';
                    saveButton.style.border = '1px solid #E7A446';
                }
            }

            function showQuestion(index) {
                if (index < 0 || index >= totalQuestions) return;
                currentQuestionIndex = index;
                loadQuestion(index);
                loadTestAnswer(index);
                // markQuestion(index);
                buttonHandle(index);
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

            document.getElementById('save_button').addEventListener('click', () => {
                saveCurrentAnswer();
                if (currentQuestionIndex < totalQuestions - 1) {
                    showQuestion(currentQuestionIndex + 1);
                } else if (currentQuestionIndex === totalQuestions - 1) {
                    //send answer to server
                    submitAnswers();
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