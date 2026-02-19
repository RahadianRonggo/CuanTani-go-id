package com.example.amannyamanmobile

import com.google.gson.annotations.SerializedName

// 1. Model untuk SATU baris data aset (Sesuai kolom database Laravel)
data class Vault(
    val id: Int,
    val perangkat: String,
    val username: String,
    val level: String,
    val expires_at: String? // Tanda tanya (?) artinya boleh null/kosong
)

// 2. Model untuk PEMBUNGKUS respon JSON (Sesuai format API Laravel)
data class VaultResponse(
    val status: String,
    val message: String,
    val data: List<Vault> // List ini yang akan kita tampilkan di layar
)