<?php

namespace App\Policies;

use App\Recommendation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecommendationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the recommendation.
     *
     * @param  \App\User  $user
     * @param  \App\Recommendation  $recommendation
     * @return mixed
     */
    public function view(User $user, Recommendation $recommendation)
    {
        return User::isPaymentValid($user) || $user->id === $recommendation->patient_id;
    }

    /**
     * Determine whether the user can create recommendations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return User::isPaymentValid($user);
    }

    /**
     * Determine whether the user can update the recommendation.
     *
     * @param  \App\User  $user
     * @param  \App\Recommendation  $recommendation
     * @return mixed
     */
    public function update(User $user, Recommendation $recommendation)
    {
        return $user->id === $recommendation->author_id || $user->id === $recommendation->patient_id;
    }

    /**
     * Determine whether the user can delete the recommendation.
     *
     * @param  \App\User  $user
     * @param  \App\Recommendation  $recommendation
     * @return mixed
     */
    public function delete(User $user, Recommendation $recommendation)
    {
        return $user->id === $recommendation->author_id;
    }
}
