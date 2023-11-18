<?php

namespace App\Policies;

use App\Models\AreaProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaProductPolicy
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
        return $user->can('area-product index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AreaProduct $areaProduct)
    {
        return $user->can('area-product show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('area-product create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AreaProduct $areaProduct)
    {
        return $user->can('area-product update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AreaProduct $areaProduct)
    {
        return $user->can('area-product delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AreaProduct $areaProduct)
    {
        return $user->can('area-product delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AreaProduct $areaProduct)
    {
        return $user->can('area-product delete');
    }
}
