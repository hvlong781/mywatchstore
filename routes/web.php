<?php

use App\Http\Controllers\Admin\ProfileAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryAdminController;

Route::get('/', function () {
    return view('main');
});

Auth::routes();

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
//        Route::get('/', [AdminController::class, 'index']);

        Route::get('dashboard', [AdminController::class, 'index']);

        #Profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileAdminController::class, 'index']);
            Route::get('edit', [ProfileAdminController::class, 'show']);
            Route::post('update', [ProfileAdminController::class, 'update']);
        });

        #User
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('list-user', [UserController::class, 'index']);
            Route::get('add-user', [UserController::class, 'create']);
            Route::post('add-user', [UserController::class, 'store']);
            Route::get('edit/{user}', [UserController::class, 'edit']);
            Route::post('edit/{user}', [UserController::class, 'update']);
            Route::get('delete/{user}', [UserController::class, 'confirmDelete']);
            Route::delete('destroy/{user}', [UserController::class, 'destroy']);
        });

        #Category
        Route::prefix('menus')->group(function () {
            Route::get('/', [CategoryAdminController::class, 'index']);
            Route::get('add-menu', [CategoryAdminController::class, 'create']);
            Route::post('add-menu', [CategoryAdminController::class, 'store']);
            Route::get('list-menu', [CategoryAdminController::class, 'index']);
            Route::get('edit/{category}', [CategoryAdminController::class, 'show']);
            Route::post('edit/{category}', [CategoryAdminController::class, 'update']);
            Route::DELETE('destroy', [CategoryAdminController::class, 'destroy']);
        });

//        #Product
//        Route::prefix('products')->group(function () {
//            Route::get('/', [ProductController::class, 'index']);
//            Route::get('add', [ProductController::class, 'create']);
//            Route::post('add', [ProductController::class, 'store']);
//            Route::get('list', [ProductController::class, 'index']);
//            Route::get('edit/{product}', [ProductController::class, 'show']);
//            Route::post('edit/{product}', [ProductController::class, 'update']);
//            Route::DELETE('destroy', [ProductController::class, 'destroy']);
//        });
//
//        #Slider
//        Route::prefix('sliders-admin')->group(function () {
//            Route::get('/', [SliderController::class, 'index']);
//            Route::get('add', [SliderController::class, 'create']);
//            Route::post('add', [SliderController::class, 'store']);
//            Route::get('list', [SliderController::class, 'index']);
//            Route::get('edit/{slider}', [SliderController::class, 'show']);
//            Route::post('edit/{slider}', [SliderController::class, 'update']);
//            Route::DELETE('destroy', [SliderController::class, 'destroy']);
//        });
//
//        #Upload
//        Route::post('upload/services', [UploadController::class, 'store']);
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
