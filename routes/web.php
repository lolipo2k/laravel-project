<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('faq', [\App\Http\Controllers\PagesController::class, 'faq'])->name('faq');
Route::get('about', [\App\Http\Controllers\PagesController::class, 'about'])->name('about');
Route::get('privacy', [\App\Http\Controllers\PagesController::class, 'privacy'])->name('privacy');
Route::get('review', [\App\Http\Controllers\PagesController::class, 'review'])->name('review');
Route::get('price', [\App\Http\Controllers\PagesController::class, 'price'])->name('price');
Route::get('additional/{additional}', [\App\Http\Controllers\PagesController::class, 'additionals'])->name('additionals');
Route::get('vacancy', [\App\Http\Controllers\VacanciesController::class, 'vacancy'])->name('vacancy');
Route::post('vacancy', [\App\Http\Controllers\VacanciesController::class, 'registerNewVacancy'])->name('vacancy');
Route::get('vacancy/success', [\App\Http\Controllers\VacanciesController::class, 'vacancySuccess'])->name('vacancy.success');
Route::match(['GET', 'POST'], 'office', [\App\Http\Controllers\OfficeController::class, 'office'])->name('office');

Route::group([ 'prefix' => 'payments', 'as' => 'payments.' ], function() {
    Route::get('success', [\App\Http\Controllers\PaymentsController::class, 'success'])->name('success');
    Route::get('error', [\App\Http\Controllers\PaymentsController::class, 'error'])->name('error');
    Route::any('notification', [\App\Http\Controllers\PaymentsController::class, 'notification'])->name('notification');
});

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::group([ 'prefix' => '{service}' ], function () {
        Route::get('choice', [\App\Http\Controllers\OrderController::class, 'showFormChoice'])->name('choice');
        Route::post('choice', [\App\Http\Controllers\OrderController::class, 'choice'])->name('choice');
        Route::match(['GET', 'POST'], 'completion/{order}', [\App\Http\Controllers\OrderController::class, 'completion'])->name('completion');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::group([ 'prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
    });

    Route::group(['prefix' => 'addresses', 'as' => 'addresses.'], function () {
        Route::get('/', [\App\Http\Controllers\AddressesController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'],'create', [\App\Http\Controllers\AddressesController::class, 'create'])->name('create');
        Route::match(['GET', 'POST'],'{address}/edit', [\App\Http\Controllers\AddressesController::class, 'edit'])->name('edit');
    });

    // admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');
        Route::get('orders', [\App\Http\Controllers\Admin\HomeController::class, 'orders'])->name('orders');
        Route::get('orders/{order}', [\App\Http\Controllers\Admin\HomeController::class, 'orderShow'])->name('orders.show');
        Route::get('office', [\App\Http\Controllers\Admin\HomeController::class, 'office'])->name('office');
        Route::get('vacancies', [\App\Http\Controllers\Admin\HomeController::class, 'vacancies'])->name('vacancies');
        Route::get('service/positions/update', [\App\Http\Controllers\Admin\ServiceController::class, 'updatePos']);

        Route::resources([
            'faq' => \App\Http\Controllers\Admin\FaqController::class,
            'category' => \App\Http\Controllers\Admin\CategoryController::class,
            'service' => \App\Http\Controllers\Admin\ServiceController::class,
            'additional' => \App\Http\Controllers\Admin\AdditionalController::class,
            'pattern' => \App\Http\Controllers\Admin\PatternController::class,
            'sub' => \App\Http\Controllers\Admin\SubController::class,
            'furniture' => \App\Http\Controllers\Admin\FurnitureController::class,
            'promocode' => \App\Http\Controllers\Admin\PromocodeController::class,
            'users' => \App\Http\Controllers\Admin\UsersController::class,
        ]);
    });
});
