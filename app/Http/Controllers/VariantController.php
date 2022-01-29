<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function get_products_var($shopId,$product_id)
    {
           

        $Variant = Variant::with('options')->where('product_id',$product_id)
        ->whereHas('product.shop', function($q) use($shopId){
            $q->where('shops.id', $shopId);
        })->get();


      
            if(request()->wantsJson()){

                return $Variant;
            }


    }

   
}
