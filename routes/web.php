<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiController;

// use App\Http\Controllers\ProdukController;
// use App\Http\Controllers\TransaksiController;
// use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// memberi nama middleware dengan halaman login dengan menggunakan ->name('login)
Route::get('/', [LoginController::class, 'index']);

// memberi nama middleware dengan halaman login dengan menggunakan ->name('login)
Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route::resource('/user', UserController::class)->middleware('auth');

Route::resource('/properti', PropertiController::class)->middleware('auth');

// Route::resource('/transaksi', TransaksiController::class)->middleware('auth');

// Route::get('/transaksi/batal/{id}', [TransaksiController::class, 'batal'])->name('transaksiBatal');
// Route::get('/transaksi/confirm/{id}', [TransaksiController::class, 'confirm'])->name('transaksiConfirm');

// Route::get('/transaksi/kirim/{id}', [TransaksiController::class, 'kirim'])->name('transaksiKirim');
// Route::get('/transaksi/selesai/{id}', [TransaksiController::class, 'selesai'])->name('transaksiSelesai');


