<?php

use Illuminate\Support\Facades\Route;
use Modules\Ecommerce\Http\Controllers\EcommerceController;
use Modules\Ecommerce\Http\Controllers\OrderController;
use Modules\Ecommerce\Http\Controllers\ProductBrandController;
use Modules\Ecommerce\Http\Controllers\ProductController;
use Modules\Ecommerce\Http\Controllers\ProductSubCategoryController;
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

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {

        // Products Routes
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');  
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');  
            Route::post('/store', [ProductController::class, 'store'])->name('products.store');
            Route::put('{id}/update', [ProductController::class, 'update'])->name('products.update');  
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('products.edit');  
            Route::delete('{id}', [ProductController::class, 'destroy'])->name('products.destroy');  

            // Product Brand Routes
            Route::prefix('brand')->group(function () {
                Route::get('/', [ProductBrandController::class, 'index'])->name('brand.index');
                Route::get('/get-all-brands', [ProductBrandController::class, 'getAllBrands'])->name('brand.getAllBrands');
                Route::delete('{id}', [ProductBrandController::class, 'destroy'])->name('brand.destroy');
                Route::post('/brand/{id}/update-status', [ProductBrandController::class, 'updateStatus'])->name('brand.updateStatus');  
                
                // Route::get('/{id}', [ProductBrandController::class, 'show'])->name('brands.show');  
                Route::get('/create', [ProductBrandController::class, 'create'])->name('brand.create');  
                Route::post('/store', [ProductBrandController::class, 'store'])->name('brand.store');
                Route::put('{id}/update', [ProductBrandController::class, 'update'])->name('brand.update');  
                Route::get('{id}/edit', [ProductBrandController::class, 'edit'])->name('brand.edit'); Route::delete('{id}', [ProductBrandController::class, 'destroy'])->name('brand.destroy');  
            });

            // Product Subcategory Routes
            Route::prefix('subcategory')->group(function () {
                Route::get('/', [ProductSubCategoryController::class, 'index'])->name('subcategory.index');  
                Route::get('/create', [ProductSubCategoryController::class, 'create'])->name('subcategory.create');  
                Route::post('/store', [ProductSubCategoryController::class, 'store'])->name('subcategory.store');
                Route::put('{id}/update', [ProductSubCategoryController::class, 'update'])->name('subcategory.update');  
                Route::get('{id}/edit', [ProductSubCategoryController::class, 'edit'])->name('subcategory.edit');  
                Route::delete('{id}', [ProductSubCategoryController::class, 'destroy'])->name('subcategory.destroy');  
            });
        });

        // Orders Routes
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');  
            Route::get('/create', [OrderController::class, 'create'])->name('orders.create');  
            Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
            Route::put('{id}/update', [OrderController::class, 'update'])->name('orders.update');  
            Route::get('{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');  
            Route::delete('{id}', [OrderController::class, 'destroy'])->name('orders.destroy');  
        });

        // Transactions Routes
        Route::prefix('transactions')->group(function () {
            Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');  
            Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');  
            Route::post('/store', [TransactionController::class, 'store'])->name('transactions.store');
            Route::put('{id}/update', [TransactionController::class, 'update'])->name('transactions.update');  
            Route::get('{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');  
            Route::delete('{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');  
        });

    });

});