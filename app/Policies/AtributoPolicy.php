<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Atributo;
use Illuminate\Auth\Access\HandlesAuthorization;

class AtributoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the atributo can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list atributos');
    }

    /**
     * Determine whether the atributo can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Atributo  $model
     * @return mixed
     */
    public function view(User $user, Atributo $model)
    {
        return $user->hasPermissionTo('view atributos');
    }

    /**
     * Determine whether the atributo can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create atributos');
    }

    /**
     * Determine whether the atributo can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Atributo  $model
     * @return mixed
     */
    public function update(User $user, Atributo $model)
    {
        return $user->hasPermissionTo('update atributos');
    }

    /**
     * Determine whether the atributo can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Atributo  $model
     * @return mixed
     */
    public function delete(User $user, Atributo $model)
    {
        return $user->hasPermissionTo('delete atributos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Atributo  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete atributos');
    }

    /**
     * Determine whether the atributo can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Atributo  $model
     * @return mixed
     */
    public function restore(User $user, Atributo $model)
    {
        return false;
    }

    /**
     * Determine whether the atributo can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Atributo  $model
     * @return mixed
     */
    public function forceDelete(User $user, Atributo $model)
    {
        return false;
    }
}
