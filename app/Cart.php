<?php

namespace App;
use App\CartItem;
use Log;
class Cart
{
    private $items = [];
    private $billing_stotal=0;
    private $billing_tax=0;
    private $billing_total=0; 
    private $payed = false;

    public function __set($property, $value) {
        if ('items' === $property) {
           $this->items =  $value;  
        }
        if ('billing_stotal' === $property) {
           $this->billing_stotal = $value;
        }
        if ('billing_tax' === $property) {
           $this->billing_tax = $value;
        }
        if ('billing_total' === $property) {
           $this->billing_total = $value;
        }
        if ('payed' === $property) {
           $this->payed = $value;
        } 
    }

    public function __get($property) {
       if ('items' === $property) {
           return $this->items;
       }
       if ('billing_stotal' === $property) {
          return $this->billing_stotal;
       }
       if ('billing_tax' === $property) {
          return $this->billing_tax;
       }
       if ('billing_total' === $property) {
          return $this->billing_total;
       }
       if ('payed' === $property) {
          return $this->payed;
       }
    } 

    public function count() {
        $count = 0;
        foreach ($this->items as $item) {
            $count = $count + $item->quantity;
        }
        return $count;
    }
 
    public function add_item($item) {
       array_push($this->items, $item);
       $item->product->stock = $item->product->stock - $item->quantity;
       $item->product->save();
       $this->calc_totals();
    }

    private function calc_totals() {
       $id = 0;
       $this->billing_stotal = 0;
       foreach ($this->items as $item) {
         $id = $id + 1;
         $item->id = $id;
         $this->billing_stotal = $this->billing_stotal + ($item->product->price * $item->quantity);
       }
       $this->billing_tax = $this->billing_stotal * 0.2;
       $this->billing_total = $this->billing_stotal + $this->billing_tax;
    }

    public function remove_item($id) {
       foreach ($this->items  as $key => $item) {
           if ($item->id == $id) {
              $item->product->stock = $item->product->quantity + $item->quantity;
              $item->product->save();
              unset($this->items[$key]);  
              break;  
           }
       }
       $this->calc_totals(); 
    }
}
