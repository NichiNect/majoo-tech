<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\{DashboardController, ProductController, TransactionController};
use \App\Http\Controllers\HomeController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/products/detail/{id}', [HomeController::class, 'detail'])->name('home.detail');
Route::post('/buy-item/{id}', [HomeController::class, 'buyItem'])->middleware('auth')->name('frontend.buyitem');
Route::get('/history', [HomeController::class, 'history'])->middleware('auth')->name('frontend.history');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'cekrole:admin']], function() {

	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
		Route::get('', [ProductController::class, 'index'])->name('index');
		Route::get('/create-new-product', [ProductController::class, 'create'])->name('create');
		Route::post('/create-new-product', [ProductController::class, 'store'])->name('store');
		Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit');
		Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('update');
		Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('destroy');
	});

	Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function() {
		Route::get('', [TransactionController::class, 'index'])->name('index');
		Route::get('/log', [TransactionController::class, 'logTransaction'])->name('log');
		Route::put('/{id}/acc-transaction', [TransactionController::class, 'accTransaction'])->name('acctransaction');
	});
});