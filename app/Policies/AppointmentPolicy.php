<?php

namespace App\Policies;

use App\Appointment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given appointment can be created by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return User::isPaymentValid($user);
    }

    /**
     * Determine if the given appointment can be viewed by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return bool
     */
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->author_id || $user->id === $appointment->patient_id;
    }

    /**
     * Determine if the given appointment can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return bool
     */
    public function update(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->author_id;
    }

    /**
     * Determine if the given appointment confirmed value can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return bool
     */
    public function updateConfirmed(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->author_id || $user->id === $appointment->patient_id;
    }

    /**
     * Determine if the given appointment can be deleted by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Appointment  $appointment
     * @return bool
     */
    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->author_id || $user->id === $appointment->patient_id;
    }
}
