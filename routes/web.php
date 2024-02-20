<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DowloadController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginRegisterController;

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

Route::get('/', function () {
    return view('logis.login');
});
// Route::get('/dashboard', function () {
//     return view('admin.master');
// });
Route::group(['middleware' => ['role:admin|petugas']], function () {
    Route::get('/admincreate', [DashboardController::class, 'view']);
    Route::post('/addadmin', [DashboardController::class, 'store'])->name('addadmin');
    Route::put('/editadmin/{id}', [DashboardController::class, 'edit'])->name('editadmin');        
    Route::put('/editbuku/{id}', [DashboardController::class, 'editbuku'])->name('editbuku');      
    Route::delete('/delete/{user}', [DashboardController::class, 'delete'])->name('delete');
    Route::delete('/hapus/{buku}', [DashboardController::class, 'hapus'])->name('hapus');
    Route::get('/addbuku', [DashboardController::class, 'addbuku']);
    Route::post('/tambahbuku', [DashboardController::class, 'addbukuprosses'])->name('tambahbuku');

    Route::patch('/update-status/{id}', [PeminjamController::class, 'updateStatus'])->name('update.status');
    // Route::patch('/kembalikan-buku/{id}', [PeminjamController::class, 'kembalikanBuku'])->name('kembalikan.buku');
    Route::patch('/kembalikan-buku/{id}', [PeminjamController::class, 'kembalikanBuku'])->name('kembalikan-buku');

    Route::get('/peminjaman/download/pdf', [DowloadController::class, 'downloadPeminjamanPDF'])->name('peminjaman.download.pdf');
    Route::get('/peminjaman/download/excel', [DowloadController::class, 'downloadPeminjamanExcel'])->name('peminjaman.download.excel');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/buku', [PeminjamController::class, 'index'])->name('buku.index');
    // Route::get('/pinjaman', [PeminjamController::class, 'show'])->name('pinjaman');
    // Route::post('/peminjaman' ,[PeminjamController::class, 'store'])->name('peminjaman.store');
    // Route::post('/kembalikan-buku/{id}', [PeminjamanController::class, 'kembalikanBuku']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/pinjaman', [PeminjamController::class, 'show'])->name('pinjaman');
    Route::post('/peminjaman' ,[PeminjamController::class, 'store'])->name('peminjaman.store');
    Route::post('/kembalikan-buku/{id}', [PeminjamanController::class, 'kembalikanBuku']);
});
//Login & Register 
Route::get('/login', [LoginRegisterController::class, 'index']);
Route::get('/register', [LoginRegisterController::class, 'register']);
Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

