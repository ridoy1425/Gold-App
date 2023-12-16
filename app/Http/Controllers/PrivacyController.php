<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Exception;

class PrivacyController extends Controller
{
    public function privacyIndex()
    {
        return view('privacy.privacy_create');
    }
    public function privacyList()
    {
        $data=PrivacyPolicy::all();
        return view('privacy.privacy_list',compact('data'));
    }
    public function privacyCreate(Request $request)
    {
        $data = $request->validate([
            'page_type'    => 'required|integer',
            'title'        => 'required|string',
            'sub_title'    => 'required|string',
            'description'  => 'required|string',
        ]);
        try {

        $data = new PrivacyPolicy();
        $data->page_type =$request->page_type;
        $data->title =$request->title;
        $data->sub_title =$request->sub_title;
        $data->description =$request->description;

        $data->save();
            if ($request->client == 'web') {
                toastr()->success('Success! Data Inserted.');
                return redirect()->back();
            }

        } catch (Exception $e) {
            toastr()->error($e->getMessage());

        }
        return redirect()->back();
    }

    public function privacyEdit($id)
    {
        $data=PrivacyPolicy::find($id);
        return view('privacy.privacy_edit',compact('data'));
    }

    public function privacyUpdate(Request $request,$id)
    {

        // $data = $request->validate([
        //     'page_type'    => 'required|integer',
        //     'title'        => 'required|string',
        //     'sub_title'    => 'required|string',
        //     'description'  => 'required|string',
        // ]);
        try {

        $data =PrivacyPolicy::find($id);
        $data->page_type =$request->page_type;
        $data->title =$request->title;
        $data->sub_title =$request->sub_title;
        $data->description =$request->description;
        // dd($request);
        // dd($data);
        $data->update();
            if ($request->client == 'web') {
                toastr()->success('Success! Data Inserted.');
                return redirect()->back()->route('privacy.List');
            }

        } catch (Exception $e) {
            dd($e);
            toastr()->error($e->getMessage());

        }
        return redirect()->route('privacy.List');
    }

    public function privacyDelete($id)
    {
        $privacyDestroy=PrivacyPolicy::find($id);
        $privacyDestroy->delete();

        return redirect()->back();
    }
}
