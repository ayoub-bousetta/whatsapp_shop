<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mediazone extends Model
{
    use HasFactory;


    function medias(){

        return $this->HasMany(Media::class);
    }


    public static function CoverId()
    {
        return (new static)::where('slug','cover')->first()->id;
    }

    public static function ThumbnailId()
{
    return (new static)::where('slug','thumbnail')->first()->id;
}

    function getThumbnailTypeAttribute(){
        return $this->where('slug','thumbnail')->first()->id;
    }

    function getCoverTypeAttribute(){
        return $this->where('slug','cover')->first()->id;
    }
}
