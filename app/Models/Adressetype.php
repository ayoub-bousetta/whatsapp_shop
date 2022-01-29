<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adressetype extends Model
{
    use HasFactory;




    public $timestamps = false;

    protected $fillable = [
       
        'name',
        'slug',
    ];


    function adresses(){

        return   $this->hasMany(Adresse::class,'adressetype_id');
     }
} 
