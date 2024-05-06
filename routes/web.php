<?php

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

Route::get('/', [\App\Http\Controllers\MainController::class, 'show'])->name('main');
Route::get('/about', function () {return view('about');})->name('about');
Route::get('/booking', [\App\Http\Controllers\BookTableController::class, 'index'])->name('booking');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/delivery', function () {return view('delivery');})->name('delivery');
Route::get('/quizzes', [\App\Http\Controllers\QuizController::class, 'index'])->name('quizzes');

Route::get('/menu', [\App\Http\Controllers\MainController::class, 'rightMenu'])->name('r-menu');
Route::post('/auth', [\App\Http\Controllers\LoginController::class, 'login'])->name('auth');
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('/register', [\App\Http\Controllers\RegistrationController::class, 'create'])->name('register');

Route::get('/account', function () { return redirect('/account/data');})->middleware('auth')->name('account');
Route::get('/account/data', [\App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('account.data');
Route::post('/account/data/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('account.data.edit');
Route::post('/account/data/editPass', [\App\Http\Controllers\UserController::class, 'editPassword'])->middleware('auth')->name('account.data.password');

Route::get('/account/orders', function () { return view('account.orders');})->middleware('auth')->name('account.orders');

Route::get('/account/reserve', [\App\Http\Controllers\BookTableController::class, 'showUserTables'])->middleware('auth')->name('account.reserve');
Route::post('/account/reserve', [\App\Http\Controllers\BookTableController::class, 'cancelReserve'])->middleware('auth')->name('account.reserve');

Route::get('/account/coupons', function () { return view('account.coupons');})->middleware('auth')->name('account.coupons');


Route::post('/booking/', [\App\Http\Controllers\BookTableController::class, 'reserveTable'])->name('booking.reserve');
Route::post('/booking/update', [\App\Http\Controllers\BookTableController::class, 'updateTables'])->name('booking.update');


Route::get('/quizzes/{id}', [\App\Http\Controllers\QuizController::class, 'detail'])->whereNumber('id')->name('quizzes.detail');
Route::get('/quizzes/{id}/update', [\App\Http\Controllers\QuizController::class, 'updateQuestion'])->whereNumber('id')->name('quizzes.update');
Route::get('/quizzes/{id}/end', [\App\Http\Controllers\QuizController::class, 'end'])->name('quizzes.end');
//Route::get('/proba', [\App\Http\Controllers\QuizController::class, 'proba']);

//Route::get('/admin-panel', function () { return view('admin');})->middleware('admin')->name('admin');
