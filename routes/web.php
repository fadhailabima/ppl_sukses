<?php

use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\IrsDosenController;
use App\Http\Controllers\KhsDosenController;
use App\Http\Controllers\LengkapiDataMhsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\EditMhsController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\IRSMhsController;
use App\Http\Controllers\KHSMhsController;
use App\Http\Controllers\PklDosenController;
use App\Http\Controllers\PKLMhsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SkripsiDosenController;
use App\Http\Controllers\SkripsiMhsController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\DaftarMHSdosenController;
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
 // Lengkapi Data
 Route::get('/lengkapidata', [LengkapiDataMhsController::class, 'index'])->middleware('mhs');
 Route::put('/lengkapidata', [LengkapiDataMhsController::class, 'update'])->middleware('mhs')->name('lengkapidata.update');

// Mahasiswa
Route::get('/dashboardmahasiswa', [MahasiswaController::class, 'index'])->middleware('mhs');
//ISI IRS
Route::post('/dashboardmahasiswa/IsiIRSMahasiswa', [IRSMhsController::class, 'store'])->middleware('mhs');
Route::get('/dashboardmahasiswa/IsiIRSMahasiswa', [IRSMhsController::class, 'index'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiIRSMahasiswa', [IRSMhsController::class, 'show'])->middleware('mhs');
// //ISI KHS
Route::get('/dashboardmahasiswa/IsiKHSMahasiswa', [KHSMhsController::class, 'index'])->middleware('mhs');
Route::post('/dashboardmahasiswa/IsiKHSMahasiswa', [KHSMhsController::class, 'store'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiKHSMahasiswa', [KHSMhsController::class, 'show'])->middleware('mhs');
// //ISI PKL
Route::post('/dashboardmahasiswa/IsiPKLMahasiswa', [PKLMhsController::class, 'store'])->middleware('mhs');
Route::get('/dashboardmahasiswa/IsiPKLMahasiswa', [PKLMhsController::class, 'index'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiPKLMahasiswa', [PKLMhsController::class, 'show'])->middleware('mhs');

// //ISI SKRIPSI
Route::get('/dashboardmahasiswa/IsiSkripsiMahasiswa', [SkripsiMhsController::class, 'index'])->middleware('mhs');
Route::post('/dashboardmahasiswa/IsiSkripsiMahasiswa', [SkripsiMhsController::class, 'store'])->middleware('mhs');
// Route::get('/dashboardmahasiswa/IsiSkripsiMahasiswa', [SkripsiMhsController::class, 'show'])->middleware('mhs');
// //edit
Route::get('/dashboardmahasiswa/profile/edit', [EditMhsController::class, 'index'])->middleware('mhs');
Route::put('/dashboardmahasiswa/profile/edit', [EditMhsController::class, 'update'])->middleware('mhs');

// Operator
// Dashboard
Route::get('/dashboardadmin', [OperatorController::class, 'index'])->middleware('operator');
// Register Akun
Route::get('/dashboardadmin/register', [RegisterController::class, 'index'])->middleware('operator');
Route::post('/dashboardadmin/register', [RegisterController::class, 'store'])->middleware('operator');

//Dosen
Route::get('/dashboarddosen', [DashboardDosenController::class, 'index'])->middleware('dosen');

// //IRS
Route::get('/dashboarddosen/irs', [IrsDosenController::class, 'index'])->middleware('dosen');
Route::get('/dashboarddosen/irs/download/{id}', [IrsDosenController::class, 'download'])->middleware('dosen');
Route::get('/dashboarddosen/irs/verify/{id}', [IrsDosenController::class, 'changestatus'])->middleware('dosen');
Route::get('/dashboarddosen/irs/unverify/{id}', [IrsDosenController::class, 'unchangestatus'])->middleware('dosen');
// //KHS
Route::get('/dashboarddosen/khs', [KhsDosenController::class, 'index'])->middleware('dosen');
Route::get('/dashboarddosen/khs/download/{id}', [KhsDosenController::class, 'download'])->middleware('dosen');
Route::get('/dashboarddosen/khs/verify/{id}', [KHSDosenController::class, 'changestatus'])->middleware('dosen');
Route::get('/dashboarddosen/khs/unverify/{id}', [KHSDosenController::class, 'unchangestatus'])->middleware('dosen');
// //PKL
Route::get('/dashboarddosen/pkl', [PklDosenController::class, 'index'])->middleware('dosen');
Route::get('/dashboarddosen/pkl/download/{id}', [PklDosenController::class, 'download'])->middleware('dosen');
Route::get('/dashboarddosen/pkl/verify/{id}', [PklDosenController::class, 'changestatus'])->middleware('dosen');
Route::get('/dashboarddosen/pkl/unverify/{id}', [PklDosenController::class, 'unchangestatus'])->middleware('dosen');

// //SKRIPSI
Route::get('/dashboarddosen/skripsi', [SkripsiDosenController::class, 'index'])->middleware('dosen');
Route::get('/dashboarddosen/skripsi/download/{id}', [SkripsiDosenController::class, 'download'])->middleware('dosen');
Route::get('/dashboarddosen/skripsi/verify/{id}', [SkripsiDosenController::class, 'changestatus'])->middleware('dosen');
Route::get('/dashboarddosen/skripsi/unverify/{id}', [SkripsiDosenController::class, 'unchangestatus'])->middleware('dosen');

//Daftar Mahasiswa
Route::get('/dashboarddosen/daftarmahasiswa', [DaftarMHSdosenController::class, 'index'])->middleware('dosen');
Route::get('/dashboarddosen/detaildaftarmahasiswa/{nim}', [DaftarMHSdosenController::class, 'detail'])->middleware('dosen');

//Departments
Route::get('/dashboarddepartment', [DepartmentsController::class, 'index'])->middleware('department');
Route::get('/dashboarddepartment/daftarmahasiswa', [DepartmentsController::class, 'dataMHS'])->middleware('department');
Route::get('/dashboarddepartment/detailmahasiswa/{nim}', [DepartmentsController::class, 'detailMHS'])->middleware('department');