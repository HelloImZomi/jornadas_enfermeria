<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class InscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the inscription can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list inscriptions');
    }

    /**
     * Determine whether the inscription can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inscription  $model
     * @return mixed
     */
    public function view(User $user, Inscription $model)
    {
        return $user->hasPermissionTo('view inscriptions');
    }

    /**
     * Determine whether the inscription can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create inscriptions');
    }

    /**
     * Determine whether the inscription can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inscription  $model
     * @return mixed
     */
    public function update(User $user, Inscription $model)
    {
        return $user->hasPermissionTo('update inscriptions');
    }

    /**
     * Determine whether the inscription can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inscription  $model
     * @return mixed
     */
    public function delete(User $user, Inscription $model)
    {
        return $user->hasPermissionTo('delete inscriptions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inscription  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete inscriptions');
    }

    /**
     * Determine whether the inscription can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inscription  $model
     * @return mixed
     */
    public function restore(User $user, Inscription $model)
    {
        return false;
    }

    /**
     * Determine whether the inscription can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Inscription  $model
     * @return mixed
     */
    public function forceDelete(User $user, Inscription $model)
    {
        return false;
    }
}
