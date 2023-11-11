<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\Branch;
use App\Models\EmployeeInfo;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function adminLogin()
    {
        return view('ui.login.login');
    }

    public function adminLoginData(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'password' => 'required|min:4',
            ]);
            if (Auth::attempt($request->only(['name', 'password']))) {
                $user = Auth::user();

                if ($user->expire_date && now()->gt($user->expire_date)) {
                    Auth::logout();
                    return back()->with([
                        'error' => 'Your account has expired.',
                    ])->onlyInput('user_name');
                }
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            return back()->with([
                'error' => 'Credentials do not match.',
            ])->onlyInput('user_name');
        } catch (\Exception $e) {
            return back()->withErrors([
                'message' => false,
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function adminRegistration(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'user_name' => 'required|unique:users,user_name',
            'password'  => 'required|confirmed|min:4',
        ]);

        $role = Role::where('role_slug', 'employee')->first();
        User::create([
            'name'   => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'password'    => Hash::make($request->password),
            'role_id'     => $role->id,
        ]);

        return redirect()->back()->with('success', 'Registration Successful');
    }

    public function userRegistration(Request $request)
    {
        try {
            $validate_data = [
                'name'     => 'required|string',
                'email'    => 'required|email|unique:users,email',
                'phone'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'password' => 'required|confirmed|min:4',
            ];
            $validator = $request->validate($validate_data);

            $role = Role::where('slug', 'user')->first();
            $validator['role_id'] = $role->id;
            $validator['email_verify_token'] = rand(1000, 9999);
            $user = User::create($validator);

            Mail::to($user->email)->send(new EmailVerify($user->email_verify_token));

            return response()->json([
                'user' => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function emailVerify(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'token' => 'required|exists:users,email_verify_token',
            ]);

            $user =  User::where('email_verify_token', $request->token)->firstOrFail();
            $user->update(['email_verified_at' => now(), 'email_verify_token' => null, 'status' => 'active']);

            return response()->json([
                'token' => $user->createToken('Api Token')->plainTextToken,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function userLogin(Request $request)
    {
        try {
            $validate_data = [
                'email' => 'required|email',
                'password' => 'required|min:4',
            ];
            $request->validate($validate_data);

            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = User::where('id', Auth::id())->where('status', 'active')->first();
                if (!$user)
                    return response()->json(['message' => 'User is not active'], 404);

                return response()->json([
                    'token' => $user->createToken('Api Token')->plainTextToken,
                ], 200);
            }
            abort(401, "Authentication doesn't match");
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
