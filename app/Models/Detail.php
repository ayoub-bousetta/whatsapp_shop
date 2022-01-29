<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute','value'
       
    ];




    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
        
    }
}
