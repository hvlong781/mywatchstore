<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('main');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);

//        #Menu
//        Route::prefix('menus')->group(function () {
//            Route::get('/', [MenuController::class, 'index']);
//            Route::get('add', [MenuController::class, 'create']);
//            Route::post('add', [MenuController::class, 'store']);
//            Route::get('list', [MenuController::class, 'index']);
//            Route::get('edit/{menu}', [MenuController::class, 'show']);
//            Route::post('edit/{menu}', [MenuController::class, 'update']);
//            Route::DELETE('destroy', [MenuController::class, 'destroy']);
//        });
//
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
//        Route::prefix('sliders')->group(function () {
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
