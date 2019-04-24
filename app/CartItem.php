<?php

namespace App;

class CartItem
{
    private $id;
    private $product;
    private $quantity;
    private $price; 

    public function __get($property) {
        if ('id' === $property) {
           return $this->id;
        }
        if ('product' === $property) {
           return $this->product;
        }
        if ('quantity' === $property) {
           return $this->quantity;
        }
        if ('price' === $property) {
           return $this->price;
        }
    }

    public function __set($property, $value) {
        if ('id' ===  $property) {
           $this->id = $value;
        }
        if ('product' === $property) {
            $this->product = $value;
        }
        if ('quantity' === $property) {
            $this->quantity = $value;
        }
        if ('price' === $property) {
            $this->price = $value;
        }
    }   
    
    public function __toString()
    {
        return json_encode($this);
    } 
 
}
