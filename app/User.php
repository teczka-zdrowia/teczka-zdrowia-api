<?php

namespace App;

use App\Notifications\CustomPasswordReset;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Webkid\LaravelBooleanSoftdeletes\SoftDeletesBoolean;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletesBoolean;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password', 'pesel', 'name', 'specialization', 'email', 'phone', 'address', 'is_deleted', 'paid_until', 'avatar', 'rules_accepted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'pesel',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'password' => 'string',
        'pesel' => 'string',
        'name' => 'string',
        'specialization' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'is_deleted' => 'boolean',
        'paid_until' => 'datetime',
        'avatar' => 'string',
        'rules_accepted' => 'string',
    ];

    /**
     * Automatically add `created_on` and `updated_on` columns
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * User birthdate from PESEL
     *
     * @return string
     */
    public static function birthdate(User $user): string
    {
        list($year, $month, $day) = sscanf($user->pesel, '%02s%02s%02s');
        switch (substr($month, 0, 1)) {
            case 2:
            case 3:
                $month -= 20;
                $year += 2000;
                break;
            case 4:
            case 5:
                $month -= 40;
                $year += 2100;
            case 6:
            case 7:
                $month -= 60;
                $year += 2200;
                break;
            case 8:
            case 9:
                $month -= 80;
                $year += 1800;
                break;
            default:
                $year += 1900;
                break;
        }

        return checkdate($month, $day, $year)
        ? "$year-$month-$day"
        : "";
    }

    /**
     * Does user payment for doctors' permissions valid
     *
     * @return bool
     */
    public static function isPaymentValid(User $user): bool
    {
        $now = new \DateTime('now');
        $paidUntil = new \DateTime($user->paid_until);
        return $paidUntil > $now && is_null($user->paid_until) === false;
    }

    /**
     * Does user has doctor permissions
     *
     * @return bool
     */
    public static function hasDoctorPermissions(User $user): bool
    {
        return !is_null($user->paid_until);
    }

    /**
     * User's recommendations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class, "patient_id");
    }

    /**
     * User's histories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class, "patient_id");
    }

    /**
     * User's appointments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, "patient_id");
    }

    /**
     * User's roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    /**
     * User's storage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function storage(): HasOne
    {
        return $this->hasOne(Storage::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }
}
