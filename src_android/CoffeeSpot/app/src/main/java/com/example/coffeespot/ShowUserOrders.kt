package com.example.coffeespot

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import androidx.recyclerview.widget.LinearLayoutManager
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import kotlinx.android.synthetic.main.activity_show_user_orders.*

class ShowUserOrders : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_show_user_orders)

        var username:String = intent.getStringExtra("username").toString()

        var volleyErrors:String = ""

        val url:String = "http://192.168.0.157/php_project/coffee-spot-a/orders/show.php?username=$username"

        val queue:RequestQueue = Volley.newRequestQueue(this)

        val stringRequest = JsonArrayRequest(Request.Method.GET, url, null,
                { response ->
                    var list = ArrayList<Order>()

                    for (x in 0 until response.length()) {
                        var y = response.getJSONObject(x)
                        list.add(Order(y.getInt("id"), y.getString("coffee_name"), y.getInt("quantity")))
                    }

                    var adp = OrderAdapter(this, list)
                    rv_suo.layoutManager = LinearLayoutManager(this)
                    rv_suo.adapter = adp
                },
                { error ->
                    volleyErrors += error.message
                })

        queue.add(stringRequest)
    }
}