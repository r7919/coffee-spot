package com.example.coffeespot

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import kotlinx.android.synthetic.main.activity_main.*
import kotlinx.android.synthetic.main.activity_register.*

class Register : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)

        signup_buttonr.setOnClickListener {
            var username:String = input_textr1.text.toString()
            var password:String = input_textr2.text.toString()
            val confirmPassword:String = input_textr3.text.toString()

            var registerErrors:String = ""
            var volleyErrors:String = ""

            val url:String = "http://192.168.0.157/php_project/coffee-spot-a/register.php?username=$username&password=$password&confirm_password=$confirmPassword"

            val queue: RequestQueue = Volley.newRequestQueue(this)

            val stringRequest = StringRequest(
                Request.Method.GET, url,
                { response ->
                    registerErrors += response

                    if (registerErrors == "[]") {
                        registerErrors = "Sign up Successful"
                        Toast.makeText(this, registerErrors, Toast.LENGTH_LONG).show()
                        val mainActivity = Intent(this, MainActivity::class.java)
                        startActivity(mainActivity)
                    }
                    else {
                        Toast.makeText(this, registerErrors, Toast.LENGTH_LONG).show()
                    }
                },
                { error ->
                    volleyErrors += error.message
                })

            queue.add(stringRequest)

        }
    }
}