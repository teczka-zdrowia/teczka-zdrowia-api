<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UpdatePassword
{
    /**
     * Update password
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();
        $old_password = $args['data']['password'];
        $new_password = $args['data']['new_password'];

        $response = $this->changePassword($user, $old_password, $new_password);

        if ($response) {
            return [
                'status' => 'PASSWORD_UPDATED',
                'message' => 'User password has been successfully updated.',
            ];
        }

        return [
            'status' => 'PASSWORD_NOT_UPDATED',
            'message' => 'User password has not been updated.',
        ];
    }

    /**
     * Changes the given user's password if provided is correct
     *
     * @param  \Illuminate\Foundation\Auth\User  $user
     * @param  string  $password
     * @return void
     */
    protected function changePassword($user, $old_password, $new_password)
    {
        if (Hash::check($old_password, $user['password'])) {
            $user['password'] = Hash::make($new_password);

            return $user->save();
        }
    }
}
