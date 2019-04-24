@extends('layouts.gamerhorizon')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-10">
         <h1 class='title-section'>
            Catalog
         </h1>
         <div class="gallery-pagination">
            {{ $products->links() }}
         </div>
         <div class="game-gallery">
             @foreach ($products as $product)
             <div class="game-item">
                 <div class="game-vignette">
                      <img class="game-img" src="{{$product->url}}" alt="">
                      <div class="game-buy">
                          <div class="game-price">
                              <span class="value">{{$product->price}} €</span>
                          </div>
                          <div class="game-buy-now">
                              Buy now
                          </div>
                      </div>
                 </div>
                 <div class="game-description">
                      <a href="/products/{{$product->id}}" alt="Product detail">
                          <span class="game-name">{{$product->description}}</span>
                      </a>
                 </div>
             </div>
             @endforeach
         </div>
         <div class="gallery-pagination">
            {{ $products->links() }}
         </div>
      </div>
   </div>
</div>
@endsection
