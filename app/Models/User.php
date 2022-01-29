<?php

namespace App\Models;

use App\Http\Requests\AdresseRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
       
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    function shops(){

        return   $this->hasMany(Shop::class);
     }

     function profile(){

        return   $this->hasOne(Profile::class,'user_id');
     }


     function adresses(){

        return   $this->hasMany(Adresse::class,'user_id');
     }


     public function roles()
     {
        
         return $this->belongsToMany(Role::class);
     }




     //Add roles here if you have more
    function isRoleSupperAdmin()
    {
       
        return $this->roles->first()->slu==="admin";
    }
    
    function isRoleCustomer()
        {
            return $this->roles->first()->slug==="customer";
        }

        function isShopowner()
        {
        
            return $this->roles->first()->slug==="owner";
        }


}
