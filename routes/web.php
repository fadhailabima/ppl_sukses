<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\EditMhsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Mahasiswa
Route::get('/dashboardmahasiswa', [MahasiswaController::class, 'index'])->middleware('mhs');
//ISI IRS
// Route::post('/dashboardmahasiswa/IsiIRSMahasiswa', [IRSMahasiswaController::class, 'store'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiIRSMahasiswa', [IRSMahasiswaController::class, 'index'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiIRSMahasiswa', [IRSMahasiswaController::class, 'show'])->middleware('mhs');
// //ISI KHS
// Route::get('/dashboardmahasiswa/IsiKHSMahasiswa', [KHSMahasiswaController::class, 'index'])->middleware('mhs');
// Route::post('/dashboardmahasiswa/IsiKHSMahasiswa', [KHSMahasiswaController::class, 'store'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiKHSMahasiswa', [KHSMahasiswaController::class, 'show'])->middleware('mhs');
// //ISI PKL
// Route::post('/dashboardmahasiswa/IsiPKLMahasiswa', [PKLMahasiswaController::class, 'store'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiPKLMahasiswa', [PKLMahasiswaController::class, 'index'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiPKLMahasiswa', [PKLMahasiswaController::class, 'show'])->middleware('mhs');

// //ISI SKRIPSI
// Route::get('/dashboardmahasiswa/IsiSkripsiMahasiswa', [SkripsiMahasiswaController::class, 'index'])->middleware('mhs');
// Route::post('/dashboardmahasiswa/IsiSkripsiMahasiswa', [SkripsiMahasiswaController::class, 'store'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiSkripsiMahasiswa', [SkripsiMahasiswaController::class, 'show'])->middleware('mhs');
// //edit
Route::get('/dashboardmahasiswa/profile/edit', [EditMhsController::class, 'index'])->middleware('mhs');
Route::put('/dashboardmahasiswa/profile/edit', [EditMhsController::class, 'update'])->middleware('mhs');