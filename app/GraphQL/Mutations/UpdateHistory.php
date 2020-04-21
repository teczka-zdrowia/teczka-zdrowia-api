<?php

namespace App\GraphQL\Mutations;

use App\History;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UpdateHistory
{
    use ValidatesRequests;

    /**
     * Update history
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
        $history = History::find($args['id']);
        $history->update($args['data']);
        return $history;
    }
}
