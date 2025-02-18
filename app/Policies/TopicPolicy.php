<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TopicPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_topic');
    }

    public function view(User $user, Topic $topic): bool
    {
        return $user->can('view_topic');
    }

    public function create(User $user): bool
    {
        return $user->can('create_topic');
    }

    public function update(User $user, Topic $topic): bool
    {
        return $user->can('update_topic');
    }

    public function delete(User $user, Topic $topic): bool
    {
        return $user->can('delete_topic');
    }

    public function restore(User $user, Topic $topic): bool
    {
        return $user->can('restore_topic');
    }

    public function forceDelete(User $user, Topic $topic): bool
    {
        return $user->can('force_delete_topic');
    }
}
