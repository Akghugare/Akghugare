<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class SessionIdentifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        if(($path == "/" || $path == "registration") && Session::get('name')){
            return redirect()->route('Dashboard');
        }
        // if(!Session::get('name')){
            // print_r(Session::all());exit;
        //     if($path == "/" || $path == "registration"){

        //     }else{
        //         return redirect()->route('/');
        //     }
        // }
            // echo Session::get('name');
        // if(!Session::get('name') && $path != "/" && $path == "registration"){
        //     return redirect()->route('/');
        // }elseif(!Session::get('name') && $path == "/" && $path != "registration"){ 
        //     return redirect()->route('/');
        // }elseif(!Session::get('name')){
        //     return redirect()->route('/');
        // }

        return $next($request);
    }
}