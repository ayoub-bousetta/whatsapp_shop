<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $fillable = [
       
        'city_id',
        'country_id',
    ];



    function adresse(){

        return   $this->belongsTo(Adresse::class,'location_id');
     }



     
}
