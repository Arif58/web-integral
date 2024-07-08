<?php

use App\Http\Controllers\CategorySubtestController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\Fortify\AuthenticatedSessionController;
use App\Http\Controllers\Fortify\RegisteredUserController;
use App\Http\Controllers\Fortify\VerifyEmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\MyTryOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentAchievementController;
use App\Http\Controllers\SubTestController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TryOutController;
use App\Http\Controllers\TryoutDetailController;
use App\Http\Controllers\TryOutUtbkController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


// Route::get('/logout', function () {
//     return view('web.sections.landing-page.home');
// })->name('logout');

Route::get('/try-out-utbk', [TryOutUtbkController::class, 'index'])->name('tryout-utbk');

Route::get('/produk/try-out-utbk/{id}', [TryOutUtbkController::class, 'show'])->name('tryout-detail');

//override register routes
Route::middleware('guest')->group(function () {
    
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify');
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(OrderController::class)->group(function () {
        Route::get('/payment/{productId}', 'index')->name('payment');
    
        Route::post('/checkout', 'checkout')->name('checkout');

        Route::get('/riwayat-pembelian', 'getOrderHistory')->name('order-history');

        Route::get('/payment/qris/{snapToken}', 'paymentQris')->name('payment-qris');
    });
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profil-saya', 'index')->name('profile');
        Route::get('/profil/edit/{id}', 'edit')->name('profile.edit');
        Route::put('/profil/update/{id}', 'update')->name('profile.update');
        Route::get('/profil/get-city/{id}', 'getCity')->name('profile.get-city');
        Route::get('/profil/edit-major/{id}', 'editMajor')->name('profile.edit-major');
        Route::get('/profil/get-major/{id}', 'getMajor')->name('profile.get-major');
        Route::put('/profil/update-major/{id}', 'updateMajor')->name('profile.update-major');
        Route::get('/lengkapi-profil', 'getCompleteProfile')->name('complete-profile');
        Route::put('/lengkapi-profil/{id}', 'completeProfile')->name('complete-profile.update');
    });

    Route::controller(ExamController::class)->group(function () {
        Route::get('/exam/{id}', 'index')->name('exam');
        Route::get('/exam/{participantId}/sub-test/{subTestId}', 'getQuestion')->name('get-question');
        Route::post('/exam/submit', 'submitAnswer')->name('submit-answer');
        Route::get('/exam/finish/{participantId}', 'finishExam')->name('finish-exam');
        Route::get('/exam/result/{participantId}', 'getExamResult')->name('exam-result');
        Route::get('/exam/leaderboard/{tryOutId}', 'getLeaderboard')->name('leaderboard.get');
    });

    Route::middleware(['admin'])->group(function () {

        Route::controller(TestimoniController::class)->group(function () {
            Route::get('/testimoni-siswa', 'index')->name('testimonials');
            Route::get('/testimoni-siswa/get', 'getTestimonials')->name('testimonials.get');
            Route::post('/testimoni-siswa', 'store')->name('testimonials.store');
            Route::post('/testimoni-siswa/delete/{id}', 'destroy')->name('testimonials.destroy');
            Route::put('/testimoni-siswa/update/{id}', 'update')->name('testimonials.update');
            Route::post('testimoni/update-highlight', 'updateHighlight')->name('testimonials.update-highlight');
        });

        Route::controller(StudentAchievementController::class)->group(function () {
            Route::get('/prestasi-siswa', 'index')->name('student-achievements');
            Route::get('/prestasi-siswa/get', 'getStudentAchievements')->name('student-achievements.get');
            Route::post('/prestasi-siswa', 'store')->name('student-achievements.store');
            Route::post('/prestasi-siswa/delete/{id}', 'destroy')->name('student-achievements.destroy');
            Route::put('/prestasi-siswa/update/{id}', 'update')->name('student-achievements.update');
            Route::post('prestasi/update-highlight', 'updateHighlight')->name('student-achievements.update-highlight');
        });

        Route::controller(TutorController::class)->group(function () {
            Route::get('/tutor', 'index')->name('tutors');
            Route::get('/tutor/get', 'getTutors')->name('tutors.get');
            Route::post('/tutor', 'store')->name('tutors.store');
            Route::post('/tutor/delete/{id}', 'destroy')->name('tutors.destroy');
            Route::put('/tutor/update/{id}', 'update')->name('tutors.update');
            Route::post('tutor/update-highlight', 'updateHighlight')->name('tutors.update-highlight');
        });

        Route::controller(QnaController::class)->group(function () {
            Route::get('/faq', 'index')->name('faqs');
            Route::get('/faq/get', 'getFaqs')->name('faqs.get');
            Route::post('/faq', 'store')->name('faqs.store');
            Route::post('/faq/delete/{id}', 'destroy')->name('faqs.destroy');
            Route::put('/faq/update/{id}', 'update')->name('faqs.update');
        });

        Route::controller(ClusterController::class)->group(function () {
            Route::get('/rumpun', 'index')->name('clusters');
            Route::get('/rumpun/get', 'getClusters')->name('clusters.get');
            Route::post('/rumpun', 'store')->name('clusters.store');
            Route::post('/rumpun/delete/{id}', 'destroy')->name('clusters.destroy');
            Route::put('/rumpun/update/{id}', 'update')->name('clusters.update');
        });

        Route::controller(UniversityController::class)->group(function () {
            Route::get('/universitas', 'index')->name('universities');
            Route::get('/universitas/get', 'getUniversities')->name('universities.get');
            Route::post('/universitas', 'store')->name('universities.store');
            Route::post('/universitas/delete/{id}', 'destroy')->name('universities.destroy');
            Route::put('/universitas/update/{id}', 'update')->name('universities.update');
        });

        Route::controller(MajorController::class)->group(function () {
            Route::get('/program-studi', 'index')->name('majors');
            Route::get('/program-studi/get', 'getMajors')->name('majors.get');
            Route::post('/program-studi', 'store')->name('majors.store');
            Route::post('/program-studi/delete/{id}', 'destroy')->name('majors.destroy');
            Route::put('/program-studi/update/{id}', 'update')->name('majors.update');
        });

        Route::controller(UserManagementController::class)->group(function() {
            Route::get('/manajemen-user', 'index')->name('user-management');
            Route::get('/manajemen-user/get', 'getUsers')->name('user-management.get');
            Route::post('/manajemen-user/delete/{id}', 'destroy')->name('user-management.destroy');
            Route::get('/manajemen-user/detail/{id}', 'show')->name('user-management.show');
        });

        Route::controller(TryOutController::class)->group(function () {
            Route::get('/tryout', 'index')->name('tryouts');
            Route::get('/tryout/get', 'getTryouts')->name('tryouts.get');
            Route::post('/tryout', 'store')->name('tryouts.store');
            Route::post('/tryout/delete/{id}', 'destroy')->name('tryouts.destroy');
            Route::put('/tryout/update/{id}', 'update')->name('tryouts.update');
        });

        Route::controller(CategorySubtestController::class)->group(function () {
            Route::get('/kategori-subtest', 'index')->name('category-subtests');
            Route::get('/kategori-subtest/get', 'getCategorySubtests')->name('category-subtests.get');
            Route::post('/kategori-subtest', 'store')->name('category-subtests.store');
            Route::post('/kategori-subtest/delete/{id}', 'destroy')->name('category-subtests.destroy');
            Route::put('/kategori-subtest/update/{id}', 'update')->name('category-subtests.update');
        });

        Route::controller(SubTestController::class)->group(function () {
            Route::get('/subtest/{id}', 'index')->name('subtests');
            Route::get('/subtest/get/{tryOutId}', 'getSubTests')->name('subtests.get');
            Route::post('/subtest/{id}', 'store')->name('subtests.store');
            Route::post('/subtest/delete/{id}', 'destroy')->name('subtests.destroy');
            Route::put('/subtest/update/{id}', 'update')->name('subtests.update');
        });

        Route::controller(QuestionController::class)->group(function () {
            Route::get('/soal/{subTestId}', 'index')->name('questions');
            Route::get('soal/create/{subTestId}', 'create')->name('questions.create');
            Route::post('/soal/{subTestId}', 'store')->name('questions.store');
            Route::post('/soal/upload', 'upload')->name('ckeditor.upload');
            Route::post('/soal/delete/{id}', 'destroy')->name('questions.destroy');
            Route::get('/soal/edit/{id}', 'edit')->name('questions.edit');
            Route::put('/soal/update/{id}', 'update')->name('questions.update');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/produk', 'index')->name('products');
            Route::get('/produk/get', 'getProducts')->name('products.get');
            Route::post('/produk', 'store')->name('products.store');
            Route::post('/produk/delete/{id}', 'softDelete')->name('products.soft-delete');
            Route::put('/produk/update/{id}', 'update')->name('products.update');
            Route::post('/proses-nilai/{tryOutId}', 'generateScore')->name('products.generate-score');
        });

        Route::controller(ParticipantController::class)->group(function () {
            Route::get('/peserta/{productId}', 'index')->name('participants');
            Route::get('/peserta/get/{productId}', 'getParticipant')->name('participants.get');
        });

        
    });

    Route::middleware(['profile.completed'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');    
        
        Route::get('/tryout-saya',[MyTryOutController::class, 'index'])->name('my-tryout');
        
        Route::get('/pencapaian', function() {
            return view('web.sections.dashboard.student.achievement');
        })->name('achievement');
        
        // Route::get('/ubah-profil', function() {
        //     return view('web.sections.dashboard.edit-profile');
        // })->name('profile-edit');
        
        // Route::get('/ubah-jurusan', function() {
        //     return view('web.sections.dashboard.edit-major');
        // })->name('major-edit');
        
        Route::get('/pengerjaan-tryout', function() {
            return view('web.sections.exam.tryout-test');
        })->name('tryout-test');
    });
});
