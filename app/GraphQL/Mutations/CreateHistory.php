<?php

namespace App\GraphQL\Mutations;

use App\History;
use App\Role;
use App\Exceptions\CustomException;
use App\Storage as UserStorage;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateHistory
{
    /**
     * Create history
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\History
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->user();
        $isWorker = Role::isExists($args['place_id'], $user->id);

        if ($isWorker) {
            $file = $args['agreement'];

            if ($file) {
                $filePath = $this->uploadAgreement($args['agreement'], $user->id);
                $args['agreement'] = $filePath;
            } else {
                $args['agreement'] = '';
            }

            return History::create($args);
        } else {
            throw new CustomException(
                'Brak uprawnień'
            );
        }
    }

    /**
     * @var \Illuminate\Http\UploadedFile $file
     * @var string $user_id
     * @return string $path
     */
    public function uploadAgreement($file, $user_id)
    {
        $userStorage = UserStorage::where('user_id', $user_id)->first();
        $path = $userStorage->uploadFile($file);

        return $path;
    }
}
