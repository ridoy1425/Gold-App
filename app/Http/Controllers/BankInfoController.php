<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use App\Models\DeliveryInfo;
use App\Models\MobileBanking;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankInfoController extends Controller
{
    public function storeBankInfo(Request $request)
    {
        $data = $request->validate([
            'account_name'    => 'sometimes|required|string',
            'account_number'  => 'sometimes|required|integer',
            'bank_name'       => 'sometimes|required|string',
            'bank_code'       => 'sometimes|required|integer',
            'branch_name'     => 'sometimes|required|string',
            'branch_location' => 'sometimes|required|string',
            'routing_number'  => 'sometimes|required|string',
            'account_type'    => 'sometimes|required|string',
            'client'          => 'sometimes|string',
        ]);

        $user = User::findOrFail(Auth::id());
        try {

            $bankInfo = BankInfo::updateOrCreate([
                'user_id' => $user->id,
            ], $data);

            if ($request->client == 'web') {
                toastr()->success('Success! Bank Information Updated.');
                return redirect()->back();
            }

            return response()->json([
                'bankInfo' => $bankInfo,
            ], 201);
        } catch (Exception $e) {
            if ($user->hasRole('user')) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }

            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function storeMobileBankingInfo(Request $request)
    {
        $data = $request->validate([
            'operator_id'    => 'required|exists:payloads,id',
            'account_number' => 'required|numeric',
            'account_name'   => 'nullable|string',
        ]);

        $user = User::findOrFail(Auth::id());
        try {

            $bankInfo = MobileBanking::updateOrCreate([
                'user_id' => $user->id,
            ], $data);

            if ($user->hasRole('user')) {
                return response()->json([
                    'bankInfo' => $bankInfo,
                ], 201);
            }

            toastr()->success('Success! Mobile Banking Information Updated.');
            return redirect()->back();
        } catch (Exception $e) {
            if ($user->hasRole('user')) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }

            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function storeDeliveryInfo(Request $request)
    {
        $data = $request->validate([
            'address'         => 'required|string',
            'postal_code'     => 'nullable|string',
            'recipient_name'  => 'required|string',
            'phone_number'    => 'sometimes|string',
            'additional_info' => 'nullable|string',
        ]);

        $user = User::findOrFail(Auth::id());
        try {
            $deliveryInfo = DeliveryInfo::updateOrCreate([
                'user_id' => $user->id,
            ], $data);

            if ($user->hasRole('user')) {
                return response()->json([
                    'deliveryInfo' => $deliveryInfo,
                ], 201);
            }

            toastr()->success('Success! Delivery Information Updated.');
            return redirect()->back();
        } catch (Exception $e) {
            if ($user->hasRole('user')) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }

            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
