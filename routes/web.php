<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserController as escape;


Route::middleware(['admin_auth'])->group(function () {
    //login register
      Route::redirect('/', 'loginPage');
      Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
      Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function () {
         //category
        Route::prefix('category')->group(function () {
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
         });

         //admin Account
         Route::prefix('admin')->group(function () {
            //password
             Route::get('password/changePage',[ AdminController::class,'changePasswordPage'])->name('admin#ChangePasswordPage');
             Route::post('changePassword',[ AdminController::class,'changePassword'])->name('admin#changePassword');

             //profile
             Route::get('detail',[AdminController::class,'detail'])->name('admin#detail');
             Route::get('editPage',[AdminController::class,'editPage'])->name('admin#editPage');
             Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

             //‌admin list
             Route::get('list',[AdminController::class,'list'])->name('admin#list');
             Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
             Route::get('ajax/role/change/status',[AdminController::class,'ajaxRoleChangeStatus'])->name('admin#ajaxRoleChangeStatus');
         });


         //product
        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        //order
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'list'])->name('order#list');
            Route::post('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

         //user list
         Route::prefix('user')->group(function () {
              Route::get('list',[UserController::class,'userList'])->name('user#list');
         });

        //   contact list
         Route::prefix('contact')->group(function () {
              Route::get('list',[ContactController::class,'contactList'])->name('admin#contactList');
              Route::get('deleteMessage/{id}',[ContactController::class,'deleteMessage'])->name('admin#deleteMessage');
         });
    });

    //user
    //home
    Route::prefix('user')->middleware(['user_auth'])->group(function () {

        Route::get('home',[Escape::class,'home'])->name('user#home');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('/history',[UserController::class,'history'])->name('user#history');


        Route::prefix('pizza')->group(function () {
            Route::get('pizzaDetails/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });

         Route::prefix('cart')->group(function () {
            Route::get('List',[UserController::class,'cartList'])->name('user#cartList');
        });

        Route::prefix('password')->group(function () {
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });


        Route::prefix('account')->group(function () {
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });


        Route::prefix('ajax')->group(function () {
             Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
             Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
             Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
             Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
             Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
             Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
         });

         Route::prefix('contact')->group(function () {
            Route::get('page',[ContactController::class,'contactPageList'])->name('user#contactPageList');
            Route::post('sent',[ContactController::class,'contactSent'])->name('user#contactSent');
         });

    });
});
