<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
       
        'name',
        'slug','country_id'
    ];


    function country(){

        return $this->belongsTo(Country::class,'country_id');
    }




}
