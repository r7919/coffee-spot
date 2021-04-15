package com.example.coffeespot

class Order {
    var id:Int
    var coffeeName:String
    var quantity:Int

    constructor(id:Int, coffeeName:String, quantity:Int) {
        this.id = id
        this.coffeeName = coffeeName
        this.quantity = quantity
    }
}