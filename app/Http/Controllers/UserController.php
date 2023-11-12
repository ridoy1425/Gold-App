<?php

namespace App\Http\Controllers;

use App\Models\AppraisalCategory;
use App\Models\Branch;
use App\Models\KycInfo;
use App\Models\NomineeInfo;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function storeUserDetails(Request $request)
    {
        try {
            $request->validate([
                'gender_id'         => 'sometimes|required|exists:payloads,id',
                'dob'               => 'sometimes|required|date',
                'occupation'        => 'sometimes|required|string',
                'marital_status_id' => 'sometimes|required|exists:payloads,id',
                'marital_status_id' => 'sometimes|required|exists:payloads,id',
                'profile_image'     => 'sometimes|required|file',
                'kyc_type_id'       => 'sometimes|required|exists:payloads,id',
                'card_number'       => 'sometimes|required|numeric',
                'front_image'       => 'sometimes|required|file',
                'back_image'        => 'sometimes|required|file',
            ]);

            $user = Auth::user();

            $userDetails = UserDetail::create([
                'user_id' => $user->id,
                'gender_id' => $request->gender_id,
                'dob' => $request->dob,
                'occupation' => $request->occupation,
                'marital_status_id' => $request->marital_status_id,
            ]);

            if ($userDetails) {
            }

            $kycInfo = KycInfo::create([
                'user_id' => $user->id,
                'kyc_type_id' => $request->kyc_type_id,
                'card_number' => $request->card_number,
            ]);

            if ($kycInfo) {
            }

            return response()->json([
                'userInfo' => $userDetails,
                'kycInfo' => $kycInfo,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return view('user.user-create', compact('branches', 'roles', 'categories'));
    }

    public function storeNomineeInfo(Request $request)
    {
        $request->validate([
            'name'        => 'sometimes|required|string',
            'phone'       => 'sometimes|required|numeric',
            'dob'         => 'sometimes|required|date',
            'relation_id' => 'sometimes|required|exists:payloads,id',
            'kyc_type_id' => 'sometimes|required|exists:payloads,id',
            'card_number' => 'sometimes|required|numeric',
            'front_image' => 'sometimes|required|file',
            'back_image'  => 'sometimes|required|file',
        ]);

        $user = Auth::user();

        $nominee = NomineeInfo::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'name'        => $request->name,
            'phone'       => $request->phone,
            'dob'         => $request->dob,
            'relation_id' => $request->relation_id,
            'kyc_type_id' => $request->kyc_type_id,
            'card_number' => $request->card_number,
        ]);

        if ($nominee) {
        }

        return response()->json([
            'nominee' => $nominee,
        ], 201);
    }
}
