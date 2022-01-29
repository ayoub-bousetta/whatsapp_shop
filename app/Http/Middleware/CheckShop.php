<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckShop
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



        if(isset($request->idShop) && $request->idShop != ""){

            $shopexists=Shop::where('user_id',Auth::user()->id)->where('id',$request->idShop)->get();


            if(!$shopexists->isEmpty()){

                $request->attributes->set('shopid',$shopexists->first()->id);
                $request->attributes->set('shopSlug',$shopexists->first()->slug);
             
            return $next($request);

            }else{
                abort(404); 
            }


        }

        return $next($request);
       
       
    }
}
