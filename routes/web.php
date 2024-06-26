<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarAdminController;
use App\Http\Controllers\HomeController;
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

//! Group for the User Panel
Route::group(['prefix' => '/home', 'middleware' => 'auth'], function () {
    Route::post('/rent/{car}', [HomeController::class, 'index'])->name('home.rents');
    Route::put('/rentcar/{car}/confirm', [HomeController::class, 'addrent'])->name('home.addrent');
    Route::get('/return', [HomeController::class, 'return'])->name('home.return');

    Route::post('return/{car}', [HomeController::class, 'returncar'])->name('home.returncar');
    //Route::post('/bank-account', [BankAccountController::class, 'update']);
});

Route::get('dashboard',[AuthController::class,'dashpage'])->name('dashboard')->middleware('admin');
// Route::get('dashboard/car',[AuthController::class,'dashpage'])->name('dashboard')->middleware('admin');

//! Using middleware group
Route::group(['prefix' => '/dashboard', 'middleware' => 'admin'], function () {
    Route::get('/cars', [AuthController::class, 'dashcarpage'])->name('cars');
    Route::delete('/cars/{car}', [CarAdminController::class, 'destroy'])->name('cars.destroy');
    Route::put('/cars/{car}', [CarAdminController::class, 'update'])->name('cars.update');

    Route::get('/used', [CarAdminController::class, 'dashapipage'])->name('used');

    Route::get('/adprof', [CarAdminController::class, 'dashprof'])->name('adprof');
    Route::post('/change-password', [CarAdminController::class, 'changePassword'])->name('changeadpass');

    Route::get('/rentadmin', [CarAdminController::class, 'rentadmin'])->name('rentadmin');
    //Route::post('/bank-account', [BankAccountController::class, 'update']);
});

Route::post('/addCar', [CarAdminController::class, 'store']);

/* Route::get('/log', function () {
    return view('auth.login');
});

Route::get('/reg', function () {
    return view('auth.register');
}); */
