<?php

use App\Http\Controllers\TryoutDetailController;
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
});

Route::get('/register', function () {
    return view('web.sections.auth.register');
});

Route::get('/register', function () {
    return view('web.sections.auth.register');
});

Route::get('/produk/try-out-utbk', function () {
    return view('web.sections.landing-page.tryout');
});

Route::get('/produk/try-out-utbk/detail', [TryoutDetailController::class, 'index'])->name('tryout-detail');

Route::get('/payment', function() {
    return view('web.sections.landing-page.payment');
})->name('payment'); 

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