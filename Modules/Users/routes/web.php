<?php

use Modules\Users\Http\Controllers\ProfileController;
use Modules\Users\Http\Controllers\PermissionsController;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Middleware\RedirectIfAdmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Artisan;
use Modules\Users\Http\Controllers\AttendanceController;
use Modules\Users\Models\Attendance;

Route::get('/', function () {
    return view('welcome');
});


// Route::group([], function () {
//     Route::resource('users', UsersController::class)->names('users');
// });
 


// Admin routes
Route::get('/admin/dashboard', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        // dd(Auth::user()->is_admin);
        // die;
        return view('dashboard::admin.dashboard'); // Show admin dashboard
    } else {
        // dd(Auth::user()->is_admin);
        // die;
        return redirect('/dashboard'); // Redirect to user dashboard if not admin
    }
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// User dashboard route with conditional logic
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard if user is admin
        }
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->whereNull('check_out')->latest()->first();
        return view('dashboard::dashboard',['attendance'=>$attendance]); // Show user dashboard if not admin
    }
    
    return redirect('/login'); // Redirect to login if not authenticated
})->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('attendance')->group(function(){
        Route::get('ajax/check-in',[AttendanceController::class,'ajaxCheckIn'])->name('attendance.ajaxCheckIn');
        Route::get('ajax/check-out',[AttendanceController::class,'ajaxCheckOut'])->name('attendance.ajaxCheckOut');
    });

    Route::prefix('users')->group(function(){
        // Route::resource('/', PermissionsController::class)->names('users');
        Route::get('/', [UserController::class, 'index'])->name('users.index'); // List all roles
        Route::get('/create', [UserController::class, 'create'])->name('users.create'); // Show create form
        Route::post('store', [UserController::class, 'store'])->name('users.store'); 
        Route::post('{id}/update', [UserController::class, 'update'])->name('users.update');// Store new role
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show edit form
        // Route::get('ajax/edit', [UserController::class, 'ajaxEdit'])->name('users.ajaxEdit');
        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy'); // Delete role

        Route::post('/users/ajaxStore', [UserController::class, 'ajaxStore'])->name('users.ajaxStore');
        Route::get('ajax/destroy', [UserController::class, 'ajaxdestroy'])->name('users.ajaxdestroy');
    
        //ajax storing users using interface and service features 

        Route::post('/register', [UserController::class, 'register'])->name('users.ajaxRegister');
    
    });

});