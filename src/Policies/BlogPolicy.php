<?php

namespace Cms\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Cms\Models\User;
use Cms\Models\Blog;
use Gate;

class BlogPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Blog $blog)
    {
        return $user->isAuthorOf($blog);
    }

    public function manage(User $user, Blog $blog): bool
    {
        return $blog->managers()->where('user_id', $user->id)->count() > 0;
    }

    public function createArticle(User $user, Blog $blog): bool
    {
        return $user->isAuthorOf($blog) || Gate::allows('manage', $blog);
    }
}
