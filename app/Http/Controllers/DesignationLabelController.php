<?php

namespace App\Http\Controllers;

use App\Models\DesignationLabel;
use Illuminate\Http\Request;

class DesignationLabelController extends Controller
{
    public function getDegisnationLabel()
    {
        $labels = DesignationLabel::all();
        return view('general-settings.designation-label')->with('labels', $labels);
    }

    public function createDesignationLabel()
    {
        return view('general-settings.designation-label-create');
    }

    public function storeDesignationLabel(Request $request)
    {
        $validate_data = $this->validate($request, [
            'label' => 'required|string',
        ]);

        DesignationLabel::create($validate_data);

        return redirect('designation/label')->with('success', 'Successfully Added');
    }

    public function updateDesignationLabel(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'label' => 'required|string',
        ]);

        $label = DesignationLabel::findOrFail($id);
        $label->update($validate_data);

        return redirect('designation/label')->with('success', 'Successfully Updated');
    }

    public function editDesignationLabel($id)
    {
        $label = DesignationLabel::findOrFail($id);
        return view('general-settings.designation-label-create')->with('label', $label);
    }

    public function destroyDesignationLabel($id)
    {
        DesignationLabel::destroy($id);
        return redirect('designation/label')->with('error', 'Successfully Deleted');
    }
}
