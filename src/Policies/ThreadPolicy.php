<?php

namespace Cms\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Cms\Models\User;
use Facilitador\Models\Messenger\Thread;
use Gate;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Thread $thread)
    {
        return $thread->hasParticipant($user->id);
    }
}
