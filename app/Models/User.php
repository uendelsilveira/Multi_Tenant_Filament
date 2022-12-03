<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseUser
{
    use HasFactory;

    protected $table = "users";
}
