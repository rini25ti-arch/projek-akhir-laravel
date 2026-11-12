<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

// Resource Route Pelanggan yang benar (tanpa pembungkus array [])
Route::resource('pelanggan', PelangganController::class);