<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/input-kehadiran', [HomeController::class, 'input'])->name('savekehadiran');
Route::get('/keluarga', [HomeController::class, 'tampilkanKeluarga'])->name('keluarga.index');

