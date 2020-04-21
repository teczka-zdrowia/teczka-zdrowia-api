<?php

namespace App\Policies;

use App\Attachment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the recommendation.
     *
     * @param  \App\User  $user
     * @param  \App\Attachment  $attachment
     * @return mixed
     */
    public function view(User $user, Attachment $attachment)
    {
        return User::isPaymentValid($user) || $user->id === $attachment->patient_id;
    }

    /**
     * Determine whether the user can create attachment.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return User::isPaymentValid($user);
    }

    /**
     * Determine whether the user can update the attachment.
     *
     * @param  \App\User  $user
     * @param  \App\Attachment  $attachment
     * @return mixed
     */
    public function update(User $user, Attachment $attachment)
    {
        return $user->id === $attachment->author_id || $user->id === $attachment->patient_id;
    }

    /**
     * Determine whether the user can delete the attachment.
     *
     * @param  \App\User  $user
     * @param  \App\Attachment  $attachment
     * @return mixed
     */
    public function delete(User $user, Attachment $attachment)
    {
        return $user->id === $attachment->author_id;
    }
}
