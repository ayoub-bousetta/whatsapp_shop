<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;



    protected $fillable=['name','slug','url','user_id',
    'mediable_id','mediable_type','mediazone_id'];



    public function mediazonetype()
    {
        return $this->belongsTo(Mediazone::class,"mediazone_id");
    }

    public function mediable()
    {
        return $this->morphTo();
    }


  


    



    public function getCreatedAtAttribute($date)
    {   

        return Carbon::parse($date)->format('d m Y H:i:s');
    }
}
