<?php

namespace App\Http\Controllers;

use App\Models\AppPoster;
use App\Models\BankInfo;
use App\Models\ProfitPackage;
use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\AttachmentTrait;

class AppSettingsController extends Controller
{
    use AttachmentTrait;
    public function index()
    {
        $settings = Settings::first();
        $bankInfo = BankInfo::where('account_type', 'admin')->first();
        $packages = ProfitPackage::latest()->get();
        $posters = AppPoster::all();
        if (Auth::user()->hasRole('user')) {
            return response()->json([
                'settings' => $settings,
                'bankInfo' => $bankInfo,
                'posters'   => $posters,
            ]);
        }
        return view('app_settings.index', compact('settings', 'bankInfo', 'packages', 'posters'));
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
                'header_text' => 'nullable|string',
                'phone_number' => 'nullable'
            ]);

            $settings = Settings::first();
            if ($settings) {
                $settings->update($data);
            } else {
                Settings::create($data);
            }

            toastr()->success('Success! Header Text & Phone number Updated');
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

    public function packageList()
    {
        $packages = ProfitPackage::orderBy('id')->get();
        return response()->json([
            'packages' => $packages
        ]);
    }

    public function addPoster(Request $request)
    {
        $model = new AppPoster();
        $model->poster = "poster";
        $model->status = "active";
        $model->save();
        $this->imageHandle($model, $request->poster, 'poster');

        // Display an error toast with no title
        toastr()->success('Success! Poster save successfully!');
        return redirect()->back();
    }

    public function posterDelete($id)
    {
        AppPoster::destroy($id);

        toastr()->success('Success! Poster deleted successfully!');
        return redirect()->back();
    }
}
