<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Door
 *
 * @property-read \App\Models\Locker|null $locker
 * @property-read \App\Models\Size|null $size
 * @method static \Database\Factories\DoorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Door newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Door newQuery()
 * @method static \Illuminate\Database\Query\Builder|Door onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Door query()
 * @method static \Illuminate\Database\Query\Builder|Door withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Door withoutTrashed()
 * @mixin \Eloquent
 */
class Door extends Model
{
    protected $table = "doors";
    protected $fillable = [
        'number',
        'status',
        'locker_id',
        'size_id'
    ];
    use HasFactory, SoftDeletes;

    const STATUS_OCCUPIED = 'OCUPADA';
    const STATUS_EMPTY = 'LIVRE';
    const STATUS_BLOCKED = 'BLOQUEADA';

    public static function statusArray(): array
    {
        return [Door::STATUS_OCCUPIED, Door::STATUS_EMPTY, Door::STATUS_BLOCKED, ];
    }

    public function locker()
    {
        return $this->belongsTo((Locker::class));
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
