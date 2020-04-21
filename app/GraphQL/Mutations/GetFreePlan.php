<?php

namespace App\GraphQL\Mutations;

use App\Storage as UserStorage;
use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetFreePlan
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();
        $userCanGetFreePlan = $user->paid_until == null;

        if ($userCanGetFreePlan) {
            $user->paid_until = Carbon::now()->addDays(30);
            $user->save();

            $userStorage = UserStorage::where('user_id', $user->id)->first();
            $userStorage->kb_max = $userStorage->kb_max + 100000; // 0.1 GB
            $userStorage->save();

            return [
                "status" => "PLAN_UPDATED",
                "message" => "User plan has been successfully updated.",
            ];
        } else {
            return [
                "status" => "PLAN_NOT_UPDATED",
                "message" => "User password has not been updated.",
            ];
        }
    }
}
