<?php

namespace App\Http\Controllers;

use App\Models\AppraisalCategory;
use App\Models\Branch;
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
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        return view('role.role-create', compact('branches', 'categories'));
    }

    public function roleStore(Request $request)
    {
        $validate_data = $this->validate($request, [
            'role_name'           => 'required|unique:roles,role_name',
            'display_name'        => 'required|unique:roles,display_name',
            'branch_id'           => 'required|exists:branches,id',
        ]);

        $validate_data['role_slug'] = Str::slug($request->role_name);
        Role::create($validate_data);

        return redirect('role/index')->with('success', 'Successfully Added');
    }

    public function roleEdit($id)
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $role = Role::findOrFail($id);
        return view('role.role-create', compact('branches', 'role', 'categories'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'role_name' => 'required|unique:roles,role_name,' . $id . ',id',
            'display_name'        => 'required|unique:roles,display_name,' . $id . ',id',
            'branch_id'           => 'required|exists:branches,id',
        ]);

        $role = Role::findOrFail($id);
        $role->update($validate_data);

        return redirect('role/index')->with('success', 'Successfully Updated');
    }

    public function userDelete($id)
    {
        Role::destroy($id);
        return redirect('role/index')->with('error', 'Successfully Deleted');
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

        return redirect('role/index')->with('success', 'Permission Successfully Updated');
    }
}
