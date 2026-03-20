<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('admin.roles.index');
    }

    public function view(User $user, Role $model): bool
    {
        return $user->hasPermissionTo('admin.roles.show');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('admin.roles.create');
    }

    public function update(User $user, Role $model): bool
    {
        if ($model->name === 'Super Admin') {
            return false;
        }
        return $user->hasPermissionTo('admin.roles.edit');
    }

    public function delete(User $user, Role $model): bool
    {
        if ($model->name === 'Super Admin') {
            return false;
        }
        return $user->hasPermissionTo('admin.roles.destroy');
    }
}
