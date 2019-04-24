<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'billing_stotal', 'billing_tax', 'billing_total'];

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }

}
