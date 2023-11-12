<?php

namespace App\Http\Controllers;

use App\Models\AppraisalCategory;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUserList()
    {
        $users = User::latest()->get();
        return view('user.user-list', compact('users'));
    }

    public function userCreate()
    {
        $roles = Role::all();
        return view('user.user-create', compact('branches', 'roles', 'categories'));
    }

    public function userStore(Request $request)
    {
        $validate_data = $this->validate($request, [
            'employee_id' => 'required|exists:employee_infos,id',
            'user_name'   => 'required|string',
            'password'    => 'required|confirmed|min:4',
            'expire_date' => 'required',
            'role_id'     => 'required|exists:roles,id',
        ]);

        $validate_data['password'] = Hash::make($request->password);
        $validate_data['expire_date'] = date('Y-m-d', strtotime($validate_data['expire_date']));
        User::create($validate_data);

        return redirect('user/index')->with('success', 'Successfully Added');
    }

    public function userEdit($id)
    {
        return view('user.user-create');
    }

    public function userUpdate(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'employee_id' => 'required|exists:employee_infos,id',
            'user_name'   => 'required|string',
            'expire_date' => 'required',
            'role_id'     => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update($validate_data);
        if ($request->password) {
            $validate_data = $this->validate($request, [
                'password'    => 'required|confirmed|min:4',
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect('user/index')->with('success', 'Successfully Updated');
    }

    public function userDelete($id)
    {
        User::destroy($id);
        return redirect('user/index')->with('error', 'Successfully Deleted');
    }

    public function getKycData()
    {
        $users = User::latest()->get();
        return view('kyc.index', compact('users'));
    }

    public function getKycEdit($id)
    {
        return view('kyc.edit');
    }
}
