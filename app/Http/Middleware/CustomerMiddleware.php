<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    private $customer;
    public function __construct(){

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'cus')
    {
        if(!Auth::guard($guard)->check()){
           // return $next($request);  
           return redirect()->route('loginPages')->with('error','Vui lòng đăng nhập');      
        }
        return $next($request); 
        // return redirect()->route('login')->with('error','Bạn chưa đăng nhập');
    }
}
