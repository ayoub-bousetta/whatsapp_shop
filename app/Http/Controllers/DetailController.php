<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_products_details($shopId,$product_id)
    {
        

        $details = Detail::where('product_id',$product_id)
        ->whereHas('product.shop', function($q) use($shopId){
            $q->where('shops.id', $shopId);
        })->get();


      
            if(request()->wantsJson()){

                return $details;
            }


    }

  
}
