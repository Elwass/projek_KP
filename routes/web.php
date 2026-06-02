<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataPesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;

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
$match = ['GET', 'POST'];

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout')->middleware('auth');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('guest');

// Peserta
Route::get('/dashboard', [PesertaController::class, 'index'])->name('peserta.index')->middleware('isPeserta');
Route::match($match, '/daftar', [PesertaController::class, 'daftar'])->name('peserta.daftar')->middleware('isPeserta');
Route::get('/hapus', [PesertaController::class, 'hapus'])->name('peserta.hapus')->middleware('isPeserta');

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('isNotPeserta');
// -- data pendaftaran
Route::get('/admin/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.index')->middleware('isNotPeserta');
Route::get('/admin/pendaftaran/detail/{id}', [PendaftaranController::class, 'detail'])->name('admin.pendaftaran.detail')->middleware('isNotPeserta');
Route::match($match, '/admin/pendaftaran/terima/{id}', [PendaftaranController::class, 'terima'])->name('admin.pendaftaran.terima')->middleware('isAdmin');
Route::post('/admin/pendaftaran/tolak', [PendaftaranController::class, 'tolak'])->name('admin.pendaftaran.tolak')->middleware('isAdmin');
Route::post('/admin/pendaftaran/hapus', [PendaftaranController::class, 'hapus'])->name('admin.pendaftaran.hapus')->middleware('isAdmin');
// -- data peserta pkl
Route::get('/admin/peserta', [DataPesertaController::class, 'index'])->name('admin.peserta.index')->middleware('isNotPeserta');
Route::match($match, '/admin/peserta/edit/{id}', [DataPesertaController::class, 'edit'])->name('admin.peserta.edit')->middleware('isAdmin');
Route::match($match, '/admin/peserta/detail/{id}', [DataPesertaController::class, 'detail'])->name('admin.peserta.detail')->middleware('isNotPeserta');
Route::post('/admin/peserta/hapus', [DataPesertaController::class, 'hapus'])->name('admin.peserta.hapus')->middleware('isAdmin');
Route::post('/admin/peserta/berhenti', [DataPesertaController::class, 'berhenti'])->name('admin.peserta.berhenti')->middleware('isAdmin');
Route::get('/admin/peserta/cek-status', [DataPesertaController::class, 'cek_status'])->name('admin.peserta.cek_status')->middleware('isNotPeserta');
// -- data instansi
Route::get('/admin/instansi', [InstansiController::class, 'index'])->name('admin.instansi.index')->middleware('isNotPeserta');
Route::match($match, '/admin/instansi/tambah', [InstansiController::class, 'tambah'])->name('admin.instansi.tambah')->middleware('isAdmin');
Route::match($match, '/admin/instansi/edit/{id}', [InstansiController::class, 'edit'])->name('admin.instansi.edit')->middleware('isAdmin');
Route::match($match, '/admin/instansi/detail/{id}', [InstansiController::class, 'detail'])->name('admin.instansi.detail')->middleware('isNotPeserta');
Route::post('/admin/instansi/hapus', [InstansiController::class, 'hapus'])->name('admin.instansi.hapus')->middleware('isAdmin');
// -- data pegawai
Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index')->middleware('isNotPeserta');
Route::match($match, '/admin/pegawai/tambah', [PegawaiController::class, 'tambah'])->name('admin.pegawai.tambah')->middleware('isAdmin');
Route::match($match, '/admin/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('admin.pegawai.edit')->middleware('isNotPeserta');
Route::get('/admin/pegawai/detail/{id}', [PegawaiController::class, 'detail'])->name('admin.pegawai.detail')->middleware('isNotPeserta');
Route::post('/admin/pegawai/hapus', [PegawaiController::class, 'hapus'])->name('admin.pegawai.hapus')->middleware('isAdmin');
Route::match($match, '/admin/pegawai/change-password/{id}', [PegawaiController::class, 'change_password'])->name('admin.pegawai.change_password')->middleware('isNotPeserta');
// -- penjadwalan
Route::get('/admin/penjadwalan', [PenjadwalanController::class, 'index'])->name('admin.penjadwalan.index')->middleware('isNotPeserta');
Route::match($match, '/admin/penjadwalan/edit', [PenjadwalanController::class, 'edit'])->name('admin.penjadwalan.edit')->middleware('isNotPeserta');