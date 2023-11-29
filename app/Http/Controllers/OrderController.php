<?php

namespace App\Http\Controllers;

use App\Models\CollectRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProfit;
use App\Models\ProfitPackage;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getOrderList()
    {
        $query = Order::with('user', 'orderProfit');

        $user = User::findOrFail(Auth::id());

        if ($user->hasRole('user')) {
            $orders = $query->where('user_id', $user->id)->latest()->get();
            return response()->json([
                'orders' => $orders,
            ], 201);
        }

        $orders = $query->latest()->get();
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

        if ($order) {
            for ($month = 1; $month <= $request->delivery_time; $month++) {
                $date = Carbon::now()->addMonths($month);
                OrderProfit::create([
                    'order_id' => $order->id,
                    'date' => $date,
                ]);
            }
        }

        return response()->json([
            'order' => $order,
        ], 201);
    }

    public function changeProfitStatus(Request $request)
    {
        $profit = OrderProfit::findOrFail($request->profit_id);
        $profit->update(['status' => $request->status]);

        toastr()->success('Success! Profit Status Updated.');
        return redirect()->back();
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

    public function getCollectRequestList()
    {
        $request = CollectRequest::latest()->get();
        return view('payment.collect-request', compact('request'));
    }

    public function collectRequest()
    {
        $data = $this->validateWith([
            'order_id'       => 'required|exists:orders,id',
            'collect_type'   => 'required|in:investment,profit',
            'payment_type'   => 'required|in:balance,gold',
            'amount'         => 'nullable|numeric',
            'gold'           => 'nullable|integer',
            'payment_method' => 'required|in:bank,wallet'
        ]);

        try {
            $data['status'] = 'active';
            $request = CollectRequest::create($data);

            if ($request->has('order_profit_id')) {
                $profit = OrderProfit::findOrFail($request->order_profit_id);
                $profit->update(['status', 'in-process']);
            } else {
                $order = Order::findOrFail($request->order_id);
                $order->update(['status', 'in-process']);
            }
            return response()->json([
                'request' =>  $request,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function changeCollectionStatus()
    {
        $data = $this->validateWith([
            'request_id' => 'required|exists:collect_requests,id',
            'status' => 'required|string',
        ]);

        $request = CollectRequest::findOrFail($data['request_id']);
        $request->update(['status' => $data['status']]);

        toastr()->success('Success! Status Changed');
        return redirect()->back();
    }
}
