package com.example.amannyamanmobile

import android.graphics.Color
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

class VaultAdapter(private val vaultList: List<Vault>) : 
    RecyclerView.Adapter<VaultAdapter.ViewHolder>() {

    class ViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val tvPerangkat: TextView = itemView.findViewById(R.id.tvPerangkat)
        val tvUsername: TextView = itemView.findViewById(R.id.tvUsername)
        val tvLevel: TextView = itemView.findViewById(R.id.tvLevel)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_vault, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val vault = vaultList[position]

        holder.tvPerangkat.text = vault.perangkat
        holder.tvUsername.text = "ID: ${vault.username}"
        holder.tvLevel.text = "[ ${vault.level} ]"

        // Logika Warna Level
        when (vault.level.uppercase()) {
            "KUAT" -> holder.tvLevel.setTextColor(Color.GREEN)
            "SEDANG" -> holder.tvLevel.setTextColor(Color.YELLOW)
            else -> holder.tvLevel.setTextColor(Color.RED)
        }
    }

    override fun getItemCount() = vaultList.size
}