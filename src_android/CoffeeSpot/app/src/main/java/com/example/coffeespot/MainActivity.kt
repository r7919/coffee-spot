package com.example.coffeespot

import android.annotation.SuppressLint
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.RequestFuture
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import kotlinx.android.synthetic.main.activity_main.*

class MainActivity : AppCompatActivity() {
    @SuppressLint("SetTextI18n")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        login_button.setOnClickListener {
            val username:String = input_text1.text.toString()
            val password:String = input_text2.text.toString()

            var loginErrors:String = ""
            var volleyErrors:String = ""

            val url:String = "http://192.168.0.157/php_project/coffee-spot-a/login.php?username=$username&password=$password"

            val queue:RequestQueue = Volley.newRequestQueue(this)

            val stringRequest = StringRequest(Request.Method.GET, url,
                    { response ->
                        loginErrors += response

                        if (loginErrors == "[]") {
                            loginErrors = "Login Successful"
                            Toast.makeText(this, loginErrors, Toast.LENGTH_LONG).show()
                            val mainMenu = Intent(this, MainMenu::class.java)
                            mainMenu.putExtra("username", username)
                            startActivity(mainMenu)
                        }
                        else {
                            Toast.makeText(this, loginErrors, Toast.LENGTH_LONG).show()
                        }
                    },
                    { error ->
                        volleyErrors += error.message
                    })

            queue.add(stringRequest)
        }

        signup_button.setOnClickListener {
            val register = Intent(this, Register::class.java)
            startActivity(register)
        }
    }
}