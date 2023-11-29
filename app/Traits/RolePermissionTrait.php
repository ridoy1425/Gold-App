<?php

namespace App\Traits;

trait RolePermissionTrait
{

    public function hasRole($role)
    {
        return $this->role->slug === $role;
    }

    public function hasPermission($permission)
    {
        $permissions = $this->role->permissions;
        if ($permissions && $permissions->contains('slug', $permission)) {
            return true;
        }

        return false;
    }
}
