<?php

declare(strict_types=1);

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Model as AppModel;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public const ROLE_SYSTEM = 1;
    public const ROLE_ADMIN = 2;
    public const ROLE_WRITER = 3;

    public const STATUS_INVALID = 0;
    public const STATUS_VALID = 1;

    protected $table = 'users';

    protected $guarded = [
      'id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    private static $sortable = [
        'id',
        'mail_address',
        'user_name',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {

        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {

        return [];
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d: H:i:s');
    }

    public function scopeSortSetting($query, $orderBy, $sortOrder, $defaultKey = 'id')
    {
        return AppModel::commonSortSetting($query, self::$sortable, $orderBy, $sortOrder, $defaultKey);
    }
}
