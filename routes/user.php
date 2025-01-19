<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\ProductController;

Route::prefix('user')->middleware('user')->group(function () {
    Route::get('home', [UserController::class, 'userHome'])->name('userHome');
    Route::get('editPage', [UserController::class, 'editPage'])->name('userEditPage');
    Route::post('edit', [UserController::class, 'edit'])->name('userEdit');
    Route::get('changePasswordPage', [UserController::class, 'changePasswordPage'])->name('userChangePasswordPage');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('userChangePassword');

    Route::prefix('product')->group((function () {
        Route::get('detail/{id}/{categoryId}',[ProductController::class,'productDetail'])->name('productDetail');
        Route::post('addToCart',[ProductController::class,'addToCart'])->name('productAddToCart');
        Route::get('cartList',[ProductController::class,'cartList'])->name('cartList');
    }));

    Route::get('cart/delete',[ProductController::class,'cartDelete'])->name('cartDelete');
});
