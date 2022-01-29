<?php

namespace App\Policies;

use App\Models\User;
use App\Models\shop;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function showone(User $user, shop $shop)
    {
        return $user->id == $shop->user_id ? Response::allow()
        : Response::deny('You do not own this Shop.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user,Shop $shop)
    {
      
        return $user->id == $shop->user_id ? Response::allow()
        : Response::deny('You do not own this Shop.');
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, shop $shop)
    {

       
        return $user->id == $shop->user_id ? Response::allow()
        : Response::deny('You do not own this Shop.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, shop $shop)
    {
        return $user->id == $shop->user_id ? Response::allow()
        : Response::deny('You do not own this Shop.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, shop $shop)
    {
        //
    }
}
