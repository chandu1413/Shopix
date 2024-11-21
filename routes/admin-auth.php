<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAdmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Artisan;


// Admin routes
Route::get('/admin/dashboard', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        return view('admin.dashboard'); // Show admin dashboard
    } else {
        return redirect('/dashboard'); // Redirect to user dashboard if not admin
    }
})->middleware(['auth', 'verified'])->name('admin.dashboard');
