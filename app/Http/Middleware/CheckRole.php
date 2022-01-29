<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $user = Auth::user();



        if ($user->isShopowner() && ($request->route()->getPrefix() =='clients' || $request->route()->getPrefix() =='/clients'
        )) {

            return $next($request);
        }


        if ($user->isRoleCustomer() && 
        ($request->route()->getPrefix() =='me' || $request->route()->getPrefix() =='/me'
            )) {
         
            return $next($request);
        }

      
        
        return redirect()->route('_index_home');
        
    }
}
