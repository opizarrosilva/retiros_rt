<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agenda;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgendaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the agenda can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list agendas');
    }

    /**
     * Determine whether the agenda can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agenda  $model
     * @return mixed
     */
    public function view(User $user, Agenda $model)
    {
        return $user->hasPermissionTo('view agendas');
    }

    /**
     * Determine whether the agenda can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create agendas');
    }

    /**
     * Determine whether the agenda can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agenda  $model
     * @return mixed
     */
    public function update(User $user, Agenda $model)
    {
        return $user->hasPermissionTo('update agendas');
    }

    /**
     * Determine whether the agenda can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agenda  $model
     * @return mixed
     */
    public function delete(User $user, Agenda $model)
    {
        return $user->hasPermissionTo('delete agendas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agenda  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete agendas');
    }

    /**
     * Determine whether the agenda can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agenda  $model
     * @return mixed
     */
    public function restore(User $user, Agenda $model)
    {
        return false;
    }

    /**
     * Determine whether the agenda can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Agenda  $model
     * @return mixed
     */
    public function forceDelete(User $user, Agenda $model)
    {
        return false;
    }
}
