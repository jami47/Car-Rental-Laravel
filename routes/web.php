<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'guest'],function(){
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('reg', [AuthController::class, 'registerpg'])->name('register');
    Route::post('reg', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('home',[AuthController::class,'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('dashboard',[AuthController::class,'dashpage'])->name('dashboard')->middleware('admin');


/* Route::get('/log', function () {
    return view('auth.login');
});

Route::get('/reg', function () {
    return view('auth.register');
}); */
