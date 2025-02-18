<?php

namespace App\Policies;

use App\Models\UserSuspension;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserSuspensionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_user::suspension');
    }

    public function view(User $user, UserSuspension $userSuspension): bool
    {
        return $user->can('view_user::suspension');
    }

    public function create(User $user): bool
    {
        return $user->can('create_user::suspension');
    }

    public function update(User $user, UserSuspension $userSuspension): bool
    {
        return $user->can('update_user::suspension');
    }

    public function delete(User $user, UserSuspension $userSuspension): bool
    {
        return $user->can('delete_user::suspension');
    }

    public function restore(User $user, UserSuspension $userSuspension): bool
    {
        return $user->can('restore_user::suspension');
    }

    public function forceDelete(User $user, UserSuspension $userSuspension): bool
    {
        return $user->can('force_delete_user::suspension');
    }
}
