<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAdmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
// Route::middleware(['auth', 'verified', 'redirectIfAdmin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });

// User routes
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Single Dashboard Route
// Route::get('/dashboard', function () {
//     if (Auth::check()) {
//         if (Auth::user()->is_admin) {
//             return view('admin.dashboard'); // Show admin dashboard directly
//         }
//         return view('dashboard'); // Show user dashboard
//     }
    
//     return redirect('/login'); // Redirect to login if not authenticated
// })->name('dashboard');




Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::prefix('permission')->group(function(){
    //     // Route::resource('/', PermissionsController::class)->names('permission');
    //     Route::get('/', [PermissionsController::class, 'index'])->name('permission.index'); // List all roles
    //     Route::get('/create', [PermissionsController::class, 'create'])->name('permission.create'); // Show create form
    //     Route::post('store', [PermissionsController::class, 'store'])->name('permission.store'); 
    //     Route::post('{id}/update', [PermissionsController::class, 'update'])->name('permission.update');// Store new role
    //     Route::get('{id}/edit', [PermissionsController::class, 'edit'])->name('permission.edit'); // Show edit form
    //     Route::delete('{id}/destroy', [PermissionsController::class, 'destroy'])->name('permission.destroy'); // Delete role
    // });

    

    // Route::prefix('roles')->group(function(){
    //     // Route::resource('/', PermissionsController::class)->names('permission');
    //     Route::get('/', [RolesController::class, 'index'])->name('roles.index'); // List all roles
    //     Route::get('/create', [RolesController::class, 'create'])->name('roles.create'); // Show create form
    //     Route::post('store', [RolesController::class, 'store'])->name('roles.store'); 
    //     Route::post('{id}/update', [RolesController::class, 'update'])->name('roles.update');// Store new role
    //     Route::get('{id}/edit', [RolesController::class, 'edit'])->name('roles.edit'); // Show edit form
    //     Route::delete('{id}/destroy', [RolesController::class, 'destroy'])->name('roles.destroy'); // Delete role
    // });


    // Route::prefix('users')->group(function(){
    //     // Route::resource('/', PermissionsController::class)->names('users');
    //     Route::get('/', [UserController::class, 'index'])->name('users.index'); // List all roles
    //     Route::get('/create', [UserController::class, 'create'])->name('users.create'); // Show create form
    //     Route::post('store', [UserController::class, 'store'])->name('users.store'); 
    //     Route::post('{id}/update', [UserController::class, 'update'])->name('users.update');// Store new role
    //     Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show edit form
    //     Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy'); // Delete role
    // });

});

// require __DIR__.'/auth.php';
 
Route::get('/clear-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return "Cache cleared successfully!";
}); //->middleware('auth');
