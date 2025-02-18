<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_report');
    }

    public function view(User $user, Report $report): bool
    {
        return $user->can('view_report');
    }

    public function create(User $user): bool
    {
        return $user->can('create_report');
    }

    public function update(User $user, Report $report): bool
    {
        return $user->can('update_report');
    }

    public function delete(User $user, Report $report): bool
    {
        return $user->can('delete_report');
    }

    public function restore(User $user, Report $report): bool
    {
        return $user->can('restore_report');
    }

    public function forceDelete(User $user, Report $report): bool
    {
        return $user->can('force_delete_report');
    }
}
