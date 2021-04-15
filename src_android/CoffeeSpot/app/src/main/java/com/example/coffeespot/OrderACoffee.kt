package com.example.coffeespot

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import androidx.recyclerview.widget.LinearLayoutManager
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.JsonObjectRequest
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import kotlinx.android.synthetic.main.activity_order_a_coffee.*
import kotlinx.android.synthetic.main.activity_show_user_orders.*
import org.json.JSONArray
import org.json.JSONObject
import java.lang.Error

class OrderACoffee : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_order_a_coffee)

        var username: String = intent.getStringExtra("username").toString()

        var volleyErrors: String = ""

        val url: String = "http://192.168.0.157/php_project/coffee-spot-a/orders/getcoffees.php"

        val queue: RequestQueue = Volley.newRequestQueue(this)

        var list = ArrayList<POrder>()

        val stringRequest = JsonArrayRequest(Request.Method.GET, url, null,
            { response ->

                for (x in 0 until response.length()) {
                    var y = response.getJSONObject(x)
                    list.add(POrder(y.getInt("coffee_id"), y.getString("coffee_name"), 0))
                }

                var adp = POrderAdapter(this, list)
                rv_oac.layoutManager = LinearLayoutManager(this)
                rv_oac.adapter = adp
            },
            { error ->
                volleyErrors += error.message
            })

        queue.add(stringRequest)

        order_button.setOnClickListener {
            var n:Int = list.size
            for (i in 0 until n) {
                var temp:String = rv_oac.findViewHolderForAdapterPosition(i)?.itemView?.findViewById<EditText>(R.id.order_qty)?.text.toString()
                list[i].quantity = 0
                if (!temp.isEmpty()) {
                    list[i].quantity = temp.toInt()
                }
            }

            // post request
            var url1: String = "http://192.168.0.157/php_project/coffee-spot-a/orders/new.php?username=$username"

            val queue1: RequestQueue = Volley.newRequestQueue(this)

            var volleyErrors1: String = ""

            var orderErrors:String = ""

            for (i in 1..n) {
                url1 += "&"
                url1 += "$i="
                url1 += "${list[i - 1].quantity}"
            }

            val stringPRequest = StringRequest(Request.Method.GET, url1,
                { response ->
                    orderErrors += response

                    if (orderErrors == "[]") {
                        orderErrors = "Order Successful"
                        Toast.makeText(this, orderErrors, Toast.LENGTH_LONG).show()
                        val mainMenu = Intent(this, MainMenu::class.java)
                        mainMenu.putExtra("username", username)
                        startActivity(mainMenu)
                    }
                    else {
                        Toast.makeText(this, orderErrors, Toast.LENGTH_LONG).show()
                    }
                },
                { error ->
                    volleyErrors1 += error.message
                })

            queue1.add(stringPRequest)
        }
    }
}