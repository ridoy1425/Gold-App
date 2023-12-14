<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function termsIndex()
    {
        return view('terms.terms_create');
    }
    public function termsList()
    {
        return view('terms.terms_list');
    }
    public function termsCreate(Request $request)
    {

    }
}
