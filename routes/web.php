<?php

use App\Http\Controllers\ExchangeListController;
use App\Http\Controllers\ValasController;
use Illuminate\Support\Facades\Route;

// Home -> Hitung Valas (View)
Route::get('/', [ValasController::class, 'index']);
// Home -> Lakukan kalkulasi valas
Route::post('/', [ValasController::class, 'calculate']);

// Daftar Kurs
Route::get('/daftar-kurs', [ExchangeListController::class, 'index']);
