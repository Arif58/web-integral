@extends('web.layout-dashboard')
@section('title', 'Pembahasan Soal')
@push('css')
    <style>
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
@endpush
@section('content')
<!-- Start Card Style -->

<div class="rbt-dashboard-area">
    <div class="container mb-4">
        <a href="javascript:history.back()" class="me-4"><i class="feather feather-arrow-left"></i></a>{{$subTest->categorySubtest->name}} / <span style="font-weight: bold">{{ $subTest->name }}</span>      
    </div>
    <div class="container mt--20">
        <div class="row">
            <div class="col-lg-12">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <!-- Start Dashboard Sidebar  -->
                        <div class="rbt-default-sidebar sticky-top rbt-shadow-box" style="top: 20px;">
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
                                            <div id="answer" class="pb-3"></div>
                                        </div>
                                    </div>
                                    <div class="mt-3" id="answer_explanation">

                                    </div>
                                </div>
                                <div class="mt-5 button-group">

                                    <button class="rbt-btn btn-sm me-4" id="prev_button" style="border: 1px solid #70A4C6; color: black !important;"><label style="cursor: inherit;"><i class="feather-arrow-left"></i> Sebelumnya</label></button>
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
@endsection
@push('scripts')
<script>

    function mark(index, questionId, questionType, questionChoices) {
        let answers = @json($userAnswers);
        let answer = answers[questionId] ?? null;
        if (answer) {
            if (answer.length > 0) {    //ketika jawaban tidak kosong
                let questionNumber = document.getElementById('question_number_' + index);
                for (let i = 0; i < answer.length; i++) {
                    let item = answer[i];
                    if (questionType === 'pilihan_ganda' || questionType === 'pilihan_ganda_majemuk') {
                        let choice = questionChoices.find(choice => choice.id == item);
                        // console.log(item);
                        if (choice.is_correct == 1) {
                            setQuestionStyle(questionNumber, '#29A039', '#E6F5E8');
                        } else {
                            setQuestionStyle(questionNumber, '#C0333B', '#E6F5E8');
                            break; // Break ketika jawaban salah
                        }
                    } else if (questionType === 'isian_singkat') {
                        let choice = questionChoices[0];
                        if (item[1] == choice.answer) {
                            setQuestionStyle(questionNumber, '#29A039', '#E6F5E8');
                        } else {
                            setQuestionStyle(questionNumber, '#C0333B', '#E6F5E8');
                            break; // Break ketika jawaban salah
                        }
                    } else if (questionType === 'pernyataan') {
                        // console.log("length: "+questionChoices.length);
                        // console.log("len "+answer.length)
                        let questionChoicesLength = questionChoices.length;
                        let answerLength = answer.length;
                        if (questionChoicesLength != answerLength) {
                            setQuestionStyle(questionNumber, '#C0333B', '#E6F5E8');
                            break;
                        }
                        let choice = questionChoices.find(choice => choice.id == item[0]);
                        if (item[1] == choice.statement) {
                            setQuestionStyle(questionNumber, '#29A039', '#E6F5E8');
                        } else {
                            setQuestionStyle(questionNumber, '#C0333B', '#E6F5E8');
                            break; // Break ketika jawaban salah
                        }
                    }
                }
            } else {    //ketika jawaban kosong
                let questionNumber = document.getElementById('question_number_' + index);
                setQuestionStyle(questionNumber, '#C0333B', '#E6F5E8');
            }
        } else {
            let questionNumber = document.getElementById('question_number_' + index);
            setQuestionStyle(questionNumber, '#C0333B', '#E6F5E8');
        }

    }

    function markAllQuestion(){
        let questions = @json($questions);
        questions.forEach((question, index) => {
            let keyAnswers = question.id;
            let questionType = question.type;
            let questionChoices = question.question_choices;
            mark(index, keyAnswers, questionType, questionChoices);
        });
    }

    function setQuestionStyle(questionNumber, bgColor, textColor) {
        questionNumber.style.background = bgColor;
        questionNumber.style.color = textColor;
    }


    // Usage example
    document.addEventListener('DOMContentLoaded', (event) => {

        let subTest = @json($subTest);
        let start_time = JSON.parse(localStorage.getItem('start_test'));

        let currentQuestionIndex = 0;
        let questions = @json($questions);

        let totalQuestions = questions.length;
        let answers = @json($userAnswers);

        // Ambil semua tombol dengan id yang dimulai dengan 'btn_question_'
        const questionButtons = document.querySelectorAll('[id^="question_number_"]');

        function loadQuestion(index) {
            let question = questions[index];
            document.getElementById('question_number').innerHTML = `Nomor Soal ${index + 1}`;
            document.getElementById('question_text').innerHTML = question.question_text;
        }

        function loadTestAnswer(index) {
            let choices = questions[index].question_choices;
            document.getElementById('answer').innerHTML = ''; // Clear previous answers
            let answers = @json($userAnswers);

            // menentukan key dari data answers yang ingin diambil
            let keyAnswers = questions[index].id

            let answer = answers[keyAnswers];
            let isAnswerEmpty = answer == null;

            let jawabanKamu = document.createElement('p');
            jawabanKamu.innerHTML = "Jawaban Kamu";
            jawabanKamu.style.fontWeight = 'bold';
            jawabanKamu.style.marginBottom = '5px';
            document.getElementById('answer').appendChild(jawabanKamu);
            let divAlert = document.createElement('div');
            //tambahkan background pada div
            divAlert.style.background = '#F9F0A6';
            divAlert.style.marginBottom = '10px';
            divAlert.classList.add('py-2')
            let alert = document.createElement('p');
            alert.classList.add( 'px-4');
            alert.innerHTML = `<i class="feather-alecirclert- me-2" style="color: #C0333B"></i> Yah, kamu tidak menjawab soal ini :(`;
            divAlert.appendChild(alert);
            if (isAnswerEmpty) {
                document.getElementById('answer').appendChild(divAlert);
            }

            if (questions[index].type === 'pilihan_ganda') {
                for (let i = 0; i < choices.length; i++) {
                    const divRadio = document.createElement('div');
                    divRadio.classList.add('single-method');

                    let choice = choices[i];
                    if (answer == choice.id) {
                        if (choice.is_correct == 1) {
                            divRadio.style.background = '#E6F5E8';
                            divRadio.style.border = '1px solid #4CAF50';
                        } else {
                            divRadio.style.background = '#F8E9ED';
                            divRadio.style.border = '1px solid #C0333B';
                        }
                    }
                    // if (choice.is_correct == 1) {
                    //     divRadio.style.background = '#E6F5E8';
                    //     divRadio.style.border = '1px solid #4CAF50';
                    // }


                    let label = document.createElement('label');
                    label.htmlFor = 'choice_' + choice.id;
                    label.innerHTML = choice.answer;
                    label.style.width = '100%';

                    // divRadio.appendChild(input);
                    divRadio.appendChild(label);
                    document.getElementById('answer').appendChild(divRadio);
                }
            } else if (questions[index].type === 'pilihan_ganda_majemuk') {
                for (let i = 0; i < choices.length; i++) {
                    const divRadio = document.createElement('div');
                    divRadio.classList.add('single-method');

                    // let answerPerItem = answer[i];
                    let choice = choices[i];
                    // looping jawaban user answer
                    answer?.forEach((item) => {
                        if (item == choice.id) {
                            if (choice.is_correct == 1) {
                                divRadio.style.background = '#E6F5E8';
                                divRadio.style.border = '1px solid #4CAF50';
                            } else {
                                divRadio.style.background = '#F8E9ED';
                                divRadio.style.border = '1px solid #C0333B';
                            }
                        }
                    });

                    // if (choice.is_correct == 1) {
                    //     divRadio.style.background = '#E6F5E8';
                    //     divRadio.style.border = '1px solid #4CAF50';
                    // }

                    let label = document.createElement('label');
                    label.htmlFor = 'choice_' + choice.id;
                    label.innerHTML = choice.answer;
                    label.style.width = '100%';

                    // divRadio.appendChild(input);
                    divRadio.appendChild(label);
                    document.getElementById('answer').appendChild(divRadio);
                }
            } else if (questions[index].type === 'isian_singkat') {

                let choice_id = choices[0].id;
                let input = document.createElement('input');
                input.type = 'text';
                input.name = 'answer';
                input.id = 'answer_' + choice_id;
                //disabled input
                input.disabled = true;

                if (answer) {
                    answer.forEach((item) => {
                        if (item[1] == choices[0].answer) {
                            input.style.setProperty('background-color', '#E6F5E8', 'important');
                            input.style.border = '1px solid #4CAF50';
                        }
                        else {
                            input.style.setProperty('background-color', '#F8E9ED', 'important');
                            input.style.border = '1px solid #C0333B';
                        }
                        input.value = item[1];
                    });
                }
                
                // let div = document.createElement('p');
                // div.innerHTML = "Jawaban Kamu";
                // div.style.fontWeight = 'bold';
                // div.style.marginBottom = '5px';
                // document.getElementById('answer').appendChild(div);
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

                let thJawaban = document.createElement('th');
                thJawaban.textContent = 'Jawaban';
                tr.appendChild(thJawaban);

                thead.appendChild(tr);
                table.appendChild(thead);

                let tbody = document.createElement('tbody');

                if (answer) {
                    // console.log(choices);
                    choices.forEach((item) => {
                        let trBody = document.createElement('tr');
                        
                        // Kolom Pernyataan
                        let tdPernyataan = document.createElement('td');
                        tdPernyataan.innerHTML = item.answer; // Pastikan objek item memiliki properti 'pernyataan'
                        tdPernyataan.style.textAlign = 'left';
                        trBody.appendChild(tdPernyataan);
    
                        // Kolom Jawaban
                        let tdJawaban = document.createElement('td');
                        // console.log(answer);
                        answer.forEach((itemAnswer) => {
                            if (item.id == itemAnswer[0]) {
                                 tdJawaban.textContent = itemAnswer[1];
                                if (item.statement == itemAnswer[1]) {
                                    tdJawaban.style.backgroundColor = '#E6F5E8';
                                    // tdJawaban.style.border = '1px solid #4CAF50';
                                } else {
                                    tdJawaban.style.backgroundColor = '#F8E9ED';
                                    // tdJawaban.style.border = '1px solid #C0333B';
                                }
                            } else {
                                tdJawaban.textContent = '';
                                tdJawaban.style.backgroundColor = '#F8E9ED';
                            }
                        });
                        tdJawaban.style.textAlign = 'center';
    
                        trBody.appendChild(tdJawaban);
                        tbody.appendChild(trBody);
                    });
                } else {
                    choices.forEach((item) => {
                        let trBody = document.createElement('tr');
                        
                        // Kolom Pernyataan
                        let tdPernyataan = document.createElement('td');
                        tdPernyataan.innerHTML = item.answer; // Pastikan objek item memiliki properti 'pernyataan'
                        tdPernyataan.style.textAlign = 'left';
                        trBody.appendChild(tdPernyataan);
    
                        // Kolom Jawaban
                        let tdJawaban = document.createElement('td');
                        tdJawaban.textContent = '';
                        tdJawaban.style.textAlign = 'center';
                        tdJawaban.style.backgroundColor = '#F8E9ED';
    
                        trBody.appendChild(tdJawaban);
                        tbody.appendChild(trBody);
                    });
                }

                table.appendChild(tbody);
                document.getElementById('answer').appendChild(table);
            }

            document.getElementById('answer').style.borderBottom = '2px solid var(--color-border-2)';
        }

        function loadAnswerExplanation(index) {
            let div = document.createElement('div');
            let pembahasan = document.createElement('p');
            pembahasan.innerHTML = "Pembahasan";
            pembahasan.style.fontWeight = 'bold';
            pembahasan.style.marginBottom = '10px';

            let choices = questions[index].question_choices;

            let answerExplanation = questions[index].answer_explanation;
            if (questions[index].type === 'pilihan_ganda' || questions[index].type === 'pilihan_ganda_majemuk') {
                let correctAnswer = choices.filter(choice => choice.is_correct == 1);
                //buat correct answer menjadi point point
                let correctAnswerText = correctAnswer.map(choice => choice.answer);
                answerExplanation += `<p class="mt-4">Jawaban: </p>`;

                if(questions[index].type === 'pilihan_ganda_majemuk') {
                    let ul = document.createElement('ul');
                    correctAnswerText.forEach((item) => {
                        let li = document.createElement('li');
                        li.innerHTML = item;
                        ul.appendChild(li);
                    });
                    answerExplanation += ul.outerHTML;
                } else {
                    answerExplanation += `<p>${correctAnswerText.join(', ')}</p>`;
                }

            } else if (questions[index].type === 'isian_singkat') {
                let correctAnswer = choices[0].answer;
                answerExplanation += `<p class="mt-4">Jawaban: </p>`;
                answerExplanation += `<p>${correctAnswer}</p>`;
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

                let thJawaban = document.createElement('th');
                thJawaban.textContent = 'Jawaban';
                tr.appendChild(thJawaban);

                thead.appendChild(tr);
                table.appendChild(thead);

                let tbody = document.createElement('tbody');

                choices.forEach((item) => {
                    let trBody = document.createElement('tr');
                    
                    // Kolom Pernyataan
                    let tdPernyataan = document.createElement('td');
                    tdPernyataan.innerHTML = item.answer; // Pastikan objek item memiliki properti 'pernyataan'
                    tdPernyataan.style.textAlign = 'left';
                    trBody.appendChild(tdPernyataan);

                    // Kolom Jawaban
                    let tdJawaban = document.createElement('td');
                    tdJawaban.textContent = item.statement;
                    tdJawaban.style.textAlign = 'center';
                    trBody.appendChild(tdJawaban);
                    
                    tbody.appendChild(trBody);
                });

                table.appendChild(tbody);
                // document.getElementById('answer').appendChild(table);
                answerExplanation += `<p class="mt-4">Jawaban: <p>`;
                answerExplanation += table.outerHTML;

            }
            div.innerHTML = answerExplanation;


            document.getElementById('answer_explanation').innerHTML = '';
            document.getElementById('answer_explanation').appendChild(pembahasan);
            document.getElementById('answer_explanation').appendChild(div);
            
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
                //menghilangkan button
                saveButton.style.display = 'none';
            } else {
                saveButton.style.display = 'block';
                saveButton.setAttribute('style', 'background: white !important; color: black !important; border: 1px solid #E7A446 !important;');
                saveButton.innerHTML = 'Selanjutnya <i class="feather-arrow-right"></i>';
            }
        }

        function showQuestion(index) {
            if (index < 0 || index >= totalQuestions) return;
            currentQuestionIndex = index;
            loadQuestion(index);
            loadTestAnswer(index);
            loadAnswerExplanation(index);
            buttonHandle(index);
        }

        document.getElementById('prev_button').addEventListener('click', () => {
            // saveCurrentAnswer();
            if (currentQuestionIndex > 0) {
                showQuestion(currentQuestionIndex - 1);
            }
        });

        document.getElementById('save_button').addEventListener('click', () => {
            // saveCurrentAnswer();
            if (currentQuestionIndex < totalQuestions - 1) {
                showQuestion(currentQuestionIndex + 1);
            }
        });

        // Loop melalui setiap tombol dan tambahkan event listener
        questionButtons.forEach(button => {
            const index = button.id.split('_')[2]; // Ambil index dari id tombol
            //ubah jadi integer
            let indexInt = parseInt(index, 10);

            button.addEventListener('click', () => {
                // saveCurrentAnswer();
                showQuestion(indexInt);
            });
        });


        showQuestion(0); // Load the first question
        markAllQuestion();
    });
</script>
@endpush