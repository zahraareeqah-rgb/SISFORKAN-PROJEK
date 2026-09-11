<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return redirect()->route('kategori.index');
});

Route::resource('kategori', KategoriController::class);
Route::resource('buku', BukuController::class);
Route::resource('member', MemberController::class);
Route::resource('peminjaman', PeminjamanController::class);
