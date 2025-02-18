<?php

namespace App\Policies;

use App\Models\LikedPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LikedPostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_liked::post');
    }

    public function view(User $user, LikedPost $likedPost): bool
    {
        return $user->can('view_liked::post');
    }

    public function create(User $user): bool
    {
        return $user->can('create_liked::post');
    }

    public function update(User $user, LikedPost $likedPost): bool
    {
        return $user->can('update_liked::post');
    }

    public function delete(User $user, LikedPost $likedPost): bool
    {
        return $user->can('delete_liked::post');
    }

    public function restore(User $user, LikedPost $likedPost): bool
    {
        return $user->can('restore_liked::post');
    }

    public function forceDelete(User $user, LikedPost $likedPost): bool
    {
        return $user->can('force_delete_liked::post');
    }
}
