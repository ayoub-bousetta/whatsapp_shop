<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;


    protected $fillable = [
        'name','additional_amount','variant_id'
       
    ];

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
        
    }
}
