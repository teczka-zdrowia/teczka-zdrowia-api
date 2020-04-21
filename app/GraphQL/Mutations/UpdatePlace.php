<?php

namespace App\GraphQL\Mutations;

use App\Place;
use App\Storage as UserStorage;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UpdatePlace
{
    /**
     * Update place
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
        $place = Place::find($args["id"]);

        if (array_key_exists('agreement', $args)) {
            $uploadedAgreement = $args['agreement'];
            $presentAgreement = $place->agreement;

            $uploadedAgreementIsFile = $uploadedAgreement instanceof UploadedFile;
            $uploadedAgreementIsEmpty = $uploadedAgreement == "";

            if ($uploadedAgreementIsEmpty) {
                $this->deleteAgreement($presentAgreement);
                $args['agreement'] = "";
            }

            if ($uploadedAgreementIsFile) {
                $filePath = $this->uploadAgreement($uploadedAgreement, $user);
                $args['agreement'] = $filePath;
                $this->deleteAgreement($presentAgreement);
            }
        }

        $place->update($args);
        return $place;
    }

    /**
     * @param string $agreement
     * @param User $user
     * @return mixed
     */
    public function deleteAgreement($agreement, $user)
    {
        $agreementPath = 'files/' . $agreement;
        $fileExists = Storage::disk('public')->exists($agreementPath);
        if ($fileExists) {
            Storage::disk('public')->delete($agreementPath);
        };
    }

    /**
     * @param mixed $agreement
     * @param User $user
     * @return string $filePath
     */
    public function uploadAgreement($agreement, $user)
    {
        $userStorage = UserStorage::where('user_id', $user->id)->first();
        $fileName = $userStorage->uploadFile($agreement);
        $filePath = $user->id . '/' . $fileName;
        return $filePath;
    }
}
