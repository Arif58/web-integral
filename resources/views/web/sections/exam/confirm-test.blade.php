@extends('web.layout-exam')
@push('css')
    <style>
        @media only screen and (max-width: 767px) {
           .rbt-card-img {
                max-width: 300px;
           }
        }
    </style>
@endpush
@section('content')
<div class="content">
    <div class="inner">
        <div class="rbt-card-img text-center py-4 px-5 height-200 bg-gradient-20 align-content-center flex-wrap justify-content-center radius-6" style="width: 400px">
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
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Prevent back navigation
            history.pushState(null, null, location.href);
            //tambahkan event listener sweetalert ketika user menekan tombol back
            window.addEventListener('popstate', function (event) {
                Swal.fire({
                    title: 'Anda yakin ingin keluar?',
                    text: "Jika Anda keluar maka Anda tidak bisa melanjutkan pengerjaan Try Out.",
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
                        window.location.href = '/tryout-saya';
                    } else {
                        history.pushState(null, null, location.href);
                    }
                });
            });
           
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