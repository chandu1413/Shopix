<?php

use Illuminate\Support\Facades\Route;
use Modules\RolePermission\Http\Controllers\RolePermissionController;
use Modules\RolePermission\Http\Controllers\PermissionsController;
 
use Modules\RolePermission\Http\Controllers\RolesController;

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
//     Route::resource('rolepermission', RolePermissionController::class)->names('rolepermission');
// });


Route::middleware('auth')->group(function () {
   
    Route::prefix('permission')->group(function(){
        // Route::resource('/', PermissionsController::class)->names('permission');
        Route::get('/', [PermissionsController::class, 'index'])->name('permission.index'); // List all roles
        Route::get('/create', [PermissionsController::class, 'create'])->name('permission.create'); // Show create form
        Route::post('store', [PermissionsController::class, 'store'])->name('permission.store'); 
        Route::post('{id}/update', [PermissionsController::class, 'update'])->name('permission.update');// Store new role
        Route::get('{id}/edit', [PermissionsController::class, 'edit'])->name('permission.edit'); // Show edit form
        Route::delete('{id}/destroy', [PermissionsController::class, 'destroy'])->name('permission.destroy'); // Delete role
    });

    

    Route::prefix('roles')->group(function(){
        // Route::resource('/', PermissionsController::class)->names('permission');
        Route::get('/', [RolesController::class, 'index'])->name('roles.index'); // List all roles
        Route::get('/create', [RolesController::class, 'create'])->name('roles.create'); // Show create form
        Route::post('store', [RolesController::class, 'store'])->name('roles.store'); 
        Route::post('{id}/update', [RolesController::class, 'update'])->name('roles.update');// Store new role
        Route::get('{id}/edit', [RolesController::class, 'edit'])->name('roles.edit'); // Show edit form
        Route::delete('{id}/destroy', [RolesController::class, 'destroy'])->name('roles.destroy'); // Delete role
    });

 

});