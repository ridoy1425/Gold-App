<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::first();
        return view('app_settings.index', compact('settings'));
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
}
