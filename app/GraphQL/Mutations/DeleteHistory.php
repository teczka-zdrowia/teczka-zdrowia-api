<?php

namespace App\GraphQL\Mutations;

use App\History;
use DeleteAttachment;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DeleteHistory
{
    /**
     * Delete history and all it's components
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $history = History::find($args['id']);

        $history->recommendations()->delete();
        $attachments = $history->attachments();
        foreach ($attachments as $attachment) {
            DeleteAttachment::resolve($rootValue, ['id' => $attachment->id], $context, $resolveInfo);
        }
        $history->delete();

        return $history;
    }
}
