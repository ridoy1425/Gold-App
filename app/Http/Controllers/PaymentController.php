<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentTransfer;
use App\Models\User;
use App\Models\Wallet;
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
        return view('payment.transfer');
    }

    public function paymentTransfer(Request $request)
    {
        $this->validateWith([
            'master_id' => 'required|exists:users,master_id',
            'amount'    => 'required|numeric'
        ]);

        $recipient = User::where('master_id', $request->master_id)->first();

        $transfer = PaymentTransfer::create([
            'sender_id'    => Auth::id(),
            'recipient_id' => $recipient->id,
            'amount'       => $request->amount
        ]);

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

        return response()->json(
            [
                'transfer' => $transfer,
            ],
            201
        );
    }

    public function withdrawList()
    {
        return view('payment.withdraw');
    }
}
