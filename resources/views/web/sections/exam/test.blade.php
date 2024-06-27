<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        }

        .rbt-btn {
            background: white !important;
            color: #757575 !important;
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
                                                    <div class="col-2 text-center me-3 mb-3" style="border: 1px solid var(--color-border-2); padding: 10px; border-radius: 5px;" id="question_number_{{$index}}">
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
                                    <div class="container">
                                        <div id="question_container" class="question-container">
                                            <h5 id="question_number"></h5>
                                            <div id="question_text"></div>
                                            <div id="answer">

                                            </div>
                                            {{-- <input type="text" id="answer"> --}}
                                            <div class="mt-5 button-group">

                                                <button class="rbt-btn btn-sm me-4" id="prev_button" style=" border: 1px solid #70A4C6"><i class="feather-arrow-left"></i> Sebelumnya</button>
                                                <button class="rbt-btn btn-sm" id="save_button" style="border: 1px solid #E7A446">Selanjutnya <i class="feather-arrow-right"></i></button>
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
                    alert('Waktu Anda telah habis');
                }
            }, 1000);
        }

        // Usage example
        document.addEventListener('DOMContentLoaded', (event) => {
            let subTest = @json($subTest);
            let start_time = JSON.parse(localStorage.getItem('start_test'));
            // countdown(start_time, subTest.duration, 'time');
            countdown(start_time, 90, 'time');

            let currentQuestionIndex = 0;
            let questions = @json($questions);
            let totalQuestions = questions.length;

            console.log(questions);

            function loadQuestion(index) {
                let question = questions[index];
                document.getElementById('question_number').innerHTML = `Nomor Soal ${index + 1}`;
                document.getElementById('question_text').innerHTML = question.question_text;
                document.getElementById('question_number_'+index).style.backgroundColor = 'green';
            }

            function saveAnswer(index, answer) {
                let answers = JSON.parse(localStorage.getItem('answers')) || {};
                answers[index] = answer;
                localStorage.setItem('answers', JSON.stringify(answers));
            }

            function loadTestAnswer(index) {
                let choices = questions[index].question_choices;
                document.getElementById('answer').innerHTML = ''; // Clear previous answers


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
                            saveAnswer(index, choice.id);
                        });

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
                            saveAnswer(index, choice.id);
                        });

                        let label = document.createElement('label');
                        label.htmlFor = 'choice_' + choice.id;
                        label.innerHTML = choice.answer;

                        divRadio.appendChild(input);
                        divRadio.appendChild(label);
                        document.getElementById('answer').appendChild(divRadio);
                    }
            }
            } 

            function loadAnswer(index) {
                let answers = JSON.parse(localStorage.getItem('answers')) || {};
                return answers[index] || '';
            }

            function showQuestion(index) {
                if (index < 0 || index >= totalQuestions) return;
                currentQuestionIndex = index;
                loadQuestion(index);
                loadTestAnswer(index);
            }

            document.getElementById('prev_button').addEventListener('click', () => {
                if (currentQuestionIndex > 0) {
                    showQuestion(currentQuestionIndex - 1);
                }
            });

            // document.getElementById('next_button').addEventListener('click', () => {
            //     if (currentQuestionIndex < totalQuestions - 1) {
            //         showQuestion(currentQuestionIndex + 1);
            //     }
            // });

            document.getElementById('save_button').addEventListener('click', () => {
                let answer = document.getElementById('answer').value;
                saveAnswer(currentQuestionIndex, answer);
                if (currentQuestionIndex < totalQuestions - 1) {
                    showQuestion(currentQuestionIndex + 1);
                }
            });

            showQuestion(0); // Load the first question
        });
    </script>
</body>
</html>