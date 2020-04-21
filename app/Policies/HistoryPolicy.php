<?php

namespace App\Policies;

use App\History;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the history record can be created by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return User::isPaymentValid($user);
    }

    /**
     * Determine if the given history record can be viewed by the user.
     *
     * @param  \App\User  $user
     * @param  \App\History  $history
     * @return bool
     */
    public function view(User $user, History $history): bool
    {
        return User::hasDoctorPermissions($user) || $history->patient_id === $user->id;
    }

    /**
     * Determine if the given history record can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\History  $history
     * @return bool
     */
    public function update(User $user, History $history): bool
    {
        return $history->author_id === $user->id;
    }

    /**
     * Determine if the given role record can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\History  $history
     * @return bool
     */
    public function delete(User $user, History $history): bool
    {
        return $history->author_id === $user->id;
    }
}
