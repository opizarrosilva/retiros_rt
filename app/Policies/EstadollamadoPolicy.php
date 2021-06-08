<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Estadollamado;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstadollamadoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the estadollamado can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list estadollamados');
    }

    /**
     * Determine whether the estadollamado can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadollamado  $model
     * @return mixed
     */
    public function view(User $user, Estadollamado $model)
    {
        return $user->hasPermissionTo('view estadollamados');
    }

    /**
     * Determine whether the estadollamado can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create estadollamados');
    }

    /**
     * Determine whether the estadollamado can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadollamado  $model
     * @return mixed
     */
    public function update(User $user, Estadollamado $model)
    {
        return $user->hasPermissionTo('update estadollamados');
    }

    /**
     * Determine whether the estadollamado can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadollamado  $model
     * @return mixed
     */
    public function delete(User $user, Estadollamado $model)
    {
        return $user->hasPermissionTo('delete estadollamados');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadollamado  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete estadollamados');
    }

    /**
     * Determine whether the estadollamado can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadollamado  $model
     * @return mixed
     */
    public function restore(User $user, Estadollamado $model)
    {
        return false;
    }

    /**
     * Determine whether the estadollamado can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadollamado  $model
     * @return mixed
     */
    public function forceDelete(User $user, Estadollamado $model)
    {
        return false;
    }
}
