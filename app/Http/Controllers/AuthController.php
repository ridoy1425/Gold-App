<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function adminLogin()
    {
        return view('ui.login.login');
    }

    public function adminLoginData(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|min:4',
        ]);
        try {
            if (Auth::attempt($request->only(['name', 'password']))) {
                $user = User::where('id', Auth::id())->where('status', 'active')->first();
                if (!$user) {
                    Auth::logout();
                    toastr()->error('Error! Your account is not active');
                    return redirect()->back();
                }
                if ($user->hasRole('user')) {
                    Auth::logout();
                    toastr()->error("Error! You doesn't have an admin role.");
                    return redirect()->back();
                }
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
            return back()->with([
                'error' => 'Credentials do not match.',
            ])->onlyInput('name');
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
        $validate_data = [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|numeric',
            'password'  => 'required|confirmed|min:4',
        ];
        $validator = $request->validate($validate_data);
        try {
            $role = Role::where('slug', 'admin')->first();
            $validator['password'] = Hash::make($request->password);
            $validator['master_id'] = "admin" . rand(1000, 9999);
            $validator['role_id'] = $role->id;
            User::create($validator);

            toastr()->success('Success! Registration successfully done. Please wait for super-admin activation.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function userRegistration(Request $request)
    {

        $validate_data = [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|numeric',
            'password'  => 'required|confirmed|min:4',
        ];
        $validator = $request->validate($validate_data);
        try {
            $role = Role::where('slug', 'user')->first();
            $validator['password'] = Hash::make($request->password);
            $validator['master_id'] = Str::lower(Str::random(2)) . rand(1000, 9999);
            $validator['role_id'] = $role->id;
            $validator['email_verify_token'] = rand(1000, 9999);
            $user = User::create($validator);

            Mail::to($user->email)->send(new EmailVerify($user->email_verify_token));

            return response()->json([
                'user' => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function emailVerify(Request $request)
    {
        $this->validateWith([
            'token' => 'required|exists:users,email_verify_token',
        ]);

        try {
            $user =  User::where('email_verify_token', $request->token)->firstOrFail();
            $user->update(['email_verified_at' => now(), 'email_verify_token' => null, 'status' => 'active']);

            return response()->json([
                'token' => $user->createToken('Api Token')->plainTextToken,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function userLogin(Request $request)
    {
        $validate_data = [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ];
        $request->validate($validate_data);
        try {
            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = User::where('id', Auth::id())->where('status', 'active')->first();
                if (!$user)
                    return response()->json(['message' => 'User is not active'], 404);
                if (!$user->hasRole('user'))
                    return response()->json(['message' => "You doesn't have a user role."], 404);

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

    public function getAuthUser()
    {
        try {
            $user = User::withSum('orders', 'price')->with(['role' => function ($role) {
                return $role->with('permissions');
            }, 'userDetails', 'wallet', 'message', 'kyc', 'nominee', 'bankInfo', 'orders' => function ($order) {
                return $order->with('orderProfit');
            }])->findOrFail(Auth::id());

            return response()->json([
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'user' => $e->getMessage()
            ]);
        }
    }

    public function userLogout(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::id());
            $user->tokens()->delete();

            return response()->json([
                'message' => trans('user_logout')
            ], 200);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function forgotPassword(Request $request)
    {
        $validate_data = [
            'email' => 'required|string|email|exists:users,email',
        ];
        $request->validate($validate_data);

        $user = User::where('email', $request->email)->where('status', 'active')->first();
        if ($user) {
            $token = rand(10000, 99999);
            DB::table('password_resets')->insert([
                'email'      => $request->email,
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($user->email)->send(new ForgotPasswordMail($token, $request->redirect_url));

            return response()->json([
                'message' => 'Token is sent to your gmail.'
            ], 200);
        } else {
            abort(404, 'User associated with this email is not found.');
        }
    }

    public function verifyForgotPasswordToken(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:password_resets,token',
        ]);

        $password_reset = DB::table('password_resets')->where('token', $request->token)->first();
        if ($password_reset === null)
            abort(400, 'Token not valid');

        if (Carbon::parse($password_reset->created_at)->addMinutes(720)->isPast()) {
            $password_reset->delete();
            abort(500, 'Password reset token is expired.');
        }

        return response()->json([
            'message' => 'Password reset token is valid.',
            'token'  => $password_reset
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'             => 'required|email|exists:users,email',
            'password'          => 'required|different:previous_password|min:4|confirmed',
            'token'             => 'required_without:previous_password',
            'previous_password' => 'required_without:token',
        ]);

        try {
            $user = User::where('email', $request->email)->firstOrFail();

            if (!$user) abort(404, 'User not found or invalid email address.');

            if ($request->has('previous_password')) {
                if ($user && !Hash::check($request->previous_password, $user->password))
                    return abort(422, 'The previous password you gave is incorrect.');
            } else {
                $reset_token = DB::table('password_resets')->where([
                    ['token', $request->token],
                    ['email', $request->email]
                ])->first();
                if (!$reset_token) abort(404, 'Token not found or invalid.');
            }
            $user->update(['password' => Hash::make($request->password)]);

            return response()->json([
                'message' => 'Password reset successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
