<?php

use App\Http\Controllers\ValasController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [ValasController::class, 'index']);
