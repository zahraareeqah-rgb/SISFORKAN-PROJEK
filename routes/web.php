<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return redirect()->route('sesi.index');
});

Route::resource('kategori', KategoriController::class);
Route::resource('buku', BukuController::class);
Route::resource('member', MemberController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::get('/login',[SessionController::class,'index']);
Route::get('/sesi',[SessionController::class,'index'])->name('sesi.index');
Route::post('sesi/login',[SessionController::class,'login']);
Route::get('/sesi/logout',[SessionController::class,'logout']);
