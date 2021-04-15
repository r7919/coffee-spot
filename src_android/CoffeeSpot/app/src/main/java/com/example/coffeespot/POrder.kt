package com.example.coffeespot

import android.text.Editable
import android.widget.EditText

class POrder {
    var id:Int
    var coffeeName:String
    var quantity:Int


    constructor(id:Int, coffeeName:String, quantity:Int) {
        this.id = id
        this.coffeeName = coffeeName
        this.quantity = quantity
    }
}