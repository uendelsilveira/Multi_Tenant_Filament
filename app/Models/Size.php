<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
