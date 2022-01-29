<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;


    
    protected $fillable = [
       
        'name',
        'slug',
        'shop_id'
    ];


    function products(){
        return $this->hasMany(Product::class,'section_id');
    }


}
