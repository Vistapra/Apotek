<?php

use App\Models\kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukTransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:Owner|Pembeli']], function () {
        Route::resource('produk_transaksi', ProdukTransaksiController::class);
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('produk', ProdukController::class)->middleware('role:Owner');
        Route::resource('kategori', KategoriController::class)->middleware('role:Owner');
    });
});

require __DIR__ . '/auth.php';
