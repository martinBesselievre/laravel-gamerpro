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
                      <div class="game-id">
                         {{$product->id}}
                      </div>
                      <img class="game-img" src="{{$product->url}}" alt="">
                      <div class="game-buy">
                          <div class="game-price">
                              <span class="value">{{$product->price}} €</span>
                          </div>
                          @if ($product->stock > 0)
                          <div class="game-in-stock">
                             In stock
                          </div>
                          <form name="buy-now" method="POST" action="/cart/items">
                               {{csrf_field()}}
                               <input type="hidden" name="product_id" value="{{$product->id}}"/>
                               <!-- PHP button 
                               <button type="submit" class="game-buy-now">
                                  Buy now 
                               </button>
                               -->
                               <button type="button" onclick='addItemToCart(this)' class="game-buy-now">
                                  Buy now
                               </button>
                          </form>
                          @else
                          <div class="game-out-of-stock">
                             Out of stock
                          </div>
                          @endif
                      </div>
                 </div>
                 <a href="/products/{{$product->id}}" alt="Product detail" class="game-description">
                    <span class="game-name">{{$product->description}}</span>
                 </a>
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
