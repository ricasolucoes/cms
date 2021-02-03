<?php

namespace Cms\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Cms\Models\Blog\Post;
use Cms\Models\User;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \Cms\Models\User $user
     * @param  \App\Post            $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        if ($post->published) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // admin overrides published status
        if ($user->can('view unpublished posts')) {
            return true;
        }

        // authors can view their own unpublished posts
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \Cms\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \Cms\Models\User $user
     * @param  \App\Post            $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if ($user->can('edit own posts')) {
            return $user->id === $post->user_id;
        }

        if ($user->can('edit all posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \Cms\Models\User $user
     * @param  \App\Post            $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if ($user->can('delete own posts')) {
            return $user->id === $post->user_id;
        }

        if ($user->can('delete any post')) {
            return true;
        }
    }
}
