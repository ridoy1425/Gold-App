<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\KycInfo;
use App\Models\NomineeInfo;
use App\Models\User;
use App\Models\UserDetail;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use AttachmentTrait;

    public function getUserList()
    {
        $users = User::latest()->get();
        return view('user.user-list', compact('users'));
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('user.user-create', compact('user'));
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

        toastr()->success('Success! Data Updated!');
        return redirect('user/index');
    }

    public function userDelete($id)
    {
        User::destroy($id);
        toastr()->success('Success! Data Deleted!');
        return redirect('user/index');
    }

    public function getKycData()
    {
        $kycInfo = KycInfo::latest()->get();
        return view('kyc.index', compact('kycInfo'));
    }

    public function getKycEdit($id)
    {
        return view('kyc.edit');
    }

    public function storeUserDetails(Request $request)
    {
        $this->validateWith([
            'gender_id'         => 'sometimes|required|exists:payloads,id',
            'dob'               => 'sometimes|required|date',
            'occupation'        => 'sometimes|required|string',
            'marital_status_id' => 'sometimes|required|exists:payloads,id',
            'profile_image'     => 'sometimes|required|file|mimes:jpg,jpeg,png,bmp,tiff,webp|max:104800',
            'kyc_type_id'       => 'sometimes|required|exists:payloads,id',
            'card_number'       => 'sometimes|required|numeric',
            'front_image'       => 'sometimes|required|file|mimes:jpg,jpeg,png,bmp,tiff,webp|max:104800',
            'back_image'        => 'sometimes|required|file|mimes:jpg,jpeg,png,bmp,tiff,webp|max:104800',
        ]);

        try {
            $user = Auth::user();
            $userDetails = UserDetail::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'gender_id' => $request->gender_id,
                'dob' => $request->dob,
                'occupation' => $request->occupation,
                'marital_status_id' => $request->marital_status_id,
            ]);

            if ($request->has('profile_image')) {
                $this->imageHandle($userDetails, $request->profile_image, 'profile_image');
            }


            $kycInfo = KycInfo::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'kyc_type_id' => $request->kyc_type_id,
                'card_number' => $request->card_number,
            ]);

            if ($request->has('front_image')) {
                $this->imageHandle($kycInfo, $request->front_image, 'front_image');
            }
            if ($request->has('back_image')) {
                $this->imageHandle($kycInfo, $request->back_image, 'back_image');
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
    }

    public function storeNomineeInfo(Request $request)
    {
        try {
            $this->validateWith([
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

            if ($request->has('front_image')) {
                $this->imageHandle($nominee, $request->front_image, 'front_image');
            }
            if ($request->has('back_image')) {
                $this->imageHandle($nominee, $request->front_image, 'back_image');
            }

            return response()->json([
                'nominee' => $nominee,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function mailNotification(Request $request)
    {
        try {
            $this->validateWith([
                'user_id' => 'required|exists:users,id',
                'subject' => 'required|string',
                'message' => 'required|string',
            ]);

            $user = User::findOrFail($request->user_id);
            Mail::to($user->email)->send(new NotificationMail($request->subject, $request->message));

            // Display an error toast with no title
            toastr()->success('Success! Mail Notification Sent!');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function kycStatusUpdate(Request $request)
    {
        $kyc = KycInfo::findOrFail($request->kyc_id);
        $kyc->update(['status' => $request->action]);

        toastr()->success('Success! Kyc Status Updated.');
        return redirect()->back();
    }
}
