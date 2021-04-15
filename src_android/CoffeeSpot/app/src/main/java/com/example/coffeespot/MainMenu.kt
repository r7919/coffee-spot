package com.example.coffeespot

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import kotlinx.android.synthetic.main.activity_main_menu.*

class MainMenu : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main_menu)

        var username:String = intent.getStringExtra("username").toString()

        oac_button.setOnClickListener {
            val orderACoffee = Intent(this, OrderACoffee::class.java)
            orderACoffee.putExtra("username", username)
            startActivity(orderACoffee)
        }

        orders_button.setOnClickListener {
            val showUserOrders = Intent(this, ShowUserOrders::class.java)
            showUserOrders.putExtra("username", username)
            startActivity(showUserOrders)
        }

        logout_button.setOnClickListener {
            Toast.makeText(this, "Log out Successful", Toast.LENGTH_LONG).show()
            val mainActivity = Intent(this, MainActivity::class.java)
            startActivity(mainActivity)
        }
    }
}