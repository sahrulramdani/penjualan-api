<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;

Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/{id}', [BarangController::class, 'detail']);
Route::post('/barang/save', [BarangController::class, 'saveBarang']);
Route::post('/barang/update', [BarangController::class, 'updateBarang']);
Route::delete('/barang/delete/{id}', [BarangController::class, 'deleteBarang']);

Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::get('/pelanggan/{id}', [PelangganController::class, 'detail']);
Route::post('/pelanggan/save', [PelangganController::class, 'savePelanggan']);
Route::post('/pelanggan/update', [PelangganController::class, 'updatePelanggan']);
Route::delete('/pelanggan/delete/{id}', [PelangganController::class, 'deletePelanggan']);

Route::get('/penjualan', [PenjualanController::class, 'index']);
Route::get('/penjualan/{id}', [PenjualanController::class, 'detail']);
Route::post('/penjualan/save', [PenjualanController::class, 'savePenjualan']);
Route::post('/penjualan/update', [PenjualanController::class, 'updatePenjualan']);
Route::delete('/penjualan/delete/{id}', [PenjualanController::class, 'deletePenjualan']);



// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "api" middleware group. Make something great!
// |
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
