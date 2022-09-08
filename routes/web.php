<?php

use App\Http\Controllers\bookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
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

//LandingPage
Route::get('/register', [LandingPageController::class, 'register'])->name('registerMenu');
Route::post('/register-add', [LandingPageController::class, 'addRegister'])->name('addRegister');
Route::post('/validate-email', [LandingPageController::class, 'validateEmail'])->name('validateEmail');
Route::get('/reset-password', [LandingPageController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-password-action', [LandingPageController::class, 'resetPasswordAction'])->name('resetPasswordAction');

//Home Controller
Route::get('/', [HomeController::class, 'landingPage'])->name('landingPage');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//User Controller
Route::get('/user/data/', [UsersController::class, 'index'])->name('getDataUser');
Route::post('/user/add', [UsersController::class, 'addUser'])->name('addDataUser');
Route::post('/user/edit', [UsersController::class, 'updateUser'])->name('updateDataUser');
Route::post('/user/delete', [UsersController::class, 'deleteUser'])->name('deleteDataUser');
Route::post('/user/update-password', [UsersController::class, 'updatePassword'])->name('updatePassword');

//User menu
Route::get('/user/profile/', [UsersController::class, 'profileUser'])->name('getProfileUser');
Route::get('/user/ganti-password/', [UsersController::class, 'gantiPassword'])->name('getGantiPassword');
Route::get('/user/booking/', [UsersController::class, 'orderPage'])->name('getBookingUser');
Route::get('/user/list-booking-user/', [UsersController::class, 'listOrderPage'])->name('getDataListBookingUser');
Route::get('/user/pembayaran/', [UsersController::class, 'pembayaranPage'])->name('getPembayaranUser');
Route::get('/user/jadwal-booking/', [UsersController::class, 'jadwalBooking'])->name('getJadwalBooking');

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
Route::post('/pembayaran/upload-bukti', [pembayaranController::class, 'uploadBuktiPembayaran'])->name('uploadBuktiPembayaran');
