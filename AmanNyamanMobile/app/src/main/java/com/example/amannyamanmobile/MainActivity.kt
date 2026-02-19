package com.example.amannyamanmobile

import android.content.Intent
import android.os.Bundle
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

class MainActivity : AppCompatActivity() {

    // >>> SETTING IP DI SINI <<<
    // Emulator: "http://10.0.2.2:8000/"
    private val BASE_URL = "http://10.0.2.2:8000/"

    private lateinit var recyclerView: RecyclerView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        // 1. Inisialisasi RecyclerView
        recyclerView = findViewById(R.id.recyclerView)
        recyclerView.layoutManager = LinearLayoutManager(this)

        // 2. Setup Tombol Auditor
        val btnAuditor = findViewById<TextView>(R.id.btnAuditor)
        btnAuditor.setOnClickListener {
            val intent = Intent(this, PasswordAuditorActivity::class.java)
            startActivity(intent)
        }

        // 3. Panggil Data dari Server
        fetchData()
    }

    private fun fetchData() {
        val retrofit = Retrofit.Builder()
            .baseUrl(BASE_URL)
            .addConverterFactory(GsonConverterFactory.create())
            .build()

        val apiService = retrofit.create(ApiService::class.java)

        apiService.getVaults().enqueue(object : Callback<VaultResponse> {
            override fun onResponse(call: Call<VaultResponse>, response: Response<VaultResponse>) {
                if (response.isSuccessful) {
                    val responseData = response.body()
                    if (responseData != null) {
                        val dataList = responseData.data
                        recyclerView.adapter = VaultAdapter(dataList)
                        Toast.makeText(this@MainActivity, "SYNC BERHASIL: ${dataList.size} Data", Toast.LENGTH_SHORT).show()
                    } else {
                        Toast.makeText(this@MainActivity, "Data Kosong", Toast.LENGTH_SHORT).show()
                    }
                } else {
                    Toast.makeText(this@MainActivity, "Server Error: ${response.code()}", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<VaultResponse>, t: Throwable) {
                Toast.makeText(this@MainActivity, "Koneksi Gagal: ${t.message}", Toast.LENGTH_LONG).show()
            }
        })
    }
}