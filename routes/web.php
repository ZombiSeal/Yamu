<?php

use App\Http\Controllers\BookTableController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
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
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'show')->name('main');
    Route::get('/menu', 'rightMenu')->name('r-menu');
});

Route::controller(LoginController::class)->group(function () {

});

Route::controller(BookTableController::class)->group(function () {
    Route::get('/booking',  'index')->name('booking');
    Route::get('/account/reserve', 'showUserTables')->middleware('auth')->name('account.reserve');
    Route::post('/account/reserve', 'cancelReserve')->middleware('auth')->name('account.reserve');
    Route::post('/booking/', 'reserveTable')->name('booking.reserve');
    Route::post('/booking/update', 'updateTables')->name('booking.update');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/register',  'create')->name('register');
    Route::post('/auth', 'login')->name('auth');
    Route::get('/logout', 'logout')->name('logout');

    Route::get('/account/data', 'index')->middleware('auth')->name('account.data');
    Route::post('/account/data/edit', 'edit')->middleware('auth')->name('account.data.edit');
    Route::post('/account/data/editPass', 'editPassword')->middleware('auth')->name('account.data.password');
});

Route::controller(QuizController::class)->group(function () {
    Route::get('/quizzes', 'index')->name('quizzes');
    Route::get('/quizzes/{id}', 'detail')->whereNumber('id')->name('quizzes.detail');
    Route::get('/quizzes/{id}/update', 'updateQuestion')->whereNumber('id')->name('quizzes.update');
    Route::get('/quizzes/{id}/end', 'end')->whereNumber('id')->name('quizzes.end');
});

Route::get('/about', function () {return view('about');})->name('about');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/delivery', function () {return view('delivery');})->name('delivery');




Route::get('/account', function () { return redirect('/account/data');})->middleware('auth')->name('account');
Route::get('/account/orders', function () { return view('account.orders');})->middleware('auth')->name('account.orders');
Route::get('/account/coupons', function () { return view('account.coupons');})->middleware('auth')->name('account.coupons');

Route::get('/basket', function () { return view('basket.order');})->name('order');

Route::view('/404', 'errors.404')->name('login');

//Route::get('/proba', [\App\Http\Controllers\QuizController::class, 'proba']);

//Route::get('/admin-panel', function () { return view('admin');})->middleware('admin')->name('admin');
