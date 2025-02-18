<?php

namespace App\Policies;

use App\Models\SavedPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SavedPostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_saved::post');
    }

    public function view(User $user, SavedPost $savedPost): bool
    {
        return $user->can('view_saved::post');
    }

    public function create(User $user): bool
    {
        return $user->can('create_saved::post');
    }

    public function update(User $user, SavedPost $savedPost): bool
    {
        return $user->can('update_saved::post');
    }

    public function delete(User $user, SavedPost $savedPost): bool
    {
        return $user->can('delete_saved::post');
    }

    public function restore(User $user, SavedPost $savedPost): bool
    {
        return $user->can('restore_saved::post');
    }

    public function forceDelete(User $user, SavedPost $savedPost): bool
    {
        return $user->can('force_delete_saved::post');
    }
}
