package com.example.amannyamanmobile

import android.graphics.Color
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.widget.EditText
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity

class PasswordAuditorActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_password_auditor)

        val etPassword = findViewById<EditText>(R.id.etPassword)
        val tvStatus = findViewById<TextView>(R.id.tvStatus)
        val tvDetail = findViewById<TextView>(R.id.tvDetail)

        // Fitur Sensor: Membaca ketikan secara langsung (Real-time)
        etPassword.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) {}
            override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) {}
            
            override fun afterTextChanged(s: Editable?) {
                val password = s.toString()
                
                if (password.isEmpty()) {
                    tvStatus.text = "[ STATUS: MENUNGGU INPUT ]"
                    tvStatus.setTextColor(Color.parseColor("#555555"))
                    tvDetail.text = "- Menunggu karakter..."
                    return
                }

                // Logika Gagah (Deteksi Huruf, Angka, Simbol)
                val hasLetter = password.any { it.isLetter() }
                val hasDigit = password.any { it.isDigit() }
                val hasSymbol = password.any { !it.isLetterOrDigit() }

                var details = "ANALISIS SISTEM:\n"
                details += if (password.length >= 8) "✅ Panjang OK (>= 8)\n" else "❌ Terlalu Pendek (< 8)\n"
                details += if (hasLetter && hasDigit) "✅ Kombinasi Huruf & Angka\n" else "❌ Hanya huruf/angka saja\n"
                details += if (hasSymbol) "✅ Terdapat Simbol Khusus\n" else "❌ Tidak ada simbol khusus\n"
                
                tvDetail.text = details

                // Kalkulasi Level
                if (password.length < 6) {
                    tvStatus.text = "[ LEVEL: SANGAT LEMAH ]"
                    tvStatus.setTextColor(Color.RED)
                } else if (password.length >= 8 && hasLetter && hasDigit && hasSymbol) {
                    tvStatus.text = "[ LEVEL: SANGAT KUAT ]"
                    tvStatus.setTextColor(Color.GREEN)
                } else if (password.length >= 6 && (hasLetter || hasDigit)) {
                    tvStatus.text = "[ LEVEL: SEDANG ]"
                    tvStatus.setTextColor(Color.YELLOW)
                } else {
                    tvStatus.text = "[ LEVEL: LEMAH ]"
                    tvStatus.setTextColor(Color.RED)
                }
            }
        })
    }
}