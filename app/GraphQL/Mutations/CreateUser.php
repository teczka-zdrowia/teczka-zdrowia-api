<?php

namespace App\GraphQL\Mutations;

use App\Storage as UserStorage;
use App\Exceptions\CustomException;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateUser
{
    /**
     * Create user
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\User
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {

        $rulesAccepted = filter_var($args['rules_accepted'], FILTER_VALIDATE_BOOLEAN);

        if ($rulesAccepted) {
            $args['password'] = Hash::make($args['password']);
            $user = User::create($args);
            UserStorage::create(['user_id' => $user->id]);

            return $user;
        } else {
            throw new CustomException(
                'Musisz zaakceptować regulamin'
            );
        }
    }
}
