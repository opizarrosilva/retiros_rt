<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Evidencia;
use Illuminate\Auth\Access\HandlesAuthorization;

class EvidenciaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the evidencia can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list evidencias');
    }

    /**
     * Determine whether the evidencia can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Evidencia  $model
     * @return mixed
     */
    public function view(User $user, Evidencia $model)
    {
        return $user->hasPermissionTo('view evidencias');
    }

    /**
     * Determine whether the evidencia can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create evidencias');
    }

    /**
     * Determine whether the evidencia can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Evidencia  $model
     * @return mixed
     */
    public function update(User $user, Evidencia $model)
    {
        return $user->hasPermissionTo('update evidencias');
    }

    /**
     * Determine whether the evidencia can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Evidencia  $model
     * @return mixed
     */
    public function delete(User $user, Evidencia $model)
    {
        return $user->hasPermissionTo('delete evidencias');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Evidencia  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete evidencias');
    }

    /**
     * Determine whether the evidencia can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Evidencia  $model
     * @return mixed
     */
    public function restore(User $user, Evidencia $model)
    {
        return false;
    }

    /**
     * Determine whether the evidencia can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Evidencia  $model
     * @return mixed
     */
    public function forceDelete(User $user, Evidencia $model)
    {
        return false;
    }
}
