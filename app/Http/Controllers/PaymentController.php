<?php

namespace App\Http\Controllers;

use App\Models\Payment;
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

        $message = "Your Payment Request Successfully done";
        Auth::user()->notify(New UserNotification($message));
        return response()->json([
            'payment' => $payment,
        ], 201);
    }

    public function addWalletAmount(Request $request)
    {
        try {
            $this->validateWith([
                'id'         => 'required|exists:payments,id',
                'add_amount' => 'nullable',
                'action'     => 'required|in:approved,rejected'
            ]);

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
}
