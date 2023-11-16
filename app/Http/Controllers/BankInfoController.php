<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankInfoController extends Controller
{
    public function storeBankInfo(Request $request)
    {
        $data = $request->validate([
            'account_name'    => 'sometimes|required|string',
            'account_number'  => 'sometimes|required|numeric',
            'bank_name'       => 'sometimes|required|string',
            'bank_code'       => 'sometimes|required|numeric',
            'branch_name'     => 'sometimes|required|string',
            'branch_location' => 'sometimes|required|string',
            'routing_number'  => 'sometimes|required|string',
            'account_type'    => 'sometimes|required|string',
            'client'  => 'sometimes|string',
        ]);

        $user = Auth::user();

        $bankInfo = BankInfo::updateOrCreate([
            'user_id' => $user->id,
        ], $data);

        if ($request->client == 'web') {
            return redirect()->back();
        }
        return response()->json([
            'bankInfo' => $bankInfo,
        ], 201);
    }
}
