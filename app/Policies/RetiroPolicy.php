<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Retiro;
use Illuminate\Auth\Access\HandlesAuthorization;

class RetiroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the retiro can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list retiros');
    }

    /**
     * Determine whether the retiro can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Retiro  $model
     * @return mixed
     */
    public function view(User $user, Retiro $model)
    {
        return $user->hasPermissionTo('view retiros');
    }

    /**
     * Determine whether the retiro can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create retiros');
    }

    /**
     * Determine whether the retiro can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Retiro  $model
     * @return mixed
     */
    public function update(User $user, Retiro $model)
    {
        return $user->hasPermissionTo('update retiros');
    }

    /**
     * Determine whether the retiro can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Retiro  $model
     * @return mixed
     */
    public function delete(User $user, Retiro $model)
    {
        return $user->hasPermissionTo('delete retiros');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Retiro  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete retiros');
    }

    /**
     * Determine whether the retiro can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Retiro  $model
     * @return mixed
     */
    public function restore(User $user, Retiro $model)
    {
        return false;
    }

    /**
     * Determine whether the retiro can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Retiro  $model
     * @return mixed
     */
    public function forceDelete(User $user, Retiro $model)
    {
        return false;
    }
}
