<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;


// Login\Register
Route::redirect('/', 'dashboard');
Route::get('/sign-in',[AuthController::class, 'login',])->name('auth#loginPage')->middleware('guest');
Route::get('/sign-up',[AuthController::class, 'register',])->name('auth#registerPage')->middleware('guest');

// auth jetstream
Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); // check user or admin



    // {{-- ADMIN --}}
    Route::middleware(['admin_auth'])->group( function() {
        // Category Group
         Route::prefix('categories')->group(function() {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create', [CategoryController::class, 'create'])->name('category#create');
            Route::post('store', [CategoryController::class, 'store'])->name('category#store');// create category route {{ ==POST METHOD== }}
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // Account Group
        Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin#profile');
        Route::prefix('admin/profile')->group(function() {
            Route::get('password-change',[AdminController::class, 'changePassword'])->name('admin#changePassword');
            Route::post('password-update',[AdminController::class, 'updatePassword'])->name('admin#updatePassword');
            Route::get('edit',[AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update',[AdminController::class, 'update'])->name('admin#update');
        });
        Route::get('admin/lists', [AdminController::class, 'list'])->name('admin#lists');
        Route::post('admin/delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
        Route::post('admin/role/change/{id}', [AdminController::class, 'roleChange'])->name('admin#roleChange');
        Route::get('admin/contacts', [AdminController::class, 'contact'])->name('admin#contact');

        // Pizza Group
        Route::prefix('products')->group(function() {
            Route::get("list", [ProductController::class, 'list'])->name('products#list');
            Route::get("create", [ProductController::class, 'create'])->name('products#create');
            Route::post("create", [ProductController::class, 'store'])->name('products#store');
            Route::get("delete/{id}", [ProductController::class, 'delete'])->name('products#delete');
            Route::get("edit/{id}", [ProductController::class, 'edit'])->name('products#edit');
            Route::post("update/{id}", [ProductController::class, 'update'])->name('products#update');
        });
        Route::get('products/{id}', [ProductController::class, 'show'])->name('products#show');

        // Order Group
        Route::prefix('order')->group(function() {
            Route::get('list', [OrderController::class, 'list'])->name('orders#list');
            Route::get('list/{orderCode}', [OrderController::class, 'orderIdList'])->name('orders#orderIdList');
        });

        // ajax
        Route::prefix('ajax')->group(function() {
            Route::get('status/sort/{status}', [AjaxController::class, 'statusSort'])->name('ajax#statusSort');
            Route::put('orders/{order}/status/{status}', [AjaxController::class, 'updateOrderStatus'])->name('ajax.orders.updateStatus');
            Route::get('accounts/{sort}', [AjaxController::class, 'sortList'])->name('admin#sortLists');
        });
    });


    //{{-- USER --}}
    Route::group(['prefix'=>'user','middleware' => 'user_auth'], function () {
        Route::get('home', [UserController::class, 'home'])->name('user#home');
        Route::get('cart',[UserController::class, 'cart'])->name('user#cart');
        Route::get('history',[UserController::class, 'history'])->name('user#history');
        Route::get('contact',[UserController::class, 'contact'])->name('user#contact');

        Route::prefix('products')->group(function() {
            Route::get('/{id}', [UserController::class, 'detail'])->name('product#detail');
        });

        Route::get('/profile', [UserController::class, 'profile'])->name('user#profile');
        Route::prefix('profile')->group(function() {
            Route::get('password-change', [UserController::class, 'changePassword'])->name('user#changePassword');
            Route::post('password-update', [UserController::class, 'updatePassword'])->name('user#updatePassword');
            Route::get('edit',[UserController::class, 'edit'])->name('user#edit');
            Route::post('update',[UserController::class, 'update'])->name('user#update');
        });

        // ajax
        Route::prefix('ajax')->group(function() {
            // Route::get('pizza/lists', [AjaxController::class, 'list'])->name('ajax#list');
            Route::get('filter/{id}', [AjaxController::class, 'filter'])->name('ajax#filter');
            Route::post('cart', [AjaxController::class, 'cart'])->name('ajax#cart');
            Route::post('cart/clear', [AjaxController::class, 'cartClear'])->name('ajax#cartClear');
            Route::post('cart/{id}/delete', [AjaxController::class, 'cartProductClear'])->name('ajax#cartProductDelete');
            Route::post('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::put('viewcount', [AjaxController::class, 'viewcount'])->name('ajax#viewcount');
            Route::post('contact', [AjaxController::class, 'contact'])->name("ajax#contact");
        });
    });

});


// User

Route::get('web/test', function() {
    $data = Product::get();
    return response()->json($data, 200);
});
