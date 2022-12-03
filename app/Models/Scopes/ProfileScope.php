<?php

namespace App\Models\Scopes;

use App\Models\Profile;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileScope implements Scope
{
    use AuthorizesRequests;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();
        if($user->profile_id === Profile::MASTER_ID)
            return;

        if($user->profile_id === Profile::ADMIN_ID) {
            $builder->where('profile_id', '!=', Profile::MASTER_ID);
            return;
        }

        $builder->where('id', Auth::user()->id);
    }
}
