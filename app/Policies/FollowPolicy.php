<?php

namespace App\Policies;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FollowPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_follow');
    }

    public function view(User $user, Follow $follow): bool
    {
        return $user->can('view_follow');
    }

    public function create(User $user): bool
    {
        return $user->can('create_follow');
    }

    public function update(User $user, Follow $follow): bool
    {
        return $user->can('update_follow');
    }

    public function delete(User $user, Follow $follow): bool
    {
        return $user->can('delete_follow');
    }

    public function restore(User $user, Follow $follow): bool
    {
        return $user->can('restore_follow');
    }

    public function forceDelete(User $user, Follow $follow): bool
    {
        return $user->can('force_delete_follow');
    }
}
