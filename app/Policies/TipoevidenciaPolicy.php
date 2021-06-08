<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tipoevidencia;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipoevidenciaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tipoevidencia can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list tipoevidencias');
    }

    /**
     * Determine whether the tipoevidencia can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tipoevidencia  $model
     * @return mixed
     */
    public function view(User $user, Tipoevidencia $model)
    {
        return $user->hasPermissionTo('view tipoevidencias');
    }

    /**
     * Determine whether the tipoevidencia can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create tipoevidencias');
    }

    /**
     * Determine whether the tipoevidencia can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tipoevidencia  $model
     * @return mixed
     */
    public function update(User $user, Tipoevidencia $model)
    {
        return $user->hasPermissionTo('update tipoevidencias');
    }

    /**
     * Determine whether the tipoevidencia can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tipoevidencia  $model
     * @return mixed
     */
    public function delete(User $user, Tipoevidencia $model)
    {
        return $user->hasPermissionTo('delete tipoevidencias');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tipoevidencia  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete tipoevidencias');
    }

    /**
     * Determine whether the tipoevidencia can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tipoevidencia  $model
     * @return mixed
     */
    public function restore(User $user, Tipoevidencia $model)
    {
        return false;
    }

    /**
     * Determine whether the tipoevidencia can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Tipoevidencia  $model
     * @return mixed
     */
    public function forceDelete(User $user, Tipoevidencia $model)
    {
        return false;
    }
}
