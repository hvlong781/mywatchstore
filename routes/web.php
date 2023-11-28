<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BrandAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\PaymentController;

Auth::routes();

Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
//        Route::get('/', [AdminController::class, 'index']);

        Route::get('dashboard', [AdminController::class, 'index']);

        #Profile
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileAdminController::class, 'index']);
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
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryAdminController::class, 'index']);
            Route::get('add-menu', [CategoryAdminController::class, 'create']);
            Route::post('add-menu', [CategoryAdminController::class, 'store']);
            Route::get('list-menu', [CategoryAdminController::class, 'index']);
            Route::get('edit/{category}', [CategoryAdminController::class, 'show']);
            Route::post('edit/{category}', [CategoryAdminController::class, 'update']);
            Route::DELETE('destroy', [CategoryAdminController::class, 'destroy']);
        });

        #Brand
        Route::prefix('brands')->group(function () {
            Route::get('/', [BrandAdminController::class, 'index']);
            Route::get('add-brand', [BrandAdminController::class, 'create']);
            Route::post('add-brand', [BrandAdminController::class, 'store']);
            Route::get('list-brand', [BrandAdminController::class, 'index']);
            Route::get('edit/{brand}', [BrandAdminController::class, 'show']);
            Route::post('edit/{brand}', [BrandAdminController::class, 'update']);
            Route::DELETE('destroy/{brand}', [BrandAdminController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductAdminController::class, 'index']);
            Route::get('add-product', [ProductAdminController::class, 'create']);
            Route::post('add-product', [ProductAdminController::class, 'store']);
            Route::get('list-product', [ProductAdminController::class, 'index']);
            Route::get('edit/{product}', [ProductAdminController::class, 'show']);
            Route::post('edit/{product}', [ProductAdminController::class, 'update']);
            Route::DELETE('destroy', [ProductAdminController::class, 'destroy']);
        });

        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('/', [SliderController::class, 'index']);
            Route::get('add-slider', [SliderController::class, 'create']);
            Route::post('add-slider', [SliderController::class, 'store']);
            Route::get('list-slider', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

        #Order
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderAdminController::class, 'index']);
            Route::get('list-order', [OrderAdminController::class, 'index']);
            Route::get('view-detail/{order}', [OrderAdminController::class, 'show']);
            Route::put('edit/{order}', [OrderAdminController::class, 'update']);
//            Route::DELETE('destroy', [OrderAdminController::class, 'destroy']);
        });

        #Supplier
        Route::prefix('suppliers')->group(function () {
            Route::get('/', [SupplierController::class, 'index']);
            Route::get('add-supplier', [SupplierController::class, 'create']);
            Route::post('add-supplier', [SupplierController::class, 'store']);
            Route::get('edit/{supplier}', [SupplierController::class, 'show']);
            Route::post('edit/{supplier}', [SupplierController::class, 'update']);
            Route::DELETE('destroy/{supplier}', [SupplierController::class, 'destroy']);
        });

        #PurchaseOrder
        Route::prefix('purchase')->group(function () {
            Route::get('/', [PurchaseOrderController::class, 'index']);
            Route::get('detail/{purchase}', [PurchaseOrderController::class, 'show']);
            Route::get('add-purchase', [PurchaseOrderController::class, 'create']);
            Route::post('add-purchase', [PurchaseOrderController::class, 'store']);
            Route::DELETE('destroy/{purchase}', [PurchaseOrderController::class, 'destroy']);
        });
    });
});


Route::get('/', [MainController::class, 'index'])->name('home');
//Route::get('/home', [MainController::class, 'index'])->name('home');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'show']);

Route::post('/services/load-product', [MainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html', [\App\Http\Controllers\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [\App\Http\Controllers\ProductController::class, 'index']);


#Customer
Route::middleware(['auth', 'customer'])->group(function () {
    Route::post('add-cart', [CartController::class, 'index']);
    Route::get('carts', [CartController::class, 'show']);
    Route::post('carts', [CartController::class, 'placeOrder']);
    Route::post('update-cart', [CartController::class, 'update']);
    Route::get('carts/delete/{id}', [CartController::class, 'remove']);

    #Order
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/view-detail/{order}', [OrderController::class, 'show']);
        Route::post('/view-detail/{order}/cancel', [OrderController::class, 'cancel']);
    });

    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile']);
    Route::post('/profile/update', [\App\Http\Controllers\UserController::class, 'update']);

    #VNpay
    Route::post('/vnpayment', [CartController::class, 'vnPayment']);
    Route::get('/vnpayment/callback', [CartController::class, 'returnUrl']);

    // Route::get('/payment', [PaymentController::class, 'createPayment']);
    // Route::get('/payment/callback', [PaymentController::class, 'paymentCallback']);
});
