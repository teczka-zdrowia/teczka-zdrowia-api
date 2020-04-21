<?php

namespace App\Policies;

use App\Place;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given place data can be viewed by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Place  $place
     * @return bool
     */
    public function view(User $user, Place $place): bool
    {
        return Role::isExists($place->id, $user->id);
    }

    /**
     * Determine if the place can be created by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return User::isPaymentValid($user);
    }

    /**
     * Determine if the place can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Place  $place
     * @return bool
     */
    public function update(User $user, Place $place): bool
    {
        return Role::isAdmin($place->id, $user->id);
    }

    /**
     * Determine if the place can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Place  $place
     * @return bool
     */
    public function delete(User $user, Place $place): bool
    {
        return Role::isAdmin($place->id, $user->id);
    }
}
