<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\ClientRepository;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locker extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_WAITING_CONFIG = 0;
    const STATUS_CONFIGURED = 1;

    protected $table = "lockers";

    protected $fillable = [
        'name',
        'serial',
        'last_request_time',
        'status',
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
