<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        $user = User::findOrFail(Auth::id());
        $user->unreadNotifications->markAsRead();

        if ($user->hasRole('super-admin')) {
            return redirect()->back();
        }
        return response()->json(['messages' => 'success'], 200);
    }

    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $message = $user->message()->latest()->get();

        if ($user->hasRole('super-admin')) {
            return view('message.index', compact('message'));
        }
        return response()->json(['messages' => $message], 200);
    }

    public function messageCount()
    {
        $user = User::findOrFail(Auth::id());
        $messageCount = $user->unreadNotifications->count();

        return response()->json(['messageCount' => $messageCount], 200);
    }

    public function sendMessage(Request $request)
    {
        $this->validateWith([
            'subject' => 'nullable|string',
            'message' => 'required|string',
            'receiver_id' => 'nullable|exists:users,id',
        ]);
        $admin = User::whereHas('role', function ($role) {
            return $role->where('slug', 'super-admin');
        })->first();

        $user = User::findOrFail(Auth::id());

        $user->notify(new UserNotification($request->subject, $request->message, $request->receiver_id ?? $admin->id));

        if ($user->hasRole('super-admin')) {
            toastr()->success('Success! Message Sent Successfully!');
            return redirect()->back();
        }
        return response()->json(['messages' => "Message Sent Successfully"], 200);
    }
}
