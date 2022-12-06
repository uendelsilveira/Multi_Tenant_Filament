<?php

namespace App\Models;

use App\Models\BaseUser;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

/**
 * App\Models\SystemUser
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser newQuery()
 * @method static \Illuminate\Database\Query\Builder|SystemUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SystemUser withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SystemUser withoutTrashed()
 * @mixin \Eloquent
 */
class SystemUser extends BaseUser
{
    use CentralConnection;
    protected $table = "system_users";
}
