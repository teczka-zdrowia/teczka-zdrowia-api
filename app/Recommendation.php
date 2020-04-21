<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class Recommendation extends Model
{
    use SoftDeletesBoolean;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'is_deleted', 'title', 'description', 'start_date', 'days', 'history_id', 'patient_id', 'author_id',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
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
        'description' => 'string',
        'start_date' => 'date',
        'days' => 'integer',
        'patient_id' => 'integer',
        'author_id' => 'integer',
        'history_id' => 'integer',
    ];

    /**
     * Automatically add `created_on` and `updated_on` columns
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Recommendation's patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Recommendation's author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
