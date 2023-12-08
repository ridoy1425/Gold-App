<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function getRoleList()
    {
        $roles = Role::orderBy('id')->get();
        return view('role.role-list', compact('roles'));
    }

    public function roleCreate()
    {
        return view('role.role-create');
    }

    public function roleStore(Request $request)
    {
        $validate_data = $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        $validate_data['slug'] = Str::slug($request->name);
        Role::create($validate_data);

        toastr()->success('Success! Role Added Successfully');
        return redirect('role/index');
    }

    public function roleEdit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.role-create', compact('role'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        $role = Role::findOrFail($id);
        $validate_data['slug'] = Str::slug($request->name);
        $role->update($validate_data);

        toastr()->success('Success! Role Updated Successfully');
        return redirect('role/index');
    }

    public function roleDelete($id)
    {
        Role::destroy($id);

        toastr()->success('Success! Role Deleted Successfully');
        return redirect('role/index');
    }

    public function getPermissionList(Request $request)
    {
        $role_id = $request->query('role_id');
        $role = Role::findOrFail($role_id);
        $permissions = Permission::orderBy('id')->get()->groupBy('category');
        return view('role.permission-list', compact('permissions', 'role'));
    }

    public function setPermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->permissions()->sync($request->permissions);

        toastr()->success('Success! Permission Successfully Updated');
        return redirect('role/index');
    }
}
