<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class Place extends Model
{
    use SoftDeletesBoolean;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'is_deleted', 'name', 'address', 'city', 'agreement',
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
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'name' => 'string',
        'address' => 'string',
        'city' => 'string',
        'agreement' => 'string',
    ];

    /**
     * Places's patients
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Role::class)->where('permission_type', 2);
    }

    /**
     * Places's employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Role::class)->where(function ($query) {
            $query->where('permission_type', 0);
            $query->orWhere('permission_type', 1);
        });
    }

    /**
     * Places's appointments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Automatically add `created_on` and `updated_on` columns
     *
     * @var boolean
     */
    public $timestamps = false;
}
