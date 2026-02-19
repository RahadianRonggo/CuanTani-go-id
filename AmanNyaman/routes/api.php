<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaultController;

/*
| JALUR KOMUNIKASI API ANDROID
| Panggil lewat: http://127.0.0.1:8000/api/vaults
*/
Route::get('/vaults', [VaultController::class, 'index']);