<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable =  ['name', 'description', 'url', 'price', 'stock'];
   public function cart_items()  {
         return $this->belongsToMany('App\CartItems')
                     ->withTimestamps();
   }   
}
