<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\UserNotification;
use Exception;
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
        $templates = MessageTemplate::latest()->get();
        return view('message.template', compact('templates'));
    }

    public function createTemplate()
    {
        return view('message.template-create');
    }

    public function saveTemplateData()
    {
        $data = $this->validateWith([
            'subject' => 'required|string',
            'message' => 'required|string',
            'status' => 'required|string',
        ]);

        MessageTemplate::create($data);

        toastr()->success('Success! Template Save Successfully!');
        return redirect()->back();
    }

    public function editTemplateData($id)
    {
        $template = MessageTemplate::findOrFail($id);
        return view('message.template-create', compact('template'));
    }

    public function updateTemplateData($id)
    {
        $data = $this->validateWith([
            'subject' => 'required|string',
            'message' => 'required|string',
            'status' => 'required|string',
        ]);

        $template = MessageTemplate::findOrFail($id);
        $template->update($data);

        toastr()->success('Success! Template Update Successfully!');
        return redirect()->back();
    }

    public function singleTemplateData(Request $request)
    {
        $template = MessageTemplate::findOrFail($request->id);
        return response()->json($template);
    }

    public function messagingSendBox()
    {
        $users = User::all();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();

        return view('message.sendbox', compact('users', 'template'));
    }

    public function messageSendToUser(Request $request)
    {
        try {
            $this->validateWith([
                'subject' => 'nullable|string',
                'message' => 'required|string',
                'users'   => 'required|array'
            ]);
            $admin = User::findOrFail(Auth::id());

            foreach ($request->users as $id) {
                $user = User::findOrFail($id);
                $user->notify(new UserNotification($request->subject, $request->message, $admin->id));
            }

            toastr()->success('Success! Message Sent Successfully!');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
