<?php

use App\Http\Controllers\StudentAchievementController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TryoutDetailController;
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

Route::get('/', function () {
    return view('web.sections.landing-page.home');
});

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


Route::get('/payment', function() {
    return view('web.sections.landing-page.payment');
})->name('payment'); 


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lengkapi-profil', function() {
        return view('web.sections.dashboard.complete-profile');
    })->name('complete-profile');

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
