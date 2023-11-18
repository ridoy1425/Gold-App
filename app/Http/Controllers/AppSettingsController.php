<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::first();
        $bankInfo = BankInfo::where('account_type', 'admin')->first();
        return view('app_settings.index', compact('settings', 'bankInfo'));
    }

    public function goldPriceSet(Request $request)
    {
        try {
            $data = $this->validateWith([
                'title'      => 'required|string',
                'gold_price' => 'required',
            ]);

            $settings = Settings::first();
            if ($settings) {
                $settings->update($data);
            } else {
                Settings::create($data);
            }

            toastr()->success('Success! Gold Price Updated');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function goldOrderDataSet(Request $request)
    {
        try {
            $data = $this->validateWith([
                'header_text'       => 'required|string',
                'sub_header'        => 'required|string',
                'buying_price'      => 'required|numeric',
                'profit_percentage' => 'required|numeric',
                'return_period'     => 'required|numeric',
            ]);

            $settings = Settings::first();
            if ($settings) {
                $settings->update($data);
            } else {
                Settings::create($data);
            }

            toastr()->success('Success! Gold Order Data Updated');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
