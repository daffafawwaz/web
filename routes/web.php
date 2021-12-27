<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginSignupusersController;

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

//users
    Route::get('/LoginUsers',[LoginSignupusersController::class, 'loginusers']);
    Route::get('/authloginusers',[LoginSignupusersController::class, 'login']);
    Route::get('/SignupUsers',[LoginSignupusersController::class, 'signupusers']);
    Route::get('/authsignupusers',[LoginSignupusersController::class, 'signup']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', function () {
    return view('users');
});

Route::get('studio', function () {
    return view('studio');
});

Route::get('statis', function () {
    return view('statis');
});

Route::get('movie', function () {
    return view('movie');
});

Route::get('laporan', function () {
    return view('laporan');
});

Route::get('konfirmasi', function () {
    return view('konfirmasi');
});

Route::get('kategori', function () {
    return view('kategori');
});

Route::get('jam', function () {
    return view('jam');
});


