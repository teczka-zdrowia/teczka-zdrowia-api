<?php

namespace App\GraphQL\Mutations;

use App\Mail\UserInitialized;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class InitializeUser
{
    use ValidatesRequests;

    /**
     * Initialize user and send it an email
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
        $generatedPassword = md5(microtime());
        $hashedData = ["password" => Hash::make($generatedPassword)];
        $userData = array_merge($args, $hashedData);

        $user = User::create($userData);
        Mail::to($user)->send(new UserInitialized($user, $generatedPassword));

        return $user;
    }
}
