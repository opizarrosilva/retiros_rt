<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Llamado;
use Illuminate\Auth\Access\HandlesAuthorization;

class LlamadoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the llamado can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list llamados');
    }

    /**
     * Determine whether the llamado can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Llamado  $model
     * @return mixed
     */
    public function view(User $user, Llamado $model)
    {
        return $user->hasPermissionTo('view llamados');
    }

    /**
     * Determine whether the llamado can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create llamados');
    }

    /**
     * Determine whether the llamado can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Llamado  $model
     * @return mixed
     */
    public function update(User $user, Llamado $model)
    {
        return $user->hasPermissionTo('update llamados');
    }

    /**
     * Determine whether the llamado can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Llamado  $model
     * @return mixed
     */
    public function delete(User $user, Llamado $model)
    {
        return $user->hasPermissionTo('delete llamados');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Llamado  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete llamados');
    }

    /**
     * Determine whether the llamado can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Llamado  $model
     * @return mixed
     */
    public function restore(User $user, Llamado $model)
    {
        return false;
    }

    /**
     * Determine whether the llamado can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Llamado  $model
     * @return mixed
     */
    public function forceDelete(User $user, Llamado $model)
    {
        return false;
    }
}
