<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Size
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Door[] $doors
 * @property-read int|null $doors_count
 * @property-read \App\Models\Locker|null $locker
 * @method static \Database\Factories\SizeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Size newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size newQuery()
 * @method static \Illuminate\Database\Query\Builder|Size onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Size query()
 * @method static \Illuminate\Database\Query\Builder|Size withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Size withoutTrashed()
 * @mixin \Eloquent
 */
class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sizes";

    protected $fillable = [
        'name',
        'description',
    ];

    public function doors()
    {
        return $this->hasMany(Door::class);
    }

    public function locker() {
        return $this->belongsTo(Locker::class);
    }
}
