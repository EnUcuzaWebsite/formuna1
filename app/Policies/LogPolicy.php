<?php

namespace App\Policies;

use App\Models\Log;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_log');
    }

    public function view(User $user, Log $log): bool
    {
        return $user->can('view_log');
    }

    public function create(User $user): bool
    {
        return $user->can('create_log');
    }

    public function update(User $user, Log $log): bool
    {
        return $user->can('update_log');
    }

    public function delete(User $user, Log $log): bool
    {
        return $user->can('delete_log');
    }

    public function restore(User $user, Log $log): bool
    {
        return $user->can('restore_log');
    }

    public function forceDelete(User $user, Log $log): bool
    {
        return $user->can('force_delete_log');
    }
}
