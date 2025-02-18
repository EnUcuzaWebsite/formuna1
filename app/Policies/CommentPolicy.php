<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_comment');
    }

    public function view(User $user, Comment $comment): bool
    {
        return $user->can('view_comment');
    }

    public function create(User $user): bool
    {
        return $user->can('create_comment');
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->can('update_comment');
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->can('delete_comment');
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $user->can('restore_comment');
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->can('force_delete_comment');
    }
}
