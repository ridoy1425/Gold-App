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

        if ($user->hasRole('user')) {
            $message = $user->message()->latest()->get();
            return response()->json(['messages' => $message], 200);
        }

        $message = $user->message()->where('read_at', null)->latest()->get();
        return view('message.index', compact('message'));
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

        if ($user->hasRole('user')) {
            $admin->notify(new UserNotification($request->subject, $request->message, $user->id));
            return response()->json(['messages' => "Message Sent Successfully"], 200);
        }

        $receiver = User::findOrFail($request->receiver_id);
        $receiver->notify(new UserNotification($request->subject, $request->message, $user->id));
        toastr()->success('Success! Message Sent Successfully!');
        return redirect()->back();
    }

    public function messagingTemplate()
    {
        return view('message.template');
    }

    public function messagingSendBox()
    {
        return view('message.sendbox');
    }

    public function messageRead($id)
    {
        dd($id);
        Notification::destroy($id);
        return redirect()->back();
    }
}
