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
                 <div class="product-actions">
                    <div class="product-price">$ {{$product->price}}</div>
                    <div class="product-buy-now">Add to cart</div>
                 </div>
            </div> 
         </div>
      </div>
   </div>
</div>
@endsection
