<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExchangeListController;
use App\Http\Controllers\ValasController;
use Illuminate\Support\Facades\Route;

// Home -> Hitung Valas (View)
Route::get('/', [ValasController::class, 'index']);
// Home -> Lakukan kalkulasi valas
Route::post('/', [ValasController::class, 'calculate']);

// Daftar Kurs
Route::get('/exchange-rates', [ExchangeListController::class, 'index']);

// tentang
Route::get('/about', function () {
    return view('about', [
        'title' => __('about.title')
    ]);
});

// ganti bahasa
Route::post('/language', [ValasController::class, 'lang']);
