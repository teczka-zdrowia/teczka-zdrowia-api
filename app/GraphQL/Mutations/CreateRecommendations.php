<?php

namespace App\GraphQL\Mutations;

use App\History;
use App\Exceptions\CustomException;
use App\Recommendation;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateRecommendations
{
    /**
     * Create recommendation
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\Recommendation
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $history = History::where([
            ['id', '=', $args['history_id']],
            ['author_id', '=', $args['author_id']],
        ])->first();

        if ($history) {

            $recommendations = $args['data'];
            $recommendationsData = [];

            foreach ($recommendations as $recommendation) {
                $recommendation = array_merge($recommendation, [
                    'history_id' => $history->id,
                    'patient_id' => $history->patient_id,
                    'author_id' => $history->author_id,
                ]);

                array_push($recommendationsData, $recommendation);
            }

            return $history->recommendations()->createMany($recommendationsData);
        } else {
            throw new CustomException(
                'Ta historia nie istnieje'
            );
        }
    }
}
