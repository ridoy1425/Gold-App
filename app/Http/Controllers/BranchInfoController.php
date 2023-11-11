<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchInfoController extends Controller
{
    public function getBranchInfo()
    {
        $branches = Branch::latest()->get();
        return view('general-settings.branch-info')->with('branches', $branches);
    }

    public function createBranch()
    {
        return view('general-settings.branch-create');
    }

    public function storeBranch(Request $request)
    {
        $validate_data = $this->validate($request, [
            'name'       => 'required|string',
            'short_name' => 'required|string',
            'phone'      => 'string|regex:/(01)[0-9]{9}/',
            'email'      => 'string|email',
            'address'    => 'string',
        ]);

        $validate_data['short_name'] = strtoupper($validate_data['short_name']);
        $existingCount = Branch::where('short_name', $validate_data['short_name'])->count();
        $code = $validate_data['short_name'] . sprintf('%03d', $existingCount + 1);
        $validate_data['code'] = $code;

        Branch::create($validate_data);

        return redirect('branch/info')->with('success', 'Successfully Added');
    }

    public function updateBranch(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'name'       => 'required|string',
            'short_name' => 'required|string',
            'phone'      => 'string|regex:/(01)[0-9]{9}/',
            'email'      => 'string|email',
            'address'    => 'string',
        ]);

        $branch = Branch::findOrFail($id);
        $oldShortName = $branch->short_name;
        $validate_data['short_name'] = strtoupper($validate_data['short_name']);
        $newShortName = $validate_data['short_name'];

        if ($oldShortName !== $newShortName) {
            $existingCount = Branch::where('short_name', $newShortName)->count();
            $code = $newShortName . sprintf('%03d', $existingCount + 1);
            $validate_data['code'] = $code;
        }
        $branch->update($validate_data);

        return redirect('branch/info')->with('success', 'Successfully Updated');
    }

    public function editBranch($id)
    {
        $branch = Branch::findOrFail($id);
        return view('general-settings.branch-create')->with('branch', $branch);
    }

    public function destroyBranch($id)
    {
        Branch::destroy($id);
        return redirect('branch/info')->with('error', 'Successfully Deleted');
    }
}
