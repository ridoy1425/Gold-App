<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\CategorySection;
use App\Models\ContactUs;
use App\Models\FrequentlyQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // About Section
    public function aboutIndex()
    {
        return view('home.about.about_create');
    }
    public function aboutList()
    {
        $about = AboutUs::all();

        $user = User::findOrFail(Auth::id());
        if ($user->hasRole('user')) {
            return response()->json([
                'about' => $about
            ]);
        }
        return view('home.about.about_list', compact('about'));
    }
    public function aboutCreate(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string',
            'description'  => 'required|string',
        ]);
        try {

            $data = new AboutUs();
            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function aboutEdit($id)
    {
        $aboutEdit = AboutUs::find($id);
        return view('home.about.about_edit', compact('aboutEdit'));
    }

    public function aboutUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'title'        => 'required|string',
            'description'  => 'required|string',
        ]);
        try {

            $data = AboutUs::find($id);
            $data->title = $request->title;
            $data->description = $request->description;

            $data->update();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function aboutDelete($id)
    {
        $aboutDestroy = AboutUs::find($id);
        $aboutDestroy->delete();

        return redirect()->route('about.List');
    }


    //Frequently Question Section
    public function questionIndex()
    {
        return view('home.question.question_create');
    }
    public function questionList()
    {
        $question = FrequentlyQuestion::all();
        return view('home.question.question_list', compact('question'));
    }
    public function questionCreate(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string',
            'description'  => 'required|string',
        ]);
        try {

            $data = new FrequentlyQuestion();
            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function questionEdit($id)
    {
        $questionEdit = FrequentlyQuestion::find($id);
        return view('home.question.question_edit', compact('questionEdit'));
    }

    public function questionUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'title'        => 'required|string',
            'description'  => 'required|string',
        ]);
        try {

            $data = FrequentlyQuestion::find($id);
            $data->title = $request->title;
            $data->description = $request->description;

            $data->update();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function questionDelete($id)
    {
        $Question = FrequentlyQuestion::find($id);
        $Question->delete();

        return redirect()->back();
    }

    // Contact us Section
    public function contactIndex()
    {
        return view('home.contact.contact_create');
    }
    public function contactList()
    {
        $contact = ContactUs::all();
        return view('home.contact.contact_list', compact('contact'));
    }
    public function contactCreate(Request $request)
    {
        $data = $request->validate([
            'phone'        => 'required|string',
            'address'      => 'required|string',
        ]);
        try {

            $data = new ContactUs();
            $data->phone = $request->phone;
            $data->address = $request->address;

            $data->save();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function contactEdit($id)
    {
        $contactEdit = ContactUs::find($id);
        return view('home.contact.contact_edit', compact('contactEdit'));
    }
    public function contactUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'phone'        => 'required|string',
            'address'      => 'required|string',
        ]);
        try {

            $data = ContactUs::find($id);
            $data->phone = $request->phone;
            $data->address = $request->address;

            $data->update();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function contactDelete($id)
    {
        $contactDestroy = ContactUs::find($id);
        $contactDestroy->delete();

        return redirect()->route('contact.List');
    }

    // Category Section

    public function categoryIndex()
    {
        return view('home.category_section.category_create');
    }
    public function categoryList()
    {
        $data = CategorySection::all();
        return view('home.category_section.category_list', compact('data'));
    }
    public function categoryCreate(Request $request)
    {
        // dd($request);
        // $data = $request->validate([
        //     'tab_type'    => 'required|integer',
        //     'tab_title'   => 'required|string',
        //     'sub_title'   => 'required|string',
        //     'description' => 'required|string',
        // ]);
        try {

            $data = new CategorySection();
            $data->tab_type = $request->tab_type;
            $data->tab_title = $request->title;
            $data->sub_title = $request->sub_title;
            $data->description = $request->description;
            // dd($data);
            $data->save();
            toastr()->success('Success! Data Inserted.');
            return redirect()->back();
        } catch (Exception $e) {
            // dd($e);
            toastr()->error($e->getMessage());
        }
    }

    public function categoryEdit($id)
    {
        $data = CategorySection::find($id);
        return view('home.category_section.category_edit', compact('data'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        try {

            $data = CategorySection::find($id);
            $data->tab_type = $request->tab_type;
            $data->tab_title = $request->title;
            $data->sub_title = $request->sub_title;
            $data->description = $request->description;

            $data->update();
            toastr()->success('Success! Data Inserted.');
            return redirect()->route('category.List');
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    public function categoryDelete($id)
    {
        $categoryDestroy = CategorySection::find($id);
        $categoryDestroy->delete();

        return redirect()->back();
    }
}
