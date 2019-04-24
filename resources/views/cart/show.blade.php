@extends('layouts.gamerhorizon')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-6" column>
         <div id="alert" class='row alert {{$alert}}'>
            <span id="message">
               {{$message}}
            </span>
         </div>
         <h1 class='title-section'>
            Cart detail 
         </h1>
         <div class='cart column'>
             @foreach ($cart->items as $item)
             <div class='cart-item row'>
                <div class='cart-item-img'>
                    <img src="/{{ $item->product->url }}"> 
                </div>
                <div class="cart-item-name">
                    {{$item->product->name}}
                </div>
                <div class="cart-item-price">
                    <span class='label'>$</span><span class='value'>{{$item->product->price}}</span>
                </div>
                <div class="cart-item-remove">
                    <form method="POST" action="/cart/items/{{$item->id}}">
                       {{ csrf_field() }}
                       {{ method_field('DELETE') }} 
                       <button type="submit">
                            <i class="fa fa-trash"></i>
                       </button> 
                    </form>
                </div>
             </div>  
             @endforeach 
             <!--Javascript cart-->
            <div id="row" class='cart-item row'>
                <div class='cart-item-img'>
                    <img src="">
                </div>
                <div class="cart-item-name">
                </div>
                <div class="cart-item-price">
                    <span class='label'>$</span><span class='value'></span>
                </div>
                <div class="cart-item-remove">
                    <button type="submit">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
             </div>
         </div>            
         <!--if ($cart->count() == 0)-->
         <div class="cart-empty">
             You have no item in your cart
         </div>
         <!--else-->
         <div class='cart-totals colum'>
            <div class='cart-total row'>
               <div class='cart-total-label'>
                  Subtotal : 
               </div>
               <div class="cart-total-value">
                  <span class='label'>$</span><span class='value'>{{number_format($cart->billing_stotal,2)}}</span>
               </div>
            </div>
            <div class='cart-total row'>
               <div class='cart-total-label'>
                  Tax :
               </div>
               <div class="cart-total-value">
                  <span class='label'>$</span><span class='value'>{{number_format($cart->billing_tax,2)}}</span>
               </div>
            </div>
            <div class='cart-total row'>
               <div class='cart-total-label'>
                  Total :  
               </div>
               <div class="cart-total-value">
                  <span class='label'>$</span><span class='value'>{{number_format($cart->billing_total,2)}}</span>
               </div>
            </div>
         </div>
         <!--endif-->
         <div class='cart-actions row'>
             <button onclick="location.replace('{{ route('catalog.index') }}')"  class='btn btn-primary width-8'>
                Back
             </button>
             <!--if (($cart->count() > 0) && (!$cart->payed))-->
             <form method='POST' action="/cart/pay">
                {{ csrf_field() }}
                <!--PHP button 
                <button type="submit" class='btn btn-primary width-8'>
                   Pay
                </button>
                -->
                <button onclick="payCart()" type="button" class='btn btn-primary width-8'>
                   Pay
                </button>
                <input type="hidden" name="cart" value="">
             </form>
             <!--endif-->
          </div>
      </div>
    
   </div>
</div>
@endsection
