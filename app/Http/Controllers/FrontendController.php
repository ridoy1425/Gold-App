<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\CategorySection;
use App\Models\ContactUs;
use App\Models\FrequentlyQuestion;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Mockery\Matcher\Contains;

class FrontendController extends Controller
{
    public function showLandingPage()
    {
        $aboutSection=AboutUs::first();
        $questionSection=FrequentlyQuestion::all();
        $contactUs=ContactUs::first();
        $category1=CategorySection::where('tab_type',1)->first();
        $category2=CategorySection::where('tab_type',2)->first();
        $category3=CategorySection::where('tab_type',3)->first();
        $category4=CategorySection::where('tab_type',4)->first();
        $category5=CategorySection::where('tab_type',5)->first();
        // dd($category1);
        return view('frontend.index',compact('aboutSection','questionSection','contactUs','category1',
                    'category2','category3','category4','category5'));
    }
    public function privacyPage()
    {
        $contactUs=ContactUs::first();
        $privacy=PrivacyPolicy::where('page_type',1)->get();
        // dd($privacy);
        return view('frontend.privacy_policy',compact('contactUs','privacy'));
    }
    public function refund_policyPage()
    {
        $contactUs=ContactUs::first();
        $refund=PrivacyPolicy::where('page_type',2)->get();
        return view('frontend.refund_policy',compact('contactUs','refund'));
    }
    public function termsPage()
    {
        $contactUs=ContactUs::first();
        $term=PrivacyPolicy::where('page_type',3)->get();
        return view('frontend.terms',compact('contactUs','term'));
    }
}
