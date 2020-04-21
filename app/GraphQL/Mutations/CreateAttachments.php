<?php

namespace App\GraphQL\Mutations;

use App\Attachment;
use App\History;
use App\Exceptions\CustomException;
use App\Storage as UserStorage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateAttachments
{
    /**
     * Create attachment
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \App\Attachment
     * @throws \Joselfonseca\LighthouseGraphQLPassport\Exceptions\ValidationException
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $history = History::where([
            ['id', '=', $args['history_id']],
            ['author_id', '=', $args['author_id']],
        ])->first();

        if ($history) {
            $attachments = $args['data'];
            $attachmentsData = [];

            foreach ($attachments as $attachment) {
                $file = $attachment['file'];
                $fileType = $this->getAttachmentType($file->getClientOriginalExtension());
                $filePath = $this->uploadAttachment($file, $args['author_id']);

                $attachment = [
                    'title' => $attachment['title'],
                    'file_type' => $fileType,
                    'file_name' => $filePath,
                    'history_id' => $history->id,
                    'patient_id' => $history->patient_id,
                    'author_id' => $history->author_id,
                ];

                array_push($attachmentsData, $attachment);
            }

            return $history->attachments()->createMany($attachmentsData);
        } else {
            throw new CustomException(
                'Ta historia nie istnieje'
            );
        }
    }

    /**
     * Return a value of the file type
     *
     * @var string $fileExtension
     * @return int
     */
    public function getAttachmentType($fileExtension)
    {
        $extenstions = [
            "IMAGE" => ['gif', 'jpg', 'jpeg', 'png'],
            "VIDEO" => ['mov', 'mp4', '3gp', 'ogg'],
            "DOCUMENT" => ['pdf', 'docx', 'odt', 'txt'],
            "COMPRESSED" => ['zip', '7zip', 'rar', 'gz'],
        ];

        $extenstionNumber = 0;
        foreach ($extenstions as $type => $typeExtenstions) {
            if (\in_array($fileExtension, $typeExtenstions)) {
                return $extenstionNumber;
            }
            $extenstionNumber++;
        }

        return count($extenstions);
    }

    /**
     * @var \Illuminate\Http\UploadedFile $file
     * @var string $user_id
     * @return string $path
     */
    public function uploadAttachment($file, $user_id)
    {
        $userStorage = UserStorage::where('user_id', $user_id)->first();
        $path = $userStorage->uploadFile($file);

        return $path;
    }
}
