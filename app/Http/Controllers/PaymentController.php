<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\AttachmentTrait;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use AttachmentTrait;

    public function index()
    {
        $payments = [];
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
            $data = [
                'id'    => $payment->id,
                'field' => 'receipt_image'
            ];
            $this->imageHandle($data, $request->receipt_image);
        }

        return response()->json([
            'payment' => $payment,
        ], 201);
    }

    public function addWalletAmount(Request $request)
    {
        $this->validateWith([
            'id' => 'required|exists:payments,id',
            'add_amount' => 'required|integer',
        ]);

        $payment = Payment::findOrFail($request->id);
        $payment->update([
            'add_amount', $request->add_amount,
            'status' => 'success'
        ]);

        return response()->json([
            'payment' => $payment,
        ], 201);
    }
}
