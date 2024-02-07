<?php

use Illuminate\Support\Facades\Route;
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
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admincreate/{id}', [DashboardController::class, 'view']);
    Route::post('/addadmin', [DashboardController::class, 'store'])->name('addadmin');
    Route::post('/editadmin', [DashboardController::class, 'edit'])->name('editadmin');
    Route::get('/delete', [DashboardController::class, 'delete'])->name('delete');
    Route::get('/addbuku', [DashboardController::class, 'addbuku']);
    Route::post('/tambahbuku', [DashboardController::class, 'addbukuprosses'])->name('tambahbuku');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/admincreate', [DashboardController::class, 'view']);
    // Route::post('/addadmin', [DashboardController::class, 'store'])->name('addadmin');
});
//Login & Register 
Route::get('/login', [LoginRegisterController::class, 'index']);
Route::get('/register', [LoginRegisterController::class, 'register']);
Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

