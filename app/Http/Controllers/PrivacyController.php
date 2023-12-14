<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function privacyIndex()
    {
        return view('privacy.privacy_create');
    }
    public function privacyList()
    {
        return view('privacy.privacy_list');
    }
    public function privacyCreate(Request $request)
    {

    }
}
