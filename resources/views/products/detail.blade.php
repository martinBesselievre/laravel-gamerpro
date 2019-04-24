@extends('layouts.gamerhorizon')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-8" column>
         <h1 class='title-section'>
            Product detail 
         </h1>
         <div class="product">
            <div class="product-left">
               <div class="product-image">
                  <img src="/{{$product->url}}"/> 
               </div> 
            </div>
            <div class="product-right">
                 <div class="product-detail">
                     <div class="product-name">{{$product->name}}</div>
                     <div class="product-description">{{$product->description}}</div>
                 </div>
                 <div class="product-price">$ {{$product->price}}</div>
                 <div class="product-actions">
                   <button onclick="window.location='/catalog'" class='btn btn-primary width-8'>Back</button>
                   <form method="POST" action="/cart">
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="1">
                        <button class='btn btn-primary color-buy width-8'>
                          Buy now
                        </button>
                   </form> 
                 </div>
            </div> 
         </div>
      </div>
   </div>
</div>
@endsection
