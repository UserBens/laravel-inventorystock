<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StockCardController;
use App\Http\Controllers\PembelianProdukController;
use App\Http\Controllers\PenjualanProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StockCardController::class, 'index']);

Route::get('pembelian/create', [PembelianProdukController::class, 'viewpembelian'])->name('pembelian.create');
Route::post('pembelian', [PembelianProdukController::class, 'storepembelian'])->name('pembelian.store');
Route::delete('pembelian/{id}', [PembelianProdukController::class, 'pembeliandestroy'])->name('pembelian.destroy');

Route::get('penjualan/create', [PenjualanProdukController::class, 'viewpenjualan'])->name('penjualan.create');
Route::post('penjualan', [PenjualanProdukController::class, 'storepenjualan'])->name('penjualan.store');
Route::delete('penjualan/{id}', [PenjualanProdukController::class, 'penjualandestroy'])->name('penjualan.destroy');

Route::resource('produk', ProdukController::class);

