<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrayTimeController;

Route::get('/', [PrayTimeController::class, 'index']);
Route::post('/praytime', [PrayTimeController::class, 'getPrayTime'])->name('praytime.fetch');

Route::get('/debug', function () {
    return response()->json([
        'env' => app()->environment(),
        'debug' => config('app.debug'),
        'key' => config('app.key'),
    ]);
});
