<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('admin.permissions.index');
    }

    public function view(User $user, Permission $model): bool
    {
        return $user->hasPermissionTo('admin.permissions.show');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('admin.permissions.create');
    }

    public function update(User $user, Permission $model): bool
    {
        return $user->hasPermissionTo('admin.permissions.edit');
    }

    public function delete(User $user, Permission $model): bool
    {
        return $user->hasPermissionTo('admin.permissions.destroy');
    }
}
