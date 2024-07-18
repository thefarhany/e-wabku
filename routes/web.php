<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\KasidalkuController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PPKController;
use App\Http\Controllers\PPSPMController;
use Illuminate\Support\Facades\Route;

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

// Login
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'loginPost'])->name('login.post');

// Middleware for authentication
Route::middleware(['auth'])->group(function () {

  // Admin routes
  Route::middleware(['role:Admin'])->group(function () {
    Route::get('/admin-page', [AdminController::class, 'admin'])->name('admin');
    Route::get('/daftar-user', [AdminController::class, 'user'])->name('user.admin');
    Route::get('/tambah-user', [AdminController::class, 'add_user'])->name('add-user');
    Route::post('/user-proses', [AdminController::class, 'user_proses'])->name('user-proses');
    Route::get('/detail-user/{nama_lengkap}', [AdminController::class, 'detail_user'])->name('detail-user');
    Route::get('/edit-user/{id}', [AdminController::class, 'edit_user'])->name('edit-user');
    Route::put('/update-user/{id}', [AdminController::class, 'update_user'])->name('update-user');
    Route::delete('/hapus-user/{id}', [AdminController::class, 'hapus_user'])->name('hapus-user');
    Route::get('/daftar-referensi-admin', [AdminController::class, 'referensi'])->name('referensi.admin');
    Route::get('/tambah-referensi', [AdminController::class, 'add_referensi'])->name('add-referensi');
    Route::post('/referensi-proses', [AdminController::class, 'referensi_proses'])->name('referensi-proses');
    Route::delete('/hapus-referensi/{id}', [AdminController::class, 'delete_referensi'])->name('hapus-referensi');
    Route::get('/ganti-password-admin', [AdminController::class, 'password'])->name('password.admin');
    Route::post('/ganti-password-admin', [AdminController::class, 'ganti_password'])->name('ganti-password-admin');
    Route::post('/logout-admin', [AdminController::class, 'logout'])->name('logout-admin');
  });

  // Operator routes
  Route::middleware(['auth', 'role:Mabekangdam IV/Diponegoro,Denharjasa Int IV/Semarang,Denjasa Ang IV/B Semarang,Denbekang IV/1.B Purwokerto,Denbekang IV/2.B Yogyakarta,Denbekang IV/3.B Salatiga,Denbekang IV/4.B Surakarta,Tepbek IV/1.A Semarang,Tepbek IV/2.A Slawi,Tepbek IV/3.A Magelang'])->group(function () {
    Route::get('/operator', [OperatorController::class, 'dashboard'])->name('dashboard.operator');
    Route::get('/rekam-wabku', [OperatorController::class, 'rekam'])->name('rekam.operator');
    Route::get('/tambah-wabku', [OperatorController::class, 'tambah_wabku'])->name('tambah-wabku');
    Route::post('/proses-wabku', [OperatorController::class, 'proses_wabku'])->name('proses-wabku');
    Route::get('/download-wabku/{id}', [OperatorController::class, 'download_wabku'])->name('download-wabku');
    Route::delete('/hapus-wabku/{id}', [OperatorController::class, 'delete'])->name('hapus-wabku');
    Route::get('/daftar-referensi-operator', [OperatorController::class, 'referensi'])->name('referensi.operator');
    Route::get('/kontak-pic', [OperatorController::class, 'kontak'])->name('kontak.operator');
    Route::get('/monitoring-operator', [OperatorController::class, 'monitoring'])->name('monitoring.operator');
    Route::get('/detail-wabku/{program}', [OperatorController::class, 'detail_wabku'])->name('detail-wabku');
    Route::get('/video-edukasi', [OperatorController::class, 'video'])->name('video.operator');
    Route::get('/arsip-operator', [OperatorController::class, 'arsip'])->name('arsip.operator');
    Route::get('/ganti-password-operator', [OperatorController::class, 'password'])->name('password.operator');
    Route::post('/ganti-password-operator', [OperatorController::class, 'ganti_password'])->name('ganti-password-operator');
    Route::post('/logout-operator', [OperatorController::class, 'logout'])->name('logout-operator');
  });


  // Bendahara routes
  Route::middleware(['role:Bendahara'])->group(function () {
    Route::get('/bendahara', [BendaharaController::class, 'dashboard'])->name('dashboard.bendahara');
    Route::get('/detail-wabku/{id}', [BendaharaController::class, 'detail_wabku'])->name('detail-wabku');
    Route::put('/validasi-bendahara/{id}', [BendaharaController::class, 'validasi_bendahara'])->name('validasi-bendahara');
    Route::get('/input-sp2d', [BendaharaController::class, 'sp2d'])->name('sp2d.bendahara');
    Route::put('/update-sp2d/{id}', [BendaharaController::class, 'update_sp2d'])->name('update-sp2d');
    Route::get('/unduh-wabku/{id}', [BendaharaController::class, 'unduh_wabku'])->name('unduh-wabku');
    Route::get('/daftar-referensi-bendahara', [BendaharaController::class, 'referensi'])->name('referensi.bendahara');
    Route::get('/monitoring', [BendaharaController::class, 'monitoring'])->name('monitoring.bendahara');
    Route::get('/arsip-bendahara', [BendaharaController::class, 'arsip'])->name('arsip.bendahara');
    Route::get('/ganti-password-bendahara', [BendaharaController::class, 'password'])->name('password.bendahara');
    Route::post('/ganti-password-bendahara', [BendaharaController::class, 'ganti_password'])->name('ganti-password-bendahara');
    Route::post('/logout-bendahara', [BendaharaController::class, 'logout'])->name('logout');
  });

  // PPK routes
  Route::middleware(['role:PPK'])->group(function () {
    Route::get('/ppk', [PPKController::class, 'dashboard'])->name('dashboard.ppk');
    Route::get('/detail-ppk/{id}', [PPKController::class, 'detail_wabku'])->name('detail-ppk');
    Route::put('/validasi-ppk/{id}', [PPKController::class, 'validasi_ppk'])->name('validasi-ppk');
    Route::post('/ppk', [PPKController::class, 'filter_ppk'])->name('filter-ppk');
    Route::get('/daftar-referensi-ppk', [PPKController::class, 'referensi'])->name('referensi.ppk');
    Route::get('/monitoring-ppk', [PPKController::class, 'monitoring'])->name('monitoring.ppk');
    Route::get('/arsip-ppk', [PPKController::class, 'arsip'])->name('arsip.ppk');
    Route::get('/ganti-password-ppk', [PPKController::class, 'password'])->name('password.ppk');
    Route::post('/ganti-password-ppk', [PPKController::class, 'ganti_password'])->name('ganti-password-ppk');
    Route::post('/logout-ppk', [PPKController::class, 'logout'])->name('logout-ppk');
  });

  // PPSPM routes
  Route::middleware(['role:PPSPM'])->group(function () {
    Route::get('/ppspm', [PPSPMController::class, 'dashboard'])->name('dashboard.ppspm');
    Route::get('/detail-wabku-p/{id}', [PPSPMController::class, 'detail_wabku'])->name('detail-wabku');
    Route::put('/validasi-ppspm/{id}', [PPSPMController::class, 'validasi_ppspm'])->name('validasi-ppspm');
    Route::post('/ppspm', [PPSPMController::class, 'filter_ppspm'])->name('filter-ppspm');
    Route::get('/daftar-referensi-ppspm', [PPSPMController::class, 'referensi'])->name('referensi.ppspm');
    Route::get('/monitoring-ppspm', [PPSPMController::class, 'monitoring'])->name('monitoring.ppspm');
    Route::get('/arsip-ppspm', [PPSPMController::class, 'arsip'])->name('arsip.ppspm');
    Route::get('/ganti-password-ppspm', [PPSPMController::class, 'password'])->name('password.ppspm');
    Route::post('/ganti-password-ppspm', [PPSPMController::class, 'ganti_password'])->name('ganti-password-ppspm');
    Route::post('/logout', [PPSPMController::class, 'logout'])->name('logout-ppspm');
  });

  // Kasidalku routes
  Route::middleware(['role:Kasidalku'])->group(function () {
    Route::get('/kasidalku', [KasidalkuController::class, 'dashboard'])->name('dashboard.kasidalku');
    Route::get('/daftar-referensi', [KasidalkuController::class, 'referensi'])->name('referensi.kasidalku');
    Route::get('/monitoring-kasidalku', [KasidalkuController::class, 'monitoring'])->name('monitoring.kasidalku');
    Route::get('/ganti-password-kasidalku', [KasidalkuController::class, 'password'])->name('password.kasidalku');
    Route::get('/unduh-pdf/{id}', [KasidalkuController::class, 'unduh_pdf'])->name('unduh-pdf');
    Route::get('/arsip-kasidalku', [KasidalkuController::class, 'arsip'])->name('arsip.kasidalku');
    Route::get('/ganti-password-kasidalku', [KasidalkuController::class, 'password'])->name('password.kasidalku');
    Route::post('/ganti-password-kasidalku', [KasidalkuController::class, 'ganti_password'])->name('ganti-password-kasidalku');
    Route::post('/logout-kasidalku', [KasidalkuController::class, 'logout'])->name('logout-kasidalku');
  });
});
