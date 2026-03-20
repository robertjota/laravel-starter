<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool|null
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }
        return null;
    }

    public function viewActivities(User $user): bool
    {
        return $user->hasPermissionTo('admin.audits.activities');
    }

    public function viewAccessLogs(User $user): bool
    {
        return $user->hasPermissionTo('admin.audits.access-logs');
    }
}
