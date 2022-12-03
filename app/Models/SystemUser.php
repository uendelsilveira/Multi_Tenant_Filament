<?php

namespace App\Models;

use App\Models\BaseUser;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class SystemUser extends BaseUser
{
    use CentralConnection;
    protected $table = "system_users";
}
