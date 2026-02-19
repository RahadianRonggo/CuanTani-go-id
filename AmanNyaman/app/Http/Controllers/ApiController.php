<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vault; // Pastikan Model Vault sudah ada
use Illuminate\Http\Request;
use Carbon\Carbon;

class VaultApiController extends Controller
{
    // Mengambil semua data untuk list Android
    public function index()
    {
        $vaults = Vault::latest()->get();
        return response()->json([
            'status' => 'SUCCESS',
            'data' => $vaults
        ], 200);
    }

    // Menerima input aset baru dari aplikasi Android
    public function store(Request $request)
    {
        $len = strlen($request->password);
        $level = ($len < 6) ? 'LEMAH' : (($len < 12) ? 'SEDANG' : 'KUAT');

        $vault = Vault::create([
            'perangkat' => $request->perangkat,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $level,
            'expires_at' => Carbon::now()->addDays(90)
        ]);

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'ASSET_REMOTE_UPLOAD_COMPLETE',
            'data' => $vault
        ], 201);
    }

    // Fitur Cek Password via API
    public function checkPassword(Request $request)
    {
        $len = strlen($request->password);
        $res = ($len < 6) ? 'LEMAH' : (($len < 12) ? 'SEDANG' : 'KUAT');

        return response()->json(['status' => 'SUCCESS', 'integrity_level' => $res]);
    }
}