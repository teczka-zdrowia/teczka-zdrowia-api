<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage as StorageFacade;

class Storage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'kb_used', 'kb_max',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'kb_used' => 'integer',
        'kb_max' => 'integer',
    ];

    /**
     * Automatically add `created_on` and `updated_on` columns
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * User's account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Uploads provided file to user directory
     *
     * @var \Illuminate\Http\UploadedFile $file
     * @return string $fileName
     */
    public function uploadFile($file): string
    {
        $fileSize = $file->getSize();
        // Operate on kilobytes
        $fileSize = $fileSize / 1000;
        $storageUsed = $this->kb_used;
        $storageMax = $this->kb_max;
        $storageUsedAfterFileUpload = $fileSize + $storageUsed;

        if ($storageUsedAfterFileUpload < $storageMax) {
            $this->increment('kb_used', $fileSize);
            $userId = $this->user->id;
            $path = $file->store('files/' . $userId, 'public');
            $fileName = basename($path);
            return $fileName;
        } else {
            throw new \Exception('File size exceeds user limit');
        }
    }

    /**
     * Deletes provided file from user directory
     *
     * @var string $fileName
     * @return bool
     */
    public function deleteFile($fileName): bool
    {
        $userId = $this->user->id;
        $filePath = 'files/' . $userId . '/' . $fileName;
        $fileExists = StorageFacade::disk('public')->exists($filePath);

        if ($fileExists) {
            $fileSize = StorageFacade::disk('public')->size($filePath);
            $fileSize = $fileSize / 1000; // Convert to kilobytes

            StorageFacade::disk('public')->delete($filePath);
            $this->decrement('kb_used', $fileSize);

            return true;
        } else {
            throw new \Exception('File does not exists');
        }
    }
}
