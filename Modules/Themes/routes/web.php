<?php

use Illuminate\Support\Facades\Route;
use Modules\Themes\Http\Controllers\ThemesController;

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

Route::group([], function () {
    Route::resource('themes', ThemesController::class)->names('themes');
});

Route::get('/', function () {
    return view('themes::default.layout');
});
