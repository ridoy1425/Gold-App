<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\DesignationLabel;
use Illuminate\Http\Request;

class DesignationInfoController extends Controller
{
    public function getDegisnationInfo(Request $request)
    {
        $query = Designation::with('label');
        if ($request->has('label'))
            $query->where('label_id', $request->label);

        $designations = $query->latest()->get();
        return view('general-settings.designation-info')->with('designations', $designations);
    }

    public function getDesignationByLabel(Request $request)
    {
        $query = Designation::query();
        if ($request->has('label'))
            $query->where('label_id', $request->label);
        $designations = $query->get();

        return response()->json(
            $designations
        );
    }

    public function createDesignation()
    {
        $labels = DesignationLabel::all();
        return view('general-settings.designation-create')->with('labels', $labels);
    }

    public function storeDesignation(Request $request)
    {

        $validate_data = $this->validate($request, [
            'label_id'       => 'required|exists:designation_labels,id',
            'designation'    => 'required|string',
            'designation_bn' => 'required|string',
        ]);
        Designation::create($validate_data);

        return redirect('designation/info')->with('success', 'Successfully Added');
    }

    public function updateDesignation(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'label_id' => 'required|exists:designation_labels,id',
            'designation' => 'required|string',
            'designation_bn' => 'required|string',
        ]);

        $label = Designation::findOrFail($id);
        $label->update($validate_data);

        return redirect('designation/info')->with('success', 'Successfully Updated');
    }

    public function showSingleDesignation(Request $request)
    {
        $designation = Designation::where('label_id', $request->id)->get();
        return response()->json(
            $designation
        );
    }

    public function editDesignation($id)
    {
        $designation = Designation::findOrFail($id);
        $labels = DesignationLabel::all();
        return view('general-settings.designation-create')->with('designation', $designation)->with('labels', $labels);
    }

    public function destroyDesignation($id)
    {
        Designation::destroy($id);
        return redirect('designation/info')->with('error', 'Successfully Deleted');
    }
}
