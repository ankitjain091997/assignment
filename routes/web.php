<?php

use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');

// created coustoum middleware for check authentication

Route::middleware([CheckUser::class])->group(function () {
    Route::get('/list', [UserController::class, 'productList'])->name('productList');
    Route::get('/create', [UserController::class, 'productCreate'])->name('productCreate');
    Route::post('/store', [UserController::class, 'productStore'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'productEdit'])->name('productEdit');
    Route::post('/productUpdate/{id}', [UserController::class, 'productUpdate'])->name('productUpdate');
    Route::post('/delete/{id}', [UserController::class, 'productDelete'])->name('productDelete');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
