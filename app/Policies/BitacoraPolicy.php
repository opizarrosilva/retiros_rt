<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bitacora;
use Illuminate\Auth\Access\HandlesAuthorization;

class BitacoraPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bitacora can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list bitacoras');
    }

    /**
     * Determine whether the bitacora can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bitacora  $model
     * @return mixed
     */
    public function view(User $user, Bitacora $model)
    {
        return $user->hasPermissionTo('view bitacoras');
    }

    /**
     * Determine whether the bitacora can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create bitacoras');
    }

    /**
     * Determine whether the bitacora can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bitacora  $model
     * @return mixed
     */
    public function update(User $user, Bitacora $model)
    {
        return $user->hasPermissionTo('update bitacoras');
    }

    /**
     * Determine whether the bitacora can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bitacora  $model
     * @return mixed
     */
    public function delete(User $user, Bitacora $model)
    {
        return $user->hasPermissionTo('delete bitacoras');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bitacora  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete bitacoras');
    }

    /**
     * Determine whether the bitacora can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bitacora  $model
     * @return mixed
     */
    public function restore(User $user, Bitacora $model)
    {
        return false;
    }

    /**
     * Determine whether the bitacora can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bitacora  $model
     * @return mixed
     */
    public function forceDelete(User $user, Bitacora $model)
    {
        return false;
    }
}
