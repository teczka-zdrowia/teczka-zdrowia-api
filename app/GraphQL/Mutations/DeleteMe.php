<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Storage as StorageFacade;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DeleteMe
{
    /**
     * Delete authenticated user
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\User
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();
        $password = $args['password'];

        $deleteAllFiles = filter_var($args['delete_all_files'], FILTER_VALIDATE_BOOLEAN);

        if (Hash::check($password, $user['password'])) {
            if ($deleteAllFiles) {
                StorageFacade::deleteDirectory('files/' . $user->id);
            }

            $user->delete();
            return $user;
        } else {
            throw new CustomException(
                'Hasło niepoprawne'
            );
        }
    }
}
