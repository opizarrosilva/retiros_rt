<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Estadoagenda;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstadoagendaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the estadoagenda can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list estadoagendas');
    }

    /**
     * Determine whether the estadoagenda can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoagenda  $model
     * @return mixed
     */
    public function view(User $user, Estadoagenda $model)
    {
        return $user->hasPermissionTo('view estadoagendas');
    }

    /**
     * Determine whether the estadoagenda can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create estadoagendas');
    }

    /**
     * Determine whether the estadoagenda can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoagenda  $model
     * @return mixed
     */
    public function update(User $user, Estadoagenda $model)
    {
        return $user->hasPermissionTo('update estadoagendas');
    }

    /**
     * Determine whether the estadoagenda can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoagenda  $model
     * @return mixed
     */
    public function delete(User $user, Estadoagenda $model)
    {
        return $user->hasPermissionTo('delete estadoagendas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoagenda  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete estadoagendas');
    }

    /**
     * Determine whether the estadoagenda can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoagenda  $model
     * @return mixed
     */
    public function restore(User $user, Estadoagenda $model)
    {
        return false;
    }

    /**
     * Determine whether the estadoagenda can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoagenda  $model
     * @return mixed
     */
    public function forceDelete(User $user, Estadoagenda $model)
    {
        return false;
    }
}
