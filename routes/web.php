<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TrackingController;
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

Route::get('/', [FrontpageController::class, 'home']);
Route::get('/detail/{id_item}', [FrontpageController::class, 'detail_item']);

Route::get('/dashboard', [DashboardController::class, 'dashboard_transaksi']);
Route::get('/dashboard/transaksi', [DashboardController::class, 'dashboard_transaksi']);
Route::post('/dashboard/transaksi/jemput/{id_transaksi}', [DashboardController::class, 'dashboard_transaksi_jemput']);
Route::post('/dashboard/transaksi/cuci/{id_transaksi}', [DashboardController::class, 'dashboard_transaksi_cuci']);
Route::get('/dashboard/transaksi/selesai/{id_transaksi}', [DashboardController::class, 'dashboard_transaksi_selesai_view']);
Route::post('/dashboard/transaksi/selesai_action/{id_transaksi}', [DashboardController::class, 'dashboard_transaksi_selesai_action']);
Route::post('/dashboard/transaksi/kemas/{id_transaksi}', [DashboardController::class, 'dashboard_transaksi_kemas']);
Route::post('/dashboard/transaksi/bayar/{id_transaksi}', [DashboardController::class, 'dashboard_transaksi_bayar']);

Route::get('/dashboard/pelanggan', [DashboardController::class, 'dashboard_pelanggan']);
Route::get('/dashboard/pelanggan/password/{id_user}', [DashboardController::class, 'dashboard_pelanggan_password_view']);
Route::post('/dashboard/pelanggan/password_action/{id_user}', [DashboardController::class, 'dashboard_pelanggan_password_action']);
Route::post('/dashboard/pelanggan/block/{id_user}', [DashboardController::class, 'dashboard_pelanggan_block']);
Route::post('/dashboard/pelanggan/unblock/{id_user}', [DashboardController::class, 'dashboard_pelanggan_unblock']);

Route::get('/dashboard/ulasan', [DashboardController::class, 'dashboard_ulasan']);

Route::get('/dashboard/kategori', [DashboardController::class, 'dashboard_kategori']);
Route::get('/dashboard/kategori/tambah', [DashboardController::class, 'dashboard_kategori_tambah']);
Route::post('/dashboard/kategori/tambah_action', [DashboardController::class, 'dashboard_kategori_tambah_action']);
Route::get('/dashboard/kategori/edit/{id_item}', [DashboardController::class, 'dashboard_kategori_edit']);
Route::post('/dashboard/kategori/edit_action/{id_item}', [DashboardController::class, 'dashboard_kategori_edit_action']);

Route::get('/dashboard/laporan', [DashboardController::class, 'dashboard_laporan']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login_action', [AuthController::class, 'login_action']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register_action', [AuthController::class, 'register_action']);

Route::post('/keranjang/tambah/{id_item}', [CartController::class, 'cart_add']);
Route::get('/keranjang/berhasil', [CartController::class, 'cart_success']);
Route::get('/keranjang/list', [CartController::class, 'cart_list']);
Route::get('/keranjang/hapus/{id_keranjang}', [CartController::class, 'cart_delete']);
Route::post('/keranjang/checkout', [CartController::class, 'checkout']);

Route::get('/tracking/list', [TrackingController::class, 'tracking_list']);
Route::get('/invoice/{id_transaksi}', [TrackingController::class, 'invoice']);
Route::get('/transaksi/list', [TrackingController::class, 'transaksi_list']);

Route::get('/ulasan/{id_transaksi}', [ReviewController::class, 'review_view']);
Route::post('/ulasan/simpan/{id_transaksi}', [ReviewController::class, 'review_store']);