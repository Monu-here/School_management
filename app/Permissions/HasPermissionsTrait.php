<?php

namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait
{
    // it will give permission to user  and revok the permission
    // public function givePermissionTo(...$permissions)
    // {
    //     // get permsiion models
    //     //SaveMany ()
    //     $permissions = $this->getAllPermissions($permissions);
    //     if ($permissions === null) {
    //         // return true;
    //         return $this;
    //     }
    //     $this->permissions()->saveMany($permissions);
    //     return $this;
    // }
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }

        // Filter out permissions that the user already has
        $newPermissions = $permissions->diff($this->permissions);

        if ($newPermissions->isNotEmpty()) {
            $this->permissions()->saveMany($newPermissions);
        }

        return $this;
    }
    public function withdrawPermissionTo(...$permissions)
    {
        // get permsiion models
        //SaveMany ()
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            // return true;
            return $this;
        }
        $this->permissions()->detach($permissions);
        return $this;
    }
    public function updatePermissionTo(...$permissions)
    {
        // get permsiion models
        //SaveMany ()
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            // return true;
            return $this;
        }
        $this->permissions()->detach($permissions);
        return $this->givePermissionTo();
    }

    // this will check the role  of a user and return true if it has any
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }


    public function hasPermissionTo($permission)
    {
        // Check if $permission is a string, if so, find the corresponding Permission model
        if (is_string($permission)) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }

        // Now $permission should be an instance of the Permission model
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }
    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    protected function  hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }
    protected function getAllPermissions($permissions)
    {
        // Flatten the nested array
        $permissions = collect($permissions)->flatten()->all();

        // Now you can pass $permissions to whereIn
        return Permission::whereIn('name', $permissions)->get();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }
}
