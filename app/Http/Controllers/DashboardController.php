<?php

namespace App\Http\Controllers;

use App\Models\CollectRequest;
use App\Models\Order;
use App\Models\Payload;
use App\Models\Payment;
use App\Models\PaymentTransfer;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function getDashboard()
    {
        $users = User::count();
        $paymentRequests = Payment::where('status', 'pending')->count();
        $orders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $collectRequest = CollectRequest::where('status', 'pending')->count();
        $withdraws = Withdraw::where('status', 'pending')->count();
        $transfers = PaymentTransfer::whereMonth('created_at', Carbon::now()->month)->where('status', '!=', 'failed')->count();
        $transferData = PaymentTransfer::whereMonth('created_at', Carbon::now()->month)->get();
        $data = [
            'users' => $users,
            'paymentRequests' => $paymentRequests,
            'orders' => $orders,
            'collectRequest' => $collectRequest,
            'withdraws' => $withdraws,
            'transfers' => $transfers,
        ];
        return view('dashboard.dashboard', compact('data', 'transferData'));
    }

    public function getPayloadData(Request $request)
    {
        $this->validateWith([
            'type' => 'required|exists:payloads,type'
        ]);
        $payload = Payload::where('type', $request->type)->get();
        return response()->json(['payload' => $payload]);
    }
}
