<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use App\Models\ProfitPackage;
use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::first();
        $bankInfo = BankInfo::where('account_type', 'admin')->first();
        $packages = ProfitPackage::latest()->get();
        return view('app_settings.index', compact('settings', 'bankInfo', 'packages'));
    }

    public function goldPriceSet(Request $request)
    {
        try {
            $data = $this->validateWith([
                'title'      => 'required|string',
                'gold_price' => 'required|numeric',
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
                'header_text' => 'required|string',
            ]);

            $settings = Settings::first();
            if ($settings) {
                $settings->update($data);
            } else {
                Settings::create($data);
            }

            toastr()->success('Success! Header Text Updated');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function minimumPriceSet(Request $request)
    {
        try {
            $data = $this->validateWith([
                'minimum_quantity' => 'required|integer',
                'price_per_gm'     => 'required|numeric',
            ]);

            $settings = Settings::first();
            if ($settings) {
                $settings->update($data);
            } else {
                Settings::create($data);
            }

            toastr()->success('Success! Minimum Quantity & Price Updated');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function profitPackageSet(Request $request)
    {
        try {
            $data = $this->validateWith([
                'month'      => 'required|integer',
                'percentage' => 'required|numeric',
            ]);

            if ($request->has('id')) {
                $package = ProfitPackage::findOrFail($request->id);
                $package->update($data);
            } else {
                $package = ProfitPackage::create($data);
            }

            toastr()->success('Success! Profit Package Set Successfully');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function packageDelete($id)
    {
        ProfitPackage::destroy($id);
        toastr()->success('Success! Package Deleted!');
        return redirect()->back();
    }
}
