<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\DaftarServiceController;
use App\Http\Controllers\Api\DataServiceController;
use App\Http\Controllers\Api\PembayaranServiceController;

Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('kendaraan', KendaraanController::class);
Route::apiResource('daftar-service', DaftarServiceController::class);
Route::apiResource('data-service', DataServiceController::class);
Route::apiResource('pembayaran-service', PembayaranServiceController::class);
