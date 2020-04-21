<?php

namespace App\GraphQL\Mutations;

use App\Attachment;
use App\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DeleteAttachment
{
    /**
     * Delete attachment
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\Attachment
     *@throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $attachment = Attachment::find($args['id']);

        $user = $context->user();
        $userStorage = Storage::where('user_id', $user->id)->first();
        $userStorage->deleteFile($attachment->file_name);

        $attachment->delete();
        return $attachment;
    }
}
