@extends('layouts.gamerhorizon')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-8">
         <div id="alert" class='row alert {{$alert}}'>
            <span id="message">
               {{$message}}
            </span>
         </div>
         <div class="card">
            <div class="card-header">
               @if ($mode === 'create')
               Add product
               @else 
               Update product
               @endif 
            </div>
            <div class="card-body">
                <form method="POST" action="{{$action}}">
                   {{ csrf_field() }}
                   @if ($mode === 'edit')
                   {{ method_field('PATCH')}}
                   @endif
                   <div class="form-group row">
                       <label for="name" class="col-4 col-form-label text-md-right">
                          Name
                       </label>
                       <div class="col-6">
                           @if($action  === 'create')
                           <input id="name" type="text" name="name" value="{{$product->name}}" {{$disabled}} required="required" autofocus="autofocus"  class="form-control">
                           @else
                           <input id="name" type="text" name="name" value="{{$product->name}}" {{$disabled}} required="required" class="form-control">
                           @endif
                       </div>
                   </div> 
                   <div class="form-group row">
                       <label for="description" class="col-4 col-form-label text-md-right">
                           Description
                       </label>
                       <div class="col-6">
                           <input id="description" type="textarea" rows="3" name="description" value='{{$product->description}}' required='required' {{$disabled}} class="form-control">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="description" class="col-4 col-form-label text-md-right">
                           Price 
                       </label> 
                       <div class="col-6">
                           <input id="price" type="text" name="price" required="required" value='{{$product->price}}' {{$disabled}} class="form-control">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="url" class="col-4 col-form-label text-md-right">
                           Image 
                       </label> 
                       <div class="col-6">
                           <input id="url" type="text" name="url" required="required" value='{{$product->url}}' {{$disabled}} class="form-control">
                       </div>
                   </div>
		   <div class="form-group row">
                       <label for="stock" class="col-4 col-form-label text-md-right">
                          En stock
                       </label>
                       <div class="col-6">
                           @if ($mode === 'create')
                           <input id="stock" type="text" name="stock" required="required" value='{{$product->stock}}' class="form-control">
                           @else
                           <input id="stock" type="text" name="stock" required="required" value='{{$product->stock}}' autofocus="autofocus"  class="form-control">
                           @endif
                       </div>
                   </div>
                   <div class="form-group row">
                      @if ($mode === 'create')
                      <div class='col-6'>&nbsp;</div>
                      <div class="col-6 row justify-content-start">
                          <button type="submit" class="btn btn-primary width-8">
                              Add
                          </button>
                      </div>
                      @else
                      <div class="col-6">
                          <button type="button" onclick="document.location.href='/admin'" class="btn btn-primary width-8">
                              New 
                          </button>
                      </div>
                      <div class="col-6 row justify-content-start">
                          <button type="submit" class="btn btn-primary width-8" onfocus="document.getElementById('alert').className='row alert no-alert';document.getElementById('message').innerHTML='';">
                             Update 
                          </button>
                      </div>
                      @endif
                   </div>
                </form>
              </div>
          </div>
        </div>
   </div><!--End row-->
   <div class="row">
      <div class="col-12">
         <div class="row justify-content-space-between">
            <div class="col-3">
               <div class="card">
                  <div class="card-header block">
                     Connected users
                  </div>
                  <div class="card-body users">
                  </div>
               </div>
            </div>

            <div class="col-3">
               <div class="card">
                  <div class="card-header block">
                     Higher orders 
                  </div>
                  <div class="card-body orders">
                  </div>
               </div>
            </div>
            <div class="col-3">
               <div class="card">
                  <div class="card-header block">
                     Block3
 
                  </div>
                  <div class="card-body">
                  </div>
               </div>
            </div>

         </div>
      </div> 
   </div>
</div><!-- End container-->
<script>
<!--Load block1 data-->
$.ajax({url: "{{ route('admin.users')}}",
   success: function(data) {
     console.log(data);
     elements = document.getElementsByClassName("card-body users");
     elements[0].innerText = data;
     console.log(elements.length);
   }
});
<!--Load block1 data-->
$.ajax({url: "{{ route('admin.orders')}}",
   success: function(data) {
     elements = document.getElementsByClassName("card-body orders");
     for (var i=0; i<data.length; i++) {
       var order = data[i];
       console.log(i, order["billing_total"]);
     }
   }
});
</script>
@endsection
