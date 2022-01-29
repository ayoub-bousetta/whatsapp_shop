<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'summary',
        'shop_id',
        'type_id',
        'unit_price',
        'online',
        'seo_description',
        'online',
        'sku','section_id'
    ];




    function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }

    function section(){
            return $this->belongsTo(Section::class,'section_id');
        }

    function type(){
        return $this->belongsTo(Type::class,'type_id');
    }
    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
        
    }


    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id');
        
    }


    public function details()
    {
        return $this->hasMany(Detail::class, 'product_id');
        
    }


}
