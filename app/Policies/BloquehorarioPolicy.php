<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bloquehorario;
use Illuminate\Auth\Access\HandlesAuthorization;

class BloquehorarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bloquehorario can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list bloquehorarios');
    }

    /**
     * Determine whether the bloquehorario can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bloquehorario  $model
     * @return mixed
     */
    public function view(User $user, Bloquehorario $model)
    {
        return $user->hasPermissionTo('view bloquehorarios');
    }

    /**
     * Determine whether the bloquehorario can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create bloquehorarios');
    }

    /**
     * Determine whether the bloquehorario can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bloquehorario  $model
     * @return mixed
     */
    public function update(User $user, Bloquehorario $model)
    {
        return $user->hasPermissionTo('update bloquehorarios');
    }

    /**
     * Determine whether the bloquehorario can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bloquehorario  $model
     * @return mixed
     */
    public function delete(User $user, Bloquehorario $model)
    {
        return $user->hasPermissionTo('delete bloquehorarios');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bloquehorario  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete bloquehorarios');
    }

    /**
     * Determine whether the bloquehorario can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bloquehorario  $model
     * @return mixed
     */
    public function restore(User $user, Bloquehorario $model)
    {
        return false;
    }

    /**
     * Determine whether the bloquehorario can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bloquehorario  $model
     * @return mixed
     */
    public function forceDelete(User $user, Bloquehorario $model)
    {
        return false;
    }
}
