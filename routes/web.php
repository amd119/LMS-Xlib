<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoribukuController;
use App\Http\Controllers\PerpustakaanController;

use App\Http\Controllers\Auth\GoogleController;

use App\Middleware\CheckRole;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/flash', function () {
    return view('landingpage');
})->middleware(['auth', 'verified', 'role:Peminjam'])->name('flash');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:Administrator,Petugas'])->name('dashboard');

Route::get('/auth/redirect', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::middleware(['auth', 'role:Peminjam'])->group(function () {
    Route::get('/caribuku', [PerpustakaanController::class, 'cari'])->name('caribuku');
    Route::get('/detailbuku/{id}', [PerpustakaanController::class, 'detail'])->name('detail');
    Route::get('/caribuku/cari', [PerpustakaanController::class, 'search'])->name('perpustakaan.search');

    Route::get('/pinjaman', [PeminjamanController::class, 'bukuDipinjam'])->name('pinjaman');
    Route::post('/pinjaman/store', [PeminjamanController::class, 'store'])->name('pinjam.store');
    Route::get('/pinjaman/detail/{bid}/{pid}', [PeminjamanController::class, 'pdetail'])->name('pdetail');
    Route::post('/pinjaman/kembalikan/{id}', [PeminjamanController::class, 'pkembalikan'])->name('kembalikan');

    Route::put('/ulasan/{id}', [PerpustakaanController::class, 'ulasanupdate'])->name('ulasan.update');
    Route::post('/ulasan/store', [PerpustakaanController::class, 'ulasanstore'])->name('ulasan.store');
    Route::delete('/ulasan/{id}', [PerpustakaanController::class, 'ulasandelete'])->name('ulasan.delete');

    Route::get('/koleksibuku', [KoleksiController::class, 'koleksi'])->name('koleksi');
    Route::post('/koleksibuku/store', [KoleksiController::class, 'store'])->name('kolekstore');
    Route::delete('/koleksibuku/{id}', [KoleksiController::class, 'delete'])->name('koleksihapus');
});

Route::middleware(['auth', 'role:Administrator,Petugas'])->group(function () {
    Route::get('/kategoribuku', [KategoribukuController::class, 'index'])->name('kategoribuku.home');
    Route::get('/kategoribuku/create', [KategoribukuController::class, 'create'])->name('kategoribuku.create');
    Route::post('/kategoribuku/store', [KategoribukuController::class, 'store'])->name('kategoribuku.store');
    Route::get('/kategoribuku/edit/{id}', [KategoribukuController::class, 'edit'])->name('kategoribuku.edit');
    Route::put('/kategoribuku/update/{id}', [KategoribukuController::class, 'update'])->name('kategoribuku.update');
    Route::delete('/kategoribuku/delete/{id}', [KategoribukuController::class, 'delete'])->name('kategoribuku.delete');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.home');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
    Route::get('/buku/ulasan/{id}', [BukuController::class, 'ulasan'])->name('buku.ulasan');
    Route::delete('/buku/delete/{id}', [BukuController::class, 'delete'])->name('buku.delete');
    Route::get('/buku/cetak', [BukuController::class, 'cetaklaporan'])->name('buku.cetaklaporan');
    Route::delete('/buku/ulasan/delete/{id}', [BukuController::class, 'ulasandelete'])->name('buku.ulasandelete');

    Route::get('/peminjam', [PeminjamController::class, 'index'])->name('peminjam.home');
    Route::get('/peminjam/cetak/{id}', [PeminjamController::class, 'cetaklaporan'])->name('peminjam.cetaklaporan');
});

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.home');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
