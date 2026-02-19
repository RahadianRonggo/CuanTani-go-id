package com.example.amannyamanmobile

import retrofit2.Call
import retrofit2.http.GET

interface ApiService {
    // Menembak endpoint: http://IP-LAPTOP/api/vaults
    // Fungsi ini akan mengambil data dan membungkusnya ke dalam VaultResponse
    @GET("api/vaults")
    fun getVaults(): Call<VaultResponse>
}