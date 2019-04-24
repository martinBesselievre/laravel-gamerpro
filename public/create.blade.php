@extends('layouts.gamerhorizon')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-8">
         <div class="card">
            <div class="card-header">
               Add a product
            </div>
            <div class="card-body">
                <form method="POST" action="/products">
                   {{ csrf_field() }}
                   <div class="form-group row">
                       <label for="name" class="col-4 col-form-label text-md-right">
                          Name
                       </label>
                       <div class="col-6">
                           <input id="name" type="text" name="name" value="" required="required" autofocus="autofocus" class="form-control">
                       </div>
                   </div> 
                   <div class="form-group row">
                       <label for="description" class="col-4 col-form-label text-md-right">
                           Description
                       </label>
                       <div class="col-6">
                           <input id="description" type="text" name="description" class="form-control">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="description" class="col-4 col-form-label text-md-right">
                           Price 
                       </label> 
                       <div class="col-6">
                           <input id="price" type="text" name="price" required="required" class="form-control">
                       </div>
                   </div>
                   <div class="form-group row">
                       <label for="url" class="col-4 col-form-label text-md-right">
                           Image 
                       </label> 
                       <div class="col-6">
                           <input id="url" type="text" name="url" required="required" class="form-control">
                       </div>
                   </div>
		   <div class="form-group row">
                       <label for="stock" class="col-4 col-form-label text-md-right">
                          En stock
                       </label>
                       <div class="col-6">
                           <input id="stock" type="text" name="stock" required="required" class="form-control">
                       </div>
                   </div>
                   <div class="form-group row">
                      <div class='col-4'>&nbsp;</div>
                      <div class="col-8">
                          <button type="submit" class="btn btn-primary">
                             Add
                          </button>
                      </div>
                   </div>
                </form>
              </div> 
          </div><!-- End row -->
        </div>
@endsection
