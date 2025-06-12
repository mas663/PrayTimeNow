<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrayTimeController;

Route::get('/', [PrayTimeController::class, 'index']);
Route::post('/praytime', [PrayTimeController::class, 'getPrayTime'])->name('praytime.fetch');
Route::get('/data/cities.json', [PrayTimeController::class, 'getCities']);
