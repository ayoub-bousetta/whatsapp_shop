<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
       
        'name',
        'slug',
    ];


    function cities(){

        return $this->hasMany(City::class,'country_id');
    }


 




}
