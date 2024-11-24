<?php

use Illuminate\Support\Facades\Route;
use Modules\Ecommerce\Http\Controllers\EcommerceController;
use Modules\Ecommerce\Http\Controllers\OrderController;
use Modules\Ecommerce\Http\Controllers\ProductController;
use Modules\Ecommerce\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group([], function () {
//     Route::resource('ecommerce', EcommerceController::class)->names('ecommerce');
// });


Route::middleware('auth')->group(function () {

    Route::prefix('admin/dashboard')->group(function () {

        // products routes
        Route::prefix('products')->group(function () {
            // Route::resource('/', PermissionsController::class)->names('products');
            Route::get('/', [ProductController::class, 'index'])->name('products.index');  
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');  
            Route::post('/store', [ProductController::class, 'store'])->name('products.store');
            Route::put('{id}/update', [ProductController::class, 'update'])->name('products.update');  // Changed to PUT
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('products.edit');  
            Route::delete('{id}', [ProductController::class, 'destroy'])->name('products.destroy');  // Removed '/destroy'
        });

        // Orders Routes
        Route::prefix('orders')->group(function () {
            // Route::resource('/', PermissionsController::class)->names('orders');
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');  
            Route::get('/create', [OrderController::class, 'create'])->name('orders.create');  
            Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
            Route::put('{id}/update', [OrderController::class, 'update'])->name('orders.update');  // Changed to PUT
            Route::get('{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');  
            Route::delete('{id}', [OrderController::class, 'destroy'])->name('orders.destroy');  // Removed '/destroy'
        });

        // Transactions Routes
        Route::prefix('transactions')->group(function () {
            // Route::resource('/', PermissionsController::class)->names('orders');
            Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');  
            Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');  
            Route::post('/store', [TransactionController::class, 'store'])->name('transactions.store');
            Route::put('{id}/update', [TransactionController::class, 'update'])->name('transactions.update');  // Changed to PUT
            Route::get('{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');  
            Route::delete('{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');  // Removed '/destroy'
        });

    });

});
