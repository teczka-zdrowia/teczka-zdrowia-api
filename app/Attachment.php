<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class Attachment extends Model
{
    use SoftDeletesBoolean;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'is_deleted', 'title', 'file_type', 'file_name', 'patient_id', 'author_id', 'history_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'patient_id', 'author_id', 'history_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'title' => 'string',
        'file_type' => 'integer',
        'file_name' => 'string',
        'patient_id' => 'integer',
        'author_id' => 'integer',
        'history_id' => 'integer',
    ];

    /**
     * Attachment's patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Attachment's author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Automatically add `created_on` and `updated_on` columns
     *
     * @var boolean
     */
    public $timestamps = false;
}
