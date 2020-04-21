<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage as Storage;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use \Image;

class UpdateMe
{
    use ValidatesRequests;

    /**
     * Update authenticated user
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

        if (array_key_exists('avatar', $args)) {

            $userAvatar = $user->avatar;
            if ($userAvatar !== '') {
                $this->deleteAvatar($userAvatar);
            }

            $image = $args['avatar'];
            $path = $image->hashName('avatars');
            $compressedImage = Image::make($image);
            $compressedImage->fit(300, 300)->encode();

            $fileName = $this->uploadAvatar($compressedImage, $path);
            $args['avatar'] = $fileName;
        }

        $user->update($args);
        return $user;
    }

    /**
     * @param string $userAvatar
     * @return mixed
     */
    public function deleteAvatar(string $userAvatar)
    {
        $avatarPath = 'avatars/' . $userAvatar;
        Storage::disk('public')->delete($avatarPath);
    }

    /**
     * @param \Image $newUserAvatar
     * @param string $path
     * @return string $fileName
     */
    public function uploadAvatar($newUserAvatar, $path)
    {
        $storagePath = Storage::disk('public')->put($path, $newUserAvatar);
        $fileName = basename($path);
        return $fileName;
    }
}
