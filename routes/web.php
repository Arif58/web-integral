<?php

use App\Http\Controllers\ClusterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\StudentAchievementController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TryoutDetailController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UniversityController;
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

Route::get('/login', function () {
    return view('web.sections.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('web.sections.auth.register');
})->name('register');

// Route::get('/logout', function () {
//     return view('web.sections.landing-page.home');
// })->name('logout');

Route::get('/try-out-utbk', function () {
    return view('web.sections.landing-page.tryout');
});

Route::get('/produk/try-out-utbk/detail', [TryoutDetailController::class, 'index'])->name('tryout-detail');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lengkapi-profil', function() {
        return view('web.sections.dashboard.complete-profile');
    })->name('complete-profile');

    Route::get('/payment', function() {
        return view('web.sections.landing-page.payment');
    })->name('payment'); 

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
    });

    Route::middleware(['profile.completed'])->group(function () {
        Route::get('/dashboard', function() {
            return view('web.sections.dashboard.dashboard');
        })->name('dashboard');    
        
        Route::get('/tryout-saya', function() {
            return view('web.sections.dashboard.my-tryout');
        })->name('my-tryout');
        
        Route::get('/pencapaian', function() {
            return view('web.sections.dashboard.achievement');
        })->name('achievement');
        
        Route::get('/profil', function() {
            return view('web.sections.dashboard.profile');
        })->name('profile');
        
        Route::get('/ubah-profil', function() {
            return view('web.sections.dashboard.edit-profile');
        })->name('profile-edit');
        
        Route::get('/ubah-jurusan', function() {
            return view('web.sections.dashboard.edit-major');
        })->name('major-edit');
        
        Route::get('/pengerjaan-tryout', function() {
            return view('web.sections.exam.tryout-test');
        })->name('tryout-test');
    });
});
