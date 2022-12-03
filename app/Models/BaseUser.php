<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\BaseUser
 *
 * @property int $id
 * @property string $name
 * @property int $profile_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|BaseUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|BaseUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BaseUser withoutTrashed()
 */
class BaseUser extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'profile_id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
