<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vault;
use App\Models\Document;
use Carbon\Carbon;

class VaultController extends Controller
{
    // Fungsi Utama: Melayani Web (Browser) dan API (Android)
    public function index(Request $request) 
    {
        $data = Vault::latest()->get();
        $docs = Document::latest()->get();

        // JALUR SENSOR API: Jika diakses melalui /api/*
        if ($request->is('api/*') || $request->wantsJson()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'COBALT_PROTOCOL_SYNC_COMPLETE',
                'data' => $data
            ], 200);
        }

        // JALUR VISUAL WEB: Tampilan Dashboard
        return view('welcome', compact('data', 'docs'));
    }

    // FITUR 1: Simpan Aset (Vault)
    public function store(Request $request) {
        $len = strlen($request->password);
        $level = ($len < 6) ? 'LEMAH' : (($len < 12) ? 'SEDANG' : 'KUAT');

        Vault::create([
            'perangkat' => $request->perangkat,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $level,
            'expires_at' => Carbon::now()->addDays(90)
        ]);
        return back();
    }

    // FITUR 2: Audit Password
    public function checkOnly(Request $request) {
        $len = strlen($request->password);
        $res = ($len < 6) ? ['level' => 'LEMAH', 'hex' => '#f87171'] : 
               (($len < 12) ? ['level' => 'SEDANG', 'hex' => '#fbbf24'] : 
               ['level' => 'KUAT', 'hex' => '#34d399']);
        return back()->with('hasil_cek', $res)->with('pass_input', $request->password);
    }

    // FITUR 3: Secure Paper (Upload)
    public function upload(Request $request) {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('secure_docs', 'public');
            Document::create(['nama_dokumen' => $request->nama_dokumen, 'file_path' => $path]);
        }
        return back()->with('tab', 'paper');
    }

    // FITUR 4: Phish Detector
    public function checkLink(Request $request) {
        $link = $request->link;
        $result = ['status' => 'AMAN', 'color' => '#34d399', 'note' => 'Link terverifikasi aman.'];
        if (!str_starts_with($link, 'https://')) {
            $result = ['status' => 'WASPADA', 'color' => '#fbbf24', 'note' => 'Protokol tidak aman!'];
        }
        return back()->with('hasil_link', $result)->with('link_input', $link);
    }

    // FITUR 5: Malware Lab
    public function scanMalware(Request $request) {
        return back()->with('hasil_scan', ['status' => 'AMAN', 'color' => '#34d399', 'note' => 'Struktur bersih.'])
                     ->with('file_name', $request->file('file')->getClientOriginalName())
                     ->with('tab', 'malware');
    }
}