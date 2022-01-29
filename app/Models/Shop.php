<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    

    protected $fillable = [

        'name',
            'slug',
            'description',
            'adresse',
            'lat',
            'lng',
            'phone','category_id',
            'whatsapp_number',
            'seo_description',
            'online',
            'currency_id',
            'city_id',
            'user_id',


    ];

    function orders(){

        return $this->hasMany(Order::class);
    }
    
 function category(){

        return $this->belongsTo(Category::class,'category_id');
    }

    function city(){

        return $this->belongsTo(City::class,'city_id');
    }


    function products(){
        return $this->hasMany(Product::class,'shop_id');
    }


    function user(){

     return   $this->belongsTo(User::class,'user_id');
    }

    function currency(){

        return   $this->belongsTo(Currency::class,'currency_id');
       }

       function sections(){

        return   $this->hasMany(Section::class,'shop_id');
       }

    
    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
        
    }
}
