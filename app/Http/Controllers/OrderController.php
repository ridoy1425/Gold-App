<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProfitPackage;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getOrderList()
    {
        $orders = Order::latest()->get();
        return view('payment.order-list', compact('orders'));
    }

    public function orderCreate(Request $request)
    {
        $this->validateWith([
            'gold_qty'          => 'required|numeric',
            'price'             => 'required|numeric',
            'profit_amount'     => 'required|numeric',
            'profit_percentage' => 'required|integer',
            'delivery_time'     => 'required|integer',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_id' => rand(00001, 99999),
            'gold_qty' => $request->gold_qty,
            'price' => $request->price,
            'profit_percentage' => $request->profit_percentage,
            'profit_amount' => $request->profit_amount,
            'delivery_time' => $request->delivery_time,
            'delivery_date' => Carbon::now()->addMonths($request->delivery_time),
        ]);

        return response()->json([
            'order' => $order,
        ], 201);
    }

    public function goldPrice(Request $request)
    {
        $this->validateWith([
            'gold_qty' => 'required|numeric'
        ]);

        $settings = Settings::first();
        if (isset($settings->minimum_quantity) && ($request->gold_qty >= $settings->minimum_quantity)) {
            return response()->json([
                'error' => 'You have to by minimum' . $settings->minimum_quantity . 'gm gold.',
            ], 422);
        }

        $price = $request->gold_qty * ($settings->price_per_gm ?? 100);

        return response()->json([
            'price' =>  $price,
        ], 200);
    }

    public function profitCalculation(Request $request)
    {
        $this->validateWith([
            'price' => 'required|numeric',
            'package_id' => 'required|exists:profit_packages,id'
        ]);

        $package = ProfitPackage::findOrFail($request->profit_id);

        $profit = ($request->price / 100) * $package->percentage;
        $profit += $request->price;

        return response()->json([
            'profit' =>  $profit,
        ], 200);
    }
}
