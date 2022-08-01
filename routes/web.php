<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\CutiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanPegawaiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\UsersController;
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
Auth::routes();
Route::get('/logged-in', function () {
    return redirect(route('login'));
});


//Home Controller
Route::get('/', [HomeController::class, 'landingPage'])->name('landingPage');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//User Controller
Route::get('/register', [UsersController::class, 'register'])->name('registerMenu');
Route::post('/register-add', [UsersController::class, 'addUser'])->name('addRegister');
Route::get('/user/data/', [UsersController::class, 'index'])->name('getDataUser');
Route::post('/user/add', [UsersController::class, 'addUser'])->name('addDataUser');
Route::post('/user/edit', [UsersController::class, 'updateUser'])->name('updateDataUser');
Route::post('/user/delete', [UsersController::class, 'deleteUser'])->name('deleteDataUser');
//user menu
Route::get('/user/booking/', [UsersController::class, 'orderPage'])->name('getBookingUser');
Route::get('/user/list-booking-user/', [UsersController::class, 'listOrderPage'])->name('getDataListBookingUser');
Route::get('/user/pembayaran/', [UsersController::class, 'pembayaranPage'])->name('getPembayaranUser');


//ListBooking Controller
Route::get('/list-booking/data/', [bookingController::class, 'listBooking'])->name('getDataListBooking');

//Layanan Controller
Route::get('/layanan/data/', [LayananController::class, 'index'])->name('getDataLayanan');
Route::post('/layanan/add', [LayananController::class, 'add'])->name('addDataLayanan');
Route::post('/layanan/edit', [LayananController::class, 'update'])->name('updateDataLayanan');
Route::post('/layanan/delete', [LayananController::class, 'delete'])->name('deleteDataLayanan');

//Booking Controller
Route::get('/booking/data/', [bookingController::class, 'index'])->name('getDataBooking');
Route::post('/booking/add', [bookingController::class, 'add'])->name('addDataBooking');
Route::post('/booking/edit', [bookingController::class, 'update'])->name('updateDataBooking');
Route::post('/booking/delete', [bookingController::class, 'delete'])->name('deleteDataBooking');

//Pembayaran Controller
Route::get('/pembayaran/data/', [pembayaranController::class, 'index'])->name('getDataPembayaran');
Route::post('/pembayaran/add', [pembayaranController::class, 'add'])->name('addDataPembayaran');
Route::post('/pembayaran/edit', [pembayaranController::class, 'update'])->name('updateDataPembayaran');
Route::post('/pembayaran/delete', [pembayaranController::class, 'delete'])->name('deleteDataPembayaran');

//Kegiatan Controller
Route::get('/kegiatan/data/', [KegiatanController::class, 'index'])->name('getDataKegiatan');
Route::post('/kegiatan/add', [KegiatanController::class, 'add'])->name('addDataKegiatan');
Route::post('/kegiatan/edit', [KegiatanController::class, 'update'])->name('updateDataKegiatan');
Route::post('/kegiatan/delete', [KegiatanController::class, 'delete'])->name('deleteDataKegiatan');

//Kegiatan Pegawai Controller
Route::get('/report-kegiatan/data/', [KegiatanPegawaiController::class, 'index'])->name('getDataKegiatanPegawai');
Route::post('/report-kegiatan/add', [KegiatanPegawaiController::class, 'add'])->name('addDataKegiatanPeagwai');
Route::post('/report-kegiatan/edit', [KegiatanPegawaiController::class, 'update'])->name('updateDataKegiatanPeagwai');
Route::post('/report-kegiatan/delete', [KegiatanPegawaiController::class, 'delete'])->name('deleteDataKegiatanPeagwai');
Route::post('/report-kegiatan/konfirm', [KegiatanPegawaiController::class, 'konfirm'])->name('konfirmDataKegiatanPeagwai');

//Absensi Controller
Route::get('/absensi/data/', [AbsensiController::class, 'index'])->name('getDataAbsensi');
Route::post('/absensi/add', [AbsensiController::class, 'add'])->name('addDataAbsensi');
Route::post('/absensi/edit', [AbsensiController::class, 'update'])->name('updateDataAbsensi');
Route::post('/absensi/delete', [AbsensiController::class, 'delete'])->name('deleteDataAbsensi');
Route::post('/absensi/konfirm', [AbsensiController::class, 'konfirm'])->name('konfirmDataAbsensi');

//Cuti Controller
Route::get('/cuti/data/', [CutiController::class, 'index'])->name('getDataCuti');
Route::post('/cuti/add', [CutiController::class, 'add'])->name('addDataCuti');
Route::post('/cuti/edit', [CutiController::class, 'update'])->name('updateDataCuti');
Route::post('/cuti/delete', [CutiController::class, 'delete'])->name('deleteDataCuti');
Route::post('/cuti/konfirm', [CutiController::class, 'konfirm'])->name('konfirmDataCuti');
Route::get('/cuti/surat/{id}', [PdfController::class, 'pdfSuratCuti'])->name('pdfSuratCuti');

//laporan controller
Route::get('/laporan/user/', [LaporanController::class, 'laporanDataUser'])->name('getLaporanDataUser');
Route::get('/laporan/kegiatan-pegawai/', [LaporanController::class, 'laporanDataKegiatanPegawai'])->name('geLaporanDataKegiatanPegawai');
Route::get('/laporan/kegiatan/', [LaporanController::class, 'laporanDataKegiatan'])->name('getLaporanDataKegiatan');
Route::get('/laporan/absensi/', [LaporanController::class, 'laporanDataAbsensi'])->name('getLaporanDataAbsensi');
Route::get('/laporan/cuti/', [LaporanController::class, 'laporanDataCuti'])->name('getLaporanDataCuti');
Route::get('/laporan/booking/', [LaporanController::class, 'laporanDataBooking'])->name('getLaporanDataBooking');
