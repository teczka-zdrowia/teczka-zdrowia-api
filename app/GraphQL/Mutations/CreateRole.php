<?php

namespace App\GraphQL\Mutations;

use App\Role;
use App\User;
use App\Exceptions\CustomException;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateRole
{
    /**
     * Create role
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\Role
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();

        if (!Role::isExists($args['place_id'], $user->id)) {
            throw new CustomException(
                'Brak uprawnień'
            );
        }

        if (Role::isExactExists($args['place_id'], $args['user_id'], $args['permission_type'])) {
            throw new CustomException(
                'Użytkownik już został dodany'
            );
        }

        return Role::create($args);
    }
}
