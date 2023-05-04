<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('deshboard', [AuthController::class, 'deshboard'])->name('deshboard');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {
        // Item
        Route::get('item/list', [ItemController::class, 'itemList'])->name('admin#itemList');
        Route::get('item/datatable', [ItemController::class, 'itemDatatable']);

        Route::get('create/item', [ItemController::class, 'itemCreate'])->name('admin#itemCreate');
        Route::post('store/item', [ItemController::class, 'itemStore'])->name('admin#itemStore');
        Route::get('edit/item/{id}', [ItemController::class, 'itemEdit'])->name('admin#itemEdit');
        Route::post('update/item/{id}', [ItemController::class, 'itemUpdate'])->name('admin#itemUpdate');
        Route::get('item/delete/{id}', [ItemController::class, 'itemDetele']);

        // Category
        Route::get('category/list', [CategoryController::class, 'categoryList'])->name('admin#categoryList');
        Route::get('category/datatable', [CategoryController::class, 'categoryDatatable']);
        Route::get('category/create', [CategoryController::class, 'categoryCreate'])->name('admin#categoryCreate');
        Route::post('category/store', [CategoryController::class, 'categoryStore'])->name('admin#categoryStore');
        Route::get('category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin#categoryEdit');
        Route::post('category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('admin#categoryUpdate');
        Route::get('category/delete/{id}', [CategoryController::class, 'categortDetele']);

    });
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('homePage', [UserController::class, 'homePage'])->name('user#homePage');
        Route::get('item/details/{id}', [UserController::class, 'itemDetails'])->name('user#itemDetails');
    });

});