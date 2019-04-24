<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;
use App\Order;
use App\OrderItem;
use Auth;
use Log;
class CartController extends Controller 
{
    /*
     * Display Cart detail page 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cart = session('cart');
        $message = '';
        $alert = 'no-alert';
        return view('cart.show', compact('cart', 'message', 'alert'));
    }
    
    /*
     * Add product to the current user cart
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request['product_id'];
        $product = Product::find($product_id);
        $cart = session('cart');
        
        $item = new CartItem();
        $item->product = $product;
        $item->quantity = 1;
        $cart->add_item($item);
        $message = '';
        $alert = 'no-alert';
        return view('cart.show', compact('cart', 'message', 'alert')); 
    }

    /*
     * Remove product to the current user cart
     * @return \Illuminate\Http\Response
     */
     public function delete(Request $request, $id) {
         $cart = session('cart');
         $cart->remove_item($id);
         $message = '';
         $alert = 'no-alert';
         return view('cart.show', compact('cart' , 'alert', 'message'));
    }


    /* Cart checkout */
    public function pay() {
        $user=Auth::user();
        $cart = session('cart');
        $order = new Order();
        $order->user_id = $user->id;
        $order->billing_stotal = $cart->billing_stotal;
        $order->billing_tax = $cart->billing_tax;
        $order->billing_total = $cart->billing_total;
        $order->save();
        $order_id= $order->id;
        foreach ($cart->items as $item) {
           $order_item  = new OrderItem();
           $order_item->product_id = $item->product->id;
           $order_item->quantity = $item->quantity;
           $order->items()->save($order_item);
        }
        $message = 'Your payment was successful';
        $alert = 'alert-success';
        $cart->payed = true;
        return view('cart.show', compact('cart','message','alert'));
    }
}
