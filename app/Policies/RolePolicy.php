<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the role record can be created by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return User::isPaymentValid($user);
    }

    /**
     * Determine if the given role record can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function update(User $user, Role $role): bool
    {
        return Role::isEmployeeOrAdmin($role->place_id, $user->id);
    }

    /**
     * Determine if the given role record can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return bool
     */
    public function delete(User $user, Role $role): bool
    {
        return Role::isAdmin($role->place_id, $user->id);
    }
}
