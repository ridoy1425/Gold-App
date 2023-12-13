<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function showLandingPage()
    {
        return view('frontend.index');
    }
    public function privacyPage()
    {
        return view('frontend.privacy_policy');
    }
    public function refund_policyPage()
    {
        return view('frontend.refund_policy');
    }
    public function termsPage()
    {
        return view('frontend.terms');
    }
}
