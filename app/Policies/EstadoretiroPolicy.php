<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Estadoretiro;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstadoretiroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the estadoretiro can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list estadoretiros');
    }

    /**
     * Determine whether the estadoretiro can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoretiro  $model
     * @return mixed
     */
    public function view(User $user, Estadoretiro $model)
    {
        return $user->hasPermissionTo('view estadoretiros');
    }

    /**
     * Determine whether the estadoretiro can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create estadoretiros');
    }

    /**
     * Determine whether the estadoretiro can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoretiro  $model
     * @return mixed
     */
    public function update(User $user, Estadoretiro $model)
    {
        return $user->hasPermissionTo('update estadoretiros');
    }

    /**
     * Determine whether the estadoretiro can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoretiro  $model
     * @return mixed
     */
    public function delete(User $user, Estadoretiro $model)
    {
        return $user->hasPermissionTo('delete estadoretiros');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoretiro  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete estadoretiros');
    }

    /**
     * Determine whether the estadoretiro can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoretiro  $model
     * @return mixed
     */
    public function restore(User $user, Estadoretiro $model)
    {
        return false;
    }

    /**
     * Determine whether the estadoretiro can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Estadoretiro  $model
     * @return mixed
     */
    public function forceDelete(User $user, Estadoretiro $model)
    {
        return false;
    }
}
