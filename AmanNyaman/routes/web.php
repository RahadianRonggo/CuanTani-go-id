<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaultController;

Route::get('/', [VaultController::class, 'index']);
Route::post('/save', [VaultController::class, 'store']);
Route::post('/check', [VaultController::class, 'checkOnly']);
Route::post('/upload', [VaultController::class, 'upload']);
Route::post('/check-link', [VaultController::class, 'checkLink']);
Route::post('/scan-malware', [VaultController::class, 'scanMalware']);