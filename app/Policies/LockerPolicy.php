<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\BaseUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class LockerPolicy
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
    /**
     * Determine whether the user can create models.
     *
     * @param BaseUser $user
     * @return bool
     */
    public function create(BaseUser $user)
    {
        if($user->profile_id === Profile::MASTER_ID) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param BaseUser $user
     * @return bool
     */
    public function updateAny(BaseUser $user)
    {
        if($user->profile_id === Profile::MASTER_ID) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param BaseUser $user
     * @return bool
     */
    public function deleteAny(BaseUser $user)
    {
        if($user->profile_id === Profile::MASTER_ID ) {
            return true;
        }
        return false;
    }
}
