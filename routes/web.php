<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookTableController;
use App\Http\Controllers\CatalogController;
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

Route::get('about', function () {
    return view('about');
})->name('about');
Route::get('contact', function () {
    return view('contact');
})->name('contact');
Route::get('delivery', function () {
    return view('delivery');
})->name('delivery');


Route::controller(MainController::class)->group(function () {
    Route::get('/', 'show')->name('main');
    Route::get('menu', 'rightMenu')->name('r-menu');
});

Route::controller(AdminController::class)->middleware('admin')->group(function () {
    Route::get('admin-panel', function () {
        return redirect('admin-panel/users');
    })->name('admin');
    Route::get('admin-panel/users/{action?}/{id?}', 'showUsers')->name('admin.users');
    Route::post('admin-panel/users/addData/{id?}', 'addUser')->name('admin.users.addData');


    Route::get('admin-panel/products/{action?}/{id?}', 'showProducts')->name('admin.products');
    Route::post('admin-panel/products/addData/{id?}', 'addProduct')->name('admin.products.addData');

    Route::get('admin-panel/orders', 'showOrders')->name('admin.orders');
    Route::post('admin-panel/orders/update', 'updateOrder')->name('admin.orders.update');


    Route::get('admin-panel/reserve', 'showReserve')->name('admin.reserve');
    Route::post('admin-panel/reserve/update', 'updateReserve')->name('admin.reserve.update');


    Route::get('admin-panel/coupons/{action?}/{id?}', 'showCoupons')->name('admin.coupons');
    Route::post('admin-panel/coupons/addData/{id?}', 'addCoupon')->name('admin.coupons.addData');


    Route::get('admin-panel/quizzes/{action?}/{id?}', 'showQuizzes')->name('admin.quizzes');
    Route::post('admin-panel/quizzes/addData/{id?}', 'addQuiz')->name('admin.quizzes.addData');
    Route::post('admin-panel/quizzes/{id}/questions/add', 'addQuestion')->name('admin.quizzes.addDataQuestions');
    Route::post('admin-panel/del/{table}', 'delete')->name('admin.del');
});

Route::controller(BookTableController::class)->middleware('not.admin')->group(function () {
    Route::get('booking/{action?}/{id?}', 'index')->name('booking');
    Route::post('account/reserve', 'cancelReserve')->middleware('auth')->name('account.reserve');
    Route::post('booking', 'reserveTable')->name('booking.reserve');
    Route::post('booking/update', 'updateTables')->name('booking.update');
});

Route::controller(UserController::class)->group(function () {
    Route::post('register', 'create')->name('register');
    Route::post('auth', 'login')->name('auth');
    Route::get('logout', 'logout')->name('logout');

    Route::middleware(['auth', 'not.admin'])->group(function () {
        Route::get('account', function () {
            return redirect('/account/data');
        })->middleware('auth')->name('account');
        Route::get('account/data', 'index')->name('account.data');
        Route::post('account/data/edit', 'edit')->name('account.data.edit');
        Route::post('account/data/editPass', 'editPassword')->name('account.data.password');

        Route::get('account/orders', 'showUserOrders')->name('account.orders');

        Route::get('account/reserve', 'showUserTables')->name('account.reserve');
        Route::get('account/coupons', 'showUserCoupons')->name('account.coupons');
    });

});

Route::controller(QuizController::class)->middleware('not.admin')->group(function () {
    Route::get('quizzes', 'index')->name('quizzes');
    Route::get('quizzes/{id}', 'detail')->whereNumber('id')->name('quizzes.detail');
    Route::get('quizzes/{id}/update', 'updateQuestion')->whereNumber('id')->name('quizzes.update');
    Route::get('quizzes/{id}/end', 'end')->whereNumber('id')->name('quizzes.end');
});

Route::controller(CatalogController::class)->middleware('not.admin')->group(function () {
    Route::get('catalog/{category}', 'index')->name('catalog');
    Route::get('catalog/{category}/{id}', 'detail')->name('catalog.detail');
    Route::post('catalog/add', 'addToBasket')->name('catalog.addToBasket');
    Route::post('catalog/del', 'deleteFromBasket')->name('catalog.deleteFromBasket');
    Route::post('catalog/clear', 'clearBasket')->name('catalog.clearBasket');
    Route::post('catalog/repeat', 'repeatOrder')->name('catalog.repeat');

    Route::get('basket', 'order')->name('order');
    Route::post('basket/coupon', 'addCoupon')->name('order.coupon');
    Route::post('basket/order', 'addOrder')->name('order.add');
});


Route::view('404', 'errors.404')->name('login');

//Route::get('/proba', [\App\Http\Controllers\QuizController::class, 'proba']);

