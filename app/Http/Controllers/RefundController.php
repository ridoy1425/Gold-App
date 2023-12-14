<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function refundIndex()
    {
        return view('refund.refund_create');
    }
    public function refundList()
    {
        return view('refund.refund_list');
    }
    public function refundCreate(Request $request)
    {

    }
}
