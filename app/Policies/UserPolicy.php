<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('admin.users.index');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo('admin.users.show');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('admin.users.create');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('admin.users.edit');
    }

    public function delete(User $user, User $model): bool
    {
        if ($model->id === $user->id) {
            return false;
        }
        return $user->hasPermissionTo('admin.users.destroy');
    }

    public function assignRoles(User $user): bool
    {
        return $user->hasPermissionTo('admin.users.asignar');
    }

    public function restore(User $user, User $model): bool
    {
        return $user->hasPermissionTo('admin.users.restore');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('admin.users.force-delete');
    }
}
