<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    // add Role
    public function addRole(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            return redirect()->back();
        } else {
            $roles = DB::table('roles')->get();
            $permissions = DB::table('permissions')->get();

            return view('Admin.Role_Permission_Manage.addRole', compact('roles', 'permissions'));
        }
    }
    // Add Permission
    public function addPermission(Request $request)
    {
        if ($request->getMethod() == "POST") {

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->save();
            return redirect()->back()->with('message' , 'Permission Add Successfully');

        } else {
            $roles = DB::table('roles')->get();
            $permissions = DB::table('permissions')->get();
            return view('Admin.Role_Permission_Manage.addRole', compact('roles', 'permissions'));
        }
    }
    public function giveRole(Request $request)
    {
        if ($request->getMethod() == 'POST') {

            $user = User::find($request->user_id);
            if (!$user) {
                return back()->with('error', 'User not found');
            }
            $role = Role::find($request->role_id);
            $permission = Permission::find($request->permission_id);

            if (!$role) {
                return back()->with('error', 'Role not found');
            }
            $user->roles()->syncWithoutDetaching($role);
            $user->permissions()->syncWithoutDetaching($permission);
            return redirect()->back();
        } else {
            $roles = Role::all();
            $permissions = Permission::all();
            $users = DB::table('users')->get();
            $users_permissions = DB::table('users_permissions')->get();
            // dd($users_permissions);

            return view('Admin.Role_Permission_Manage.userwiseroleandpermission', compact('users', 'roles', 'permissions', 'users_permissions'));
        }
    }
    public function assignPerRole(Request $request)
    {

        if ($request->getMethod() == "POST") {
            $role = Role::find($request->role_id);
            if (!$role) {
                return back()->with('error', 'Role not found');
            }

            $permission = Permission::find($request->permission_id);
            if (!$permission) {
                return back()->with('error', 'Permission not found');
            }

            $role->permissions()->syncWithoutDetaching($permission);

            return back()->with('success', 'Permission assigned to role successfully');
        } else {
            $roles = Role::all();
            $permissions = Permission::all();
            return view('Admin.Role_Permission_Manage.assignPermissionToRole', compact('roles', 'permissions'));
        }
    }
}
