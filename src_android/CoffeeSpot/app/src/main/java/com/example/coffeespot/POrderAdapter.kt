package com.example.coffeespot

import android.content.Context
import android.text.Editable
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.EditText
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

class POrderAdapter(var c: Context, var list:ArrayList<POrder>) : RecyclerView.Adapter<RecyclerView.ViewHolder> () {
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RecyclerView.ViewHolder {
        var my_view = LayoutInflater.from(c).inflate(R.layout.show_porder, parent, false)
        return MyOrder(my_view)
    }

    override fun onBindViewHolder(holder: RecyclerView.ViewHolder, position: Int) {
        (holder as MyOrder).bind(list[position].id, list[position].coffeeName, list[position].quantity)
    }

    override fun getItemCount(): Int {
        return list.size
    }

    class MyOrder(view:View) : RecyclerView.ViewHolder(view) {
        var tv_id = view.findViewById<TextView>(R.id.order_id)
        var tv_coffeename = view.findViewById<TextView>(R.id.order_coffeename)

        fun bind(i:Int, c:String, q:Int) {
            tv_id.text = i.toString()
            tv_coffeename.text = c
        }
    }
}