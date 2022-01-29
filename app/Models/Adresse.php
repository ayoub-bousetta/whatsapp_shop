<?php

namespace App\Models;

use App\Policies\LocationPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;


    protected $fillable = [
       
        'adresse',
        'zip_code',
        'location_id',
        'user_id',
        'adressetype_id'
    ];


    function user(){

        return   $this->belongsTo(User::class,'user_id');
     }


     function type(){

        return   $this->belongsTo(Adressetype::class,'adressetype_id');
     }

     function location(){

        return   $this->belongsTo(Location::class,'location_id');
     }
}
