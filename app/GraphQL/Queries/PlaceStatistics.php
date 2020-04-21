<?php

namespace App\GraphQL\Queries;

use App\Appointment;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PlaceStatistics
{
    /**
     * Return statistics of place
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $fromDate = $args['date']['from'];
        $toDate = $args['date']['to'];

        $appointmentsCount = Appointment::whereBetween('date', [$fromDate, $toDate])
            ->where('place_id', $args['id'])
            ->count();

        $appointmentsPatients = Appointment::whereBetween('date', [$fromDate, $toDate])
            ->where('place_id', $args['id'])
            ->select('patient_id', \DB::raw('count(*) as total'))
            ->groupBy('patient_id')
            ->pluck('total', 'patient_id')
            ->all();

        $workersActions = Appointment::whereBetween('date', [$fromDate, $toDate])
            ->where('place_id', $args['id'])
            ->select('author_id', \DB::raw('count(*) as total'))
            ->groupBy('author_id')
            ->pluck('total', 'author_id')
            ->all();

        $workersActionsCounts = array_count_values($workersActions);
        arsort($workersActionsCounts);
        $mostActiveWorkerId = array_keys($workersActionsCounts)[0];

        $mostActiveWorker = User::find($mostActiveWorkerId);

        $appointmentsPatientsCount = count($appointmentsPatients);

        return [
            "patients_count" => $appointmentsPatientsCount,
            "appointments_count" => $appointmentsCount,
            "most_active_worker" => $mostActiveWorker,
        ];
    }
}
