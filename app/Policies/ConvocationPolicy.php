<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Convocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConvocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the convocation can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list convocations');
    }

    /**
     * Determine whether the convocation can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convocation  $model
     * @return mixed
     */
    public function view(User $user, Convocation $model)
    {
        return $user->hasPermissionTo('view convocations');
    }

    /**
     * Determine whether the convocation can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create convocations');
    }

    /**
     * Determine whether the convocation can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convocation  $model
     * @return mixed
     */
    public function update(User $user, Convocation $model)
    {
        return $user->hasPermissionTo('update convocations');
    }

    /**
     * Determine whether the convocation can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convocation  $model
     * @return mixed
     */
    public function delete(User $user, Convocation $model)
    {
        return $user->hasPermissionTo('delete convocations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convocation  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete convocations');
    }

    /**
     * Determine whether the convocation can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convocation  $model
     * @return mixed
     */
    public function restore(User $user, Convocation $model)
    {
        return false;
    }

    /**
     * Determine whether the convocation can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Convocation  $model
     * @return mixed
     */
    public function forceDelete(User $user, Convocation $model)
    {
        return false;
    }
}
