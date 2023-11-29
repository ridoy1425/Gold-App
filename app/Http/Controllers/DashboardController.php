<?php

namespace App\Http\Controllers;

use App\Models\Payload;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard.dashboard');
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
