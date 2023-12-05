<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentTransfer;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdraw;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Traits\AttachmentTrait;
use Exception;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use AttachmentTrait;

    public function index()
    {
        $payments = Payment::latest()->get();
        return view('payment.payment-list', compact('payments'));
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

        $subject = "Your Payment Request Successfully done";
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

    public function transferList()
    {
        $transfer = PaymentTransfer::latest()->get();
        return view('payment.transfer', compact('transfer'));
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

    public function withdrawList()
    {
        $withdraws = Withdraw::latest()->get();
        return view('payment.withdraw', compact('withdraws'));
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
}
