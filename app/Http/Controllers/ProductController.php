<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use URL;
use Session;
class ProductController extends Controller 
{


    /*
     * Get the Products collection
     * Get the Cart from session
     * Display the Catalog view
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(12);
        //Normal users
        if (Session::has('cart')) {
           $cart = session('cart');
           if ($cart->payed) {
              $cart->payed = false;
              $cart->items = [];
           }
           return view('products.index',compact('products', 'cart'));
        }
        //Admin user
        return view('products.index',compact('products'));
    }

    /* 
     * Returns the Products collection
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $products = Product::all();
        return $products;
    }
    /*
    * Display Product detail page
    * @param  $id
    * @return \Illuminate\Http\Response 
    */
    public function show($id) {
        $product = Product::find($id);
        return view('products.detail', compact('product'));
    }

    /*
     * Display the Products collection
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $product = new Product();
       $action=URL::route('product.store');
       $mode='create';
       $message='';
       $alert='alert-none';
       $disabled='';
       return view('products.create',compact('product','action','mode','message','alert','disabled'));
    }

    public function store(Request $request) {
       $product = new Product();
       $product->name = $request['name'];
       $product->description = $request['description'];
       $product->price = $request['price'];
       $product->url = $request['url'];
       $product->stock = $request['stock'];
       $product->save();
       $id = $product->id;
       $mode='edit';
       $message = 'Product successfully added';
       $alert='alert-success';
       $disabled='disabled';
       $action=URL::route('product.update', [ 'id' => $id] );
      
       return view('products.create',compact('product','action','mode', 'message','alert','disabled'));
    }
    
    public function edit(Request $request, $id) {
       $product = Product::find($id);
       $mode = 'edit';
       $message='';
       $alert='alert-none';
       $disabled='disabled';
       $action=URL::route('product.update', ['id' => $id]);
       return view('products.create',compact('product','action','mode', 'message','alert','disabled'));
    }
 
    public function update(Request $request, $id) {
       $product = Product::find($id);
       $stock= $request['stock'];
       $product->stock=$stock;
       $product->save();
       $message='Product successfully updated';
       $alert='alert-success';
       $mode='edit';
       $action=URL::route('product.update', ['id' => $id]);
       $disabled='disabled';
       return view('products.create',compact('product','action', 'message', 'alert','mode', 'disabled'));
    }
   
    public function users() {
       $connected_users= count(Session::all());
       return $connected_users;
    } 

    public function orders() {
       $orders = Order::orderBy('billing_total', 'DESC')->take(5)->get();
       return $orders; 
    }

 
}
