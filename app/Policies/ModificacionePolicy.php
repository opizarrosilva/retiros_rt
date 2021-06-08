<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Modificacione;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModificacionePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the modificacione can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list modificaciones');
    }

    /**
     * Determine whether the modificacione can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modificacione  $model
     * @return mixed
     */
    public function view(User $user, Modificacione $model)
    {
        return $user->hasPermissionTo('view modificaciones');
    }

    /**
     * Determine whether the modificacione can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create modificaciones');
    }

    /**
     * Determine whether the modificacione can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modificacione  $model
     * @return mixed
     */
    public function update(User $user, Modificacione $model)
    {
        return $user->hasPermissionTo('update modificaciones');
    }

    /**
     * Determine whether the modificacione can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modificacione  $model
     * @return mixed
     */
    public function delete(User $user, Modificacione $model)
    {
        return $user->hasPermissionTo('delete modificaciones');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modificacione  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete modificaciones');
    }

    /**
     * Determine whether the modificacione can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modificacione  $model
     * @return mixed
     */
    public function restore(User $user, Modificacione $model)
    {
        return false;
    }

    /**
     * Determine whether the modificacione can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Modificacione  $model
     * @return mixed
     */
    public function forceDelete(User $user, Modificacione $model)
    {
        return false;
    }
}
