<?php

namespace Cms\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Cms\Models\User;
use Cms\Models\Reply;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Reply $reply)
    {
        return $user->may('manage_topics') || $reply->user_id == $user->id;
    }
}
