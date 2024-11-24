<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerController;

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
        
        return view('dashboard::dashboard'); // Show user dashboard if not admin
    }
    
    return redirect('/login'); // Redirect to login if not authenticated
})->name('dashboard');

require __DIR__.'/auth.php';


Route::group([], function () {
    Route::resource('customer', CustomerController::class)->names('customer');
});
