<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\ClientRepository;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Locker
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Door[] $doors
 * @property-read int|null $doors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $sizes
 * @property-read int|null $sizes_count
 * @method static \Database\Factories\LockerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Locker newQuery()
 * @method static \Illuminate\Database\Query\Builder|Locker onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Locker query()
 * @method static \Illuminate\Database\Query\Builder|Locker withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Locker withoutTrashed()
 * @mixin \Eloquent
 */
class Locker extends Model
{
    use HasFactory, SoftDeletes;

    const WAITING_CONFIG = 0;
    const CONFIGURED = 1;

    protected $table = "lockers";

    protected $fillable = [
        'name',
        'serial',
        'last_request_time',
        'configured',
        'description',
        'software_config',
    ];

    public static function findByApiToken(string $bearerToken): Locker | Null {
        $tokenParts = explode(".", $bearerToken);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        $oAuthClientUser = ( new ClientRepository() )->find($jwtPayload['aud'])->user()->first();
        if($oAuthClientUser instanceof Locker)
            return $oAuthClientUser;
        else
            return Null;
    }

    public function doors() {
        return $this->hasMany(Door::class);
    }

    public function sizes(): HasMany {
        return $this->hasMany(Size::class);
    }
}
