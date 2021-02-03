<?php

namespace Cms\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Cms\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user)
    {
        return $currentUser->may('manage_users') || $currentUser->id == $user->id;
    }

    public function delete(User $currentUser, User $user)
    {
        return $currentUser->may('manage_users') || $currentUser->id == $user->id;
    }
}
