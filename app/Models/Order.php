<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[ 'user_id',
    'method_id' ,
    'subtotal',
    'total','status_id','shop_id','id_items',
    'data','qty','unit_price','currency','name',
    'adresse_id'];



    function shop(){

        return $this->belongsTo(Shop::class);
    }

        function status(){

            return $this->belongsTo(Status::class);
        }
}
