<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
