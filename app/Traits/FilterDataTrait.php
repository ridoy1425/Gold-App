<?php

namespace App\Traits;

use App\Models\CollectRequest;
use App\Models\MessageTemplate;
use App\Models\Order;
use App\Models\Payload;
use App\Models\Payment;
use App\Models\PaymentTransfer;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait FilterDataTrait
{

    public function filterCommonData(Request $request, $viewName)
    {
        $query = User::with('wallet', 'kyc');

        if ($request->user_id != null)
            $query->where('id', $request->user_id);
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $users = $query->latest()->get();
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();

        return  view($viewName, compact('users', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user', 'statuses'));
    }

    public function paymentFilter(Request $request, $viewName)
    {
        $query = Payment::with('user');

        if ($request->user_id != null)
            $query->where('user_id', $request->user_id);
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $payments = $query->latest()->get();
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();

        return  view($viewName, compact('payments', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user', 'statuses'));
    }
    public function orderFilter(Request $request, $viewName)
    {
        $query = Order::with('user');

        if ($request->user_id != null)
            $query->where('user_id', $request->user_id);
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $orders = $query->latest()->get();
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();

        return  view($viewName, compact('orders', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user', 'statuses'));
    }

    public function withdrawFilter(Request $request, $viewName)
    {
        $query = Withdraw::with('user');

        if ($request->user_id != null)
            $query->where('user_id', $request->user_id);
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $withdraws = $query->latest()->get();
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();

        return  view($viewName, compact('withdraws', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user', 'statuses'));
    }

    public function transferFilter(Request $request, $viewName)
    {
        $query = PaymentTransfer::with('sender', 'receiver');

        if ($request->user_id != null)
            $query->where('user_id', $request->user_id);
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $transfer = $query->latest()->get();
        $user_id = $request->user_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();

        return  view($viewName, compact('transfer', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user', 'statuses'));
    }

    public function collectionFilter(Request $request, $viewName)
    {
        $query = CollectRequest::with('order', 'profit');

        if ($request->user_id != null) {
            $query->whereHas('order', function ($q) use ($request) {
                return $q->where('user_id', $request->user_id);
            });
        }
        if ($request->from_date != null)
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d H:i:s'));
        if ($request->to_date != null)
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d H:i:s'));
        if ($request->status != null)
            $query->where('status', $request->status);

        $user_id = $request->user_id ?? null;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;
        $filter_user = User::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();
        $request = $query->latest()->get();

        return  view($viewName, compact('request', 'user_id', 'from_date', 'to_date', 'status', 'template', 'filter_user', 'statuses'));
    }
}
