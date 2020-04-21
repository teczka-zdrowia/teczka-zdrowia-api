<?php

namespace App\GraphQL\Mutations;

use App\Place;
use App\Role;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreatePlace
{
    /**
     * Create place
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\Place
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();
        $place = Place::create($args);
        $this->createAuthorRole($user, $place);

        return $place;
    }

    /**
     * @param App\User $user
     * @param App\Place $place
     * @return App\Role
     */
    public function createAuthorRole(User $user, Place $place)
    {
        $roleData = [
            'permission_type' => 0,
            'user_id' => $user->id,
            'place_id' => $place->id,
        ];

        return Role::create($roleData);
    }
}
