<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function aboutIndex()
    {
        return view('home.about.about_create');
    }       
    public function aboutList()
    {
        return view('home.about.about_list');
    }
    public function aboutCreate(Request $request)
    {

    }

    public function questionIndex()
    {
        return view('home.question.question_create');
    }
    public function questionList()
    {
        return view('home.question.question_list');
    }
    public function questionCreate(Request $request)
    {

    }

    public function contactIndex()
    {
        return view('home.contact.contact_create');
    }
    public function contactList()
    {
        return view('home.contact.contact_list');
    }
    public function contactCreate(Request $request)
    {

    }
}
