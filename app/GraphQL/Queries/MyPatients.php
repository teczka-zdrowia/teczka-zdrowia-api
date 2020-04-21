<?php

namespace App\GraphQL\Queries;

use App\Role;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MyPatients
{
    /**
     * Return authenticated user patients
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

        $userPlacesIds = Role::where([
            ['user_id', $user->id],
        ])->orWhere([
            ['permission_type', 0],
            ['permission_type', 1],
        ])->pluck('place_id')->toArray();

        $patientsIds = Role::whereIn('place_id', $userPlacesIds)->pluck('user_id')->toArray();
        $patientsIds = \array_diff($patientsIds, [$user->id]);

        $patients = Role::whereIn('user_id', $patientsIds)->get();

        return $patients;
    }
}
