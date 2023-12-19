<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use App\Models\Payload;
use App\Models\Payment;
use App\Models\PaymentTransfer;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdraw;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Traits\AttachmentTrait;
use App\Traits\FilterDataTrait;
use Exception;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use AttachmentTrait, FilterDataTrait;

    public function index()
    {
        $payments = Payment::with('user')->latest()->get();
        $filter_user = User::latest()->get();
        $statuses = Payload::where('type', 'status')->get();
        return view('payment.payment-list', compact('payments', 'filter_user', 'statuses'));
    }

    public function paymentRequest(Request $request)
    {
        $this->validateWith([
            'payment_amount' => 'required|integer',
            'receipt_image' => 'required|file|mimes:png,jpg'
        ]);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'payment_amount' => $request->payment_amount,
        ]);

        if ($request->has('receipt_image')) {
            $this->imageHandle($payment, $request->receipt_image, 'receipt_image');
        }

        $subject = "Payment Request";
        $message = "Your Payment Request Successfully done";
        $user = User::findOrFail(Auth::id());
        $user->notify(new UserNotification($subject, $message, 1));
        return response()->json([
            'payment' => $payment,
        ], 201);
    }

    public function addWalletAmount(Request $request)
    {
        $this->validateWith([
            'id'         => 'required|exists:payments,id',
            'add_amount' => 'nullable',
            'action'     => 'required|in:approved,rejected'
        ]);

        try {
            if ($request->action == "approved") {
                $payment = Payment::findOrFail($request->id);
                $payment->update([
                    'add_amount' => $request->add_amount,
                    'status' => $request->action
                ]);

                $balance = 0;
                $wallet = Wallet::where('user_id', $payment->user_id)->first();
                if ($wallet) {
                    $balance = $wallet->balance + $request->add_amount;
                    $wallet->update(['balance' => $balance]);
                } else {
                    $balance = $request->add_amount;
                    $wallet = Wallet::create([
                        'user_id' => $payment->user_id,
                        'balance' => $balance,
                    ]);
                }

                toastr()->success('Success! Payment Request Accepted.');
                return redirect()->back();
            } else {
                $payment = Payment::findOrFail($request->id);
                $payment->update([
                    'status' => $request->action
                ]);
                toastr()->error('Rejected! Payment Request Rejected.');
                return redirect()->back();
            }
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function paymentDelete($id)
    {
        Payment::destroy($id);

        toastr()->success('Success! Deleted Successfully.');
        return redirect()->back();
    }

    public function transferList()
    {
        $transfer = PaymentTransfer::with('sender', 'receiver')->latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        return view('payment.transfer', compact('transfer', 'template'));
    }

    public function paymentTransfer(Request $request)
    {
        $this->validateWith([
            'master_id' => 'required|exists:users,master_id',
            'amount'    => 'required|numeric'
        ]);

        try {
            $admin = User::whereHas('role', function ($role) {
                return $role->where('slug', 'super-admin');
            })->first();
            $sender = User::findOrFail(Auth::id());
            $recipient = User::where('master_id', $request->master_id)->first();

            if ($sender->id == $recipient->id) {
                return response()->json(
                    [
                        'error' => "you can't transfer to your account",
                    ],
                    500
                );
            }

            $senderWallet = Wallet::where('user_id', $sender->id)->first();
            if ($senderWallet->balance > $request->amount) {
                $balance = 0;
                $balance = $senderWallet->balance - $request->amount;
                $senderWallet->update(['balance' => $balance]);
            } else {
                return response()->json(
                    [
                        'error' => "you doesn't have sufficient balance",
                    ],
                    500
                );
            }

            $balance = 0;
            $wallet = Wallet::where('user_id', $recipient->id)->first();
            if ($wallet) {
                $balance = $wallet->balance + $request->amount;
                $wallet->update(['balance' => $balance]);
            } else {
                $balance = $request->amount;
                $wallet = Wallet::create([
                    'user_id' => $recipient->id,
                    'balance' => $balance,
                ]);
            }

            $transfer = PaymentTransfer::create([
                'sender_id'    => $sender->id,
                'recipient_id' => $recipient->id,
                'amount'       => $request->amount,
                'status'       => 'success'
            ]);

            $subject1 = "Transfer Balance";
            $message = "You have transfer " . $request->amount . " to " . $recipient->name;
            $sender->notify(new UserNotification($subject1, $message, $admin->id));

            $subject1 = "Transfer Balance";
            $message = "You have receive " . $request->amount . " from " . $sender->name;
            $recipient->notify(new UserNotification($subject1, $message, $admin->id));

            $subject1 = "Transfer Balance";
            $message = $sender->name . " have transfer " . $request->amount . " to " . $recipient->name;
            $admin->notify(new UserNotification($subject1, $message, $sender->id));

            return response()->json(
                [
                    'transfer' => $transfer,
                ],
                201
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ]
            );
        }
    }

    public function transferDelete($id)
    {
        PaymentTransfer::destroy($id);

        toastr()->success('Success! Deleted Successfully');
        return redirect()->back();
    }

    public function withdrawList()
    {
        $withdraws = Withdraw::latest()->get();
        $template = MessageTemplate::where('status', 'enable')->latest()->get();
        $statuses = Payload::where('type', 'status')->get();
        return view('payment.withdraw', compact('withdraws', 'statuses', 'template'));
    }

    public function withdrawRequest(Request $request)
    {
        $this->validateWith([
            'reason' => 'nullable|string',
            'amount' => 'required|numeric'
        ]);

        try {
            $admin = User::whereHas('role', function ($role) {
                return $role->where('slug', 'super-admin');
            })->first();
            $user = User::findOrFail(Auth::id());

            $senderWallet = Wallet::where('user_id', $user->id)->first();
            if ($senderWallet->balance < $request->amount) {
                return response()->json(
                    [
                        'error' => "you doesn't have sufficient balance",
                    ],
                    500
                );
            }

            $balance = 0;
            $balance = $senderWallet->balance - $request->amount;
            $senderWallet->update(['balance' => $balance]);

            $withdraw = Withdraw::create([
                'user_id' => $user->id,
                'reason'  => $request->reason,
                'amount'  => $request->amount,
            ]);

            $subject = "Withdraw Request";
            $message = $user->name . " have withdraw request for amount " . $request->amount;
            $admin->notify(new UserNotification($subject, $message, $user->id));

            return response()->json(
                [
                    'withdraw' => $withdraw,
                ],
                201
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ]
            );
        }
    }

    public function changeWithdrawStatus()
    {
        $data = $this->validateWith([
            'withdraw_id' => 'required|exists:withdraws,id',
            'status' => 'required|string',
        ]);

        $withdraw = Withdraw::findOrFail($data['withdraw_id']);
        if ($data['status'] == "rejected" && $withdraw->status != "rejected") {
            $senderWallet = Wallet::where('user_id', $withdraw->user_id)->first();
            $balance = 0;
            $balance = $senderWallet->balance + $withdraw->amount;
            $senderWallet->update(['balance' => $balance]);
        }
        $withdraw->update(['status' => $data['status']]);

        $admin = User::whereHas('role', function ($role) {
            return $role->where('slug', 'super-admin');
        })->first();
        $user = User::findOrFail($withdraw->user_id);

        $subject = "Withdraw status changed";
        $message = "Your withdraw request for amount " . $withdraw->amount . " has been " . $data['status'];
        $user->notify(new UserNotification($subject, $message, $admin->id));

        toastr()->success('Success! Status Changed');
        return redirect()->back();
    }

    public function withdrawDelete($id)
    {
        Withdraw::destroy($id);

        toastr()->success('Success! Deleted Successfully');
        return redirect()->back();
    }

    public function filterFormData(Request $request)
    {
        return $this->paymentFilter($request, 'payment.payment-list',);
    }

    public function filterWithdrawData(Request $request)
    {
        return $this->withdrawFilter($request, 'payment.withdraw',);
    }

    public function filterTransferData(Request $request)
    {
        return $this->transferFilter($request, 'payment.transfer',);
    }
}
