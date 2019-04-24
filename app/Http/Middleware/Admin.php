<?php

namespace App\Http\Middleware;

use Closure;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->role == 'admin') {
           return $next($request); 
        }
        else {
           $message = 'Access to this page requires admin rights';
           $alert = 'alert alert-error'; 
           return redirect()->route('catalog.index')->with('message',$message)->with('alert', $alert);
        }
    }
}
