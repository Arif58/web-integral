@extends('web.layout-exam')
@section('content')
<div class="content">
    {{-- @php
    @endphp --}}
    <div class="container" style="width: 500px;">
                <div class="course-sidebar sticky-top rbt-shadow-box">
                    <div class="inner">
                        <div class="rbt-card-img text-center py-4 height-200 bg-gradient-20 d-flex align-content-center flex-wrap justify-content-center radius-6">
                            <p class="color-white mb-0" id="category_subtest">
                            </p>
                            <p style="font-size: 30px; font-weight: normal; color: white;" id="sub_test"></p>
                        </div>
            
                        <div class="content-item-content">
                            <div class="rbt-price-wrapper text-center">
                                <ul class="rbt-meta my-3">
                                    <li id="total_question">
                                        
                                    </li>
                                    <span>|</span>
                                    <li id="duration">
                                        
                                    </li>
                                </ul>
                            </div>
            
            
                            <div class="buy-now-btn">
                                <a class="rbt-btn btn-gradient w-100 d-block text-center radius-10" id="start_exam_button">
                                    <span class="btn-text">Kerjakan Sekarang</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
           
            let categorySubTestField = document.getElementById('category_subtest');
            let subTestField = document.getElementById('sub_test');
            let totalQuestionField = document.getElementById('total_question');
            let durationField = document.getElementById('duration');
            let startExamButton = document.getElementById('start_exam_button');

            let subTestId = JSON.parse(localStorage.getItem('subTestId'));
            let subTestCurrentIndex = JSON.parse(localStorage.getItem('subTestCurrentIndex'));

            let participant = @json($participant);

            
            if (subTestId === null) {
                let subTestIds = @json($subTestIds);
                localStorage.setItem('subTestId', JSON.stringify(subTestIds));
                localStorage.setItem('subTestCurrentIndex', 0);
                let subTest = @json($subTest[0]);
 
                categorySubTestField.innerHTML = subTest.category_subtest.name;
                subTestField.innerHTML = subTest.name;
                totalQuestionField.innerHTML = `<i class="feather-book"></i> ${subTest.total_question} Soal`;
                durationField.innerHTML = `<i class="feather-clock"></i> ${subTest.duration} Menit`;
                startExamButton.href = `/exam/${participant.id}/sub-test/${subTest.id}`;

            } else {
                let subTestIdLength = subTestId.length;
                if (subTestCurrentIndex < subTestIdLength) {
                    subTestCurrentIndex = parseInt(subTestCurrentIndex, 10);
                    let subTest = @json($subTest)[subTestCurrentIndex];
                    categorySubTestField.innerHTML = subTest.category_subtest.name;
                    subTestField.innerHTML = subTest.name;
                    totalQuestionField.innerHTML = `<i class="feather-book"></i> ${subTest.total_question} Soal`;
                    durationField.innerHTML = `<i class="feather-clock"></i> ${subTest.duration} Menit`;
                    startExamButton.href = `/exam/${participant.id}/sub-test/${subTest.id}`;

                }       
            }
            startTest = new Date().getTime();
            localStorage.setItem('start_test', startTest);
        });
    </script>
@endpush