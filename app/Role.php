<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class Role extends Model
{
    use SoftDeletesBoolean;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'is_deleted', 'permission_type', 'user_id', 'place_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'place_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'permission_type' => 'integer',
        'user_id' => 'integer',
        'place_id' => 'integer',
    ];

    /**
     * Automatically add `created_on` and `updated_on` columns
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Worker's account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Worker's place.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Checks if connection between provided place and user exists.
     *
     * @var string $place_id
     * @var string $author_id
     * @return boolean
     */
    public static function isExists($place_id, $author_id): bool
    {
        return Role::where([
            ['place_id', '=', $place_id],
            ['user_id', '=', $author_id],
        ])->exists();
    }

    /**
     * Checks if the user is assigned to provided place as exact type.
     *
     * @var string $place_id
     * @var string $user_id
     * @return boolean
     */
    public static function isExactExists($place_id, $user_id, $permission_type): bool
    {
        return Role::where([
            ['place_id', $place_id],
            ['user_id', $user_id],
            ['permission_type', $permission_type],
        ])->exists();
    }

    /**
     * Checks if the user is assigned to provided place as employee.
     *
     * @var string $place_id
     * @var string $author_id
     * @return boolean
     */
    public static function isEmployeeOrAdmin($place_id, $author_id): bool
    {
        return Role::where([
            ['place_id', $place_id],
            ['user_id', $author_id],
            ['permission_type', 0],
        ])->exists();
    }

    /**
     * Checks if the user is assigned to provided place as admin.
     *
     * @var string $place_id
     * @var string $author_id
     * @return boolean
     */
    public static function isAdmin($place_id, $author_id): bool
    {
        return Role::where([
            ['place_id', $place_id],
            ['user_id', $author_id],
            ['permission_type', 0],
        ])->exists();
    }
}
