<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\BaseUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoorPolicy
{
    use HandlesAuthorization;

    /**
    * @param BaseUser $user
    * @return bool
    */
   public function viewIndex(BaseUser $user)
   {
        if(tenant() === null) {
            return false;
        }
        if($user->profile_id === Profile::MASTER_ID || $user->profile_id === Profile::ADMIN_ID) {
            return true;
        }
        return false;
   }
}
