<?php

namespace App\Http\Controllers;

use App\Models\AppraisalCategory;
use App\Models\Branch;
use App\Models\Designation;
use App\Models\DesignationLabel;
use App\Models\EmployeeInfo;
use App\Models\LeaveEntry;
use App\Models\LeaveType;
use App\Models\Payload;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function getLeaveType()
    {
        $leaveTypes = LeaveType::all();
        return view('general-settings.leave-type-index', compact('leaveTypes'));
    }

    public function leaveTypeview()
    {
        return view('general-settings.leave-type');
    }

    public function leaveTypeEdit($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        return view('general-settings.leave-type', compact('leaveType'));
    }

    public function leaveTypeStore(Request $request)
    {
        $validate_data = $this->validate($request, [
            'leave_name' => 'required|string',
            'no_of_days' => 'required|integer'
        ]);

        LeaveType::create($validate_data);

        return redirect('leave/index')->with('success', 'Successfully Added');
    }

    public function leaveTypeUpdate(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'leave_name' => 'required|string',
            'no_of_days' => 'required|integer',
        ]);

        LeaveType::findOrFail($id)->update($validate_data);

        return redirect('leave/index')->with('success', 'Successfully Updated');
    }

    public function leaveTypeDestroy($id)
    {
        LeaveType::destroy($id);
        return redirect('leave/index')->with('error', 'Successfully Deleted');
    }

    public function getLeaveEntry()
    {
        $user = User::findOrFail(Auth::id());

        $query = LeaveEntry::with('employee');
        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->whereHas('employee', function ($q) use ($user) {
                return $q->where('branch_id', $user->role->branch_id);
            });
        }
        $leaveDatas = $query->latest()->get();
        return view('leaves.leave-entry-index', compact('leaveDatas'));
    }

    public function leaveEntry()
    {
        $leaveTypes = LeaveType::all();
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        return view('leaves.leave-entry', compact('leaveTypes', 'branches', 'categories'));
    }

    public function leaveEntryStore(Request $request)
    {
        $validate_data = $this->validate($request, [
            'employee_id'   => 'required|exists:employee_infos,id',
            'substitute_id' => 'nullable|exists:employee_infos,id',
            'entry_date'    => 'required|date',
            'leave_type_id' => 'required|exists:leave_types,id',
            'leave_from'    => 'required|date',
            'leave_to'      => 'required|date',
            'no_of_days'    => 'required|integer',
            'reason'        => 'required|string',
            'leave_address' => 'nullable|string',
        ]);

        $validate_data['entry_date'] = date('Y-m-d', strtotime($validate_data['entry_date']));
        $validate_data['leave_from'] = date('Y-m-d', strtotime($validate_data['leave_from']));
        $validate_data['leave_to'] = date('Y-m-d', strtotime($validate_data['leave_to']));
        $validate_data['status_id'] = 44;
        LeaveEntry::create($validate_data);

        return redirect('leave/entry/index')->with('success', 'Successfully Added');
    }

    public function leaveEntryEdit($id)
    {
        $leave = LeaveEntry::with('employee', 'substitute', 'leaveType')->findOrFail($id);
        $leaveTypes = LeaveType::all();
        $branches = Branch::all();
        return view('leaves.leave-entry', compact('leave', 'leaveTypes', 'branches'));
    }

    public function leaveEntryUpdate(Request $request, $leave_entry_id)
    {
        $validate_data = $this->validate($request, [
            'employee_id'    => 'required|exists:employee_infos,id',
            'substitute_id'  => 'nullable|exists:employee_infos,id',
            'entry_date'     => 'required|date',
            'leave_type_id'  => 'required|exists:leave_types,id',
            'leave_from'     => 'required|date',
            'leave_to'       => 'required|date',
            'no_of_days'     => 'required|integer',
            'reason'         => 'required|string',
            'leave_address'  => 'nullable|string',
        ]);
        $validate_data['entry_date'] = date('Y-m-d', strtotime($validate_data['entry_date']));
        $validate_data['leave_from'] = date('Y-m-d', strtotime($validate_data['leave_from']));
        $validate_data['leave_to'] = date('Y-m-d', strtotime($validate_data['leave_to']));

        LeaveEntry::where('id', $leave_entry_id)->where('status_id', 44)->update($validate_data);

        return redirect('leave/entry/index')->with('success', 'Successfully Updated');
    }

    public function leaveEntryDestroy($id)
    {
        LeaveEntry::destroy($id);
        return redirect('leave/entry/index')->with('error', 'Successfully Deleted');
    }

    public function getLeaveData()
    {
        $user = User::findOrFail(Auth::id());

        $query = LeaveEntry::with('employee')->where('status_id', 44);
        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->whereHas('employee', function ($q) use ($user) {
                return $q->where('branch_id', $user->role->branch_id);
            });
        }
        $leaveDatas = $query->latest()->get();
        $status = Payload::where('type', 'status')->get();

        return view('leaves.leave-approval', compact('leaveDatas', 'status'));
    }

    public function getSingleLeave($id)
    {
        $leave = LeaveEntry::with(['employee' => function ($q) {
            $q->with('branch');
        }, 'leaveType'])->find($id);
        if (!$leave) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        return response()->json($leave);
    }

    public function leaveApproval(Request $request)
    {
        $validate_data = $this->validate($request, [
            'leave_id'            => 'required|exists:leave_entries,id',
            'accept_from'         => 'required|date',
            'accept_to'           => 'required|date',
            'accepted_no_of_days' => 'required|integer',
            'rejected_reason'     => 'nullable|string',
            'status_id'           => 'required|exists:payloads,id',
        ]);

        $validate_data['accept_from'] = date('Y-m-d', strtotime($validate_data['accept_from']));
        $validate_data['accept_to'] = date('Y-m-d', strtotime($validate_data['accept_to']));

        $leave = LeaveEntry::findOrFail($request->leave_id);
        $leave->update($validate_data);

        return redirect('leave/approval')->with('success', 'Successfully Added');
    }

    public function getAvailableDays(Request $request)
    {
        $leaveTypeId = $request->input('leave_type_id');
        $employeeId = $request->input('employee_id');

        $leaveType = LeaveType::find($leaveTypeId);
        $totalAcceptedDays = LeaveEntry::where('employee_id', $employeeId)
            ->where('leave_type_id', $leaveTypeId)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status_id', 42)
            ->sum('accepted_no_of_days');
        $availableDays = $leaveType->no_of_days - $totalAcceptedDays;
        return response()->json($availableDays);
    }

    public function leaveApplicationForm()
    {
        $leaveTypes = LeaveType::all();
        return view('leaves.leave-application', compact('leaveTypes'));
    }

    public function leaveRegister()
    {
        $branches = Branch::all();
        $labels = DesignationLabel::all();
        $designationInfo = Designation::all();
        $leaveTypes = LeaveType::all();
        $categories = AppraisalCategory::all();
        return view('leaves.leave-register', compact('branches', 'labels', 'leaveTypes', 'categories', 'designationInfo'));
    }

    public function leaveRegisterSearch(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $labels = DesignationLabel::all();
        $designationInfo = Designation::all();
        $leaveTypes = LeaveType::orderBy('id')->get();

        $from_date = date("d-M-Y", strtotime($request->from_date));
        $to_date = date("d-M-Y", strtotime($request->to_date));

        $query = EmployeeInfo::with(['present_designation', 'branch', 'leaveEntry' => function ($q) use ($request) {
            return $q->whereDate('accept_from', '>=', date("Y-m-d", strtotime($request->from_date)))
                ->whereDate('accept_to', '<=', date("Y-m-d", strtotime($request->to_date)))->where('status_id', 42);
        }])->whereHas('leaveEntry', function ($q) use ($request) {
            $q->whereDate('accept_from', '>=', date("Y-m-d", strtotime($request->from_date)))
                ->whereDate('accept_to', '<=', date("Y-m-d", strtotime($request->to_date)))->where('status_id', 42);
        });

        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->where('branch_id', $user->role->branch_id);
        }
        if ($request->designation_label != null)
            $query->where('present_des_label_id', $request->designation_label);
        if ($request->designation != null)
            $query->where('present_designation_id', $request->designation);
        if ($request->branch != null)
            $query->where('branch_id', $request->branch);
        if ($request->leave_type != null)
            $query->whereHas('leaveEntry', function ($q) use ($request) {
                $q->where('leave_type_id', $request->leave_type);
            });
        if ($request->employee_id != null)
            $query->where('id', $request->employee_id);
        if ($request->employee_code != null)
            $query->where('employee_gid', $request->employee_code);

        $employees = $query->latest()->get();

        $perTypeLeaves = array();
        foreach ($employees as $employee) {
            $totalLeavesByType = $employee->leaveEntry->filter(function ($leaveEntry) {
                return Carbon::parse($leaveEntry->accept_from)->year === now()->year;
            })->groupBy('leave_type_id')->map(function ($leaveEntries) {
                return $leaveEntries->sum('no_of_days');
            });
            $perTypeLeaves[] = $totalLeavesByType;
        }

        return  view('leaves.leave-register', compact('employees', 'branches', 'labels', 'leaveTypes', 'from_date', 'to_date', 'perTypeLeaves', 'categories', 'designationInfo'));
    }

    public function leaveStatement($id, Request $request)
    {
        $leaveTypes = LeaveType::all();

        $fromDate = $request->query('from');
        $toDate = $request->query('to');

        $employee = EmployeeInfo::with(['present_designation', 'branch', 'leaveEntry' => function ($q) use ($fromDate, $toDate) {
            return $q->whereDate('accept_from', '>=', date("Y-m-d", strtotime($fromDate)))
                ->whereDate('accept_to', '<=', date("Y-m-d", strtotime($toDate)))->where('status_id', 42);
        }])->where('id', $id)->whereHas('leaveEntry', function ($q) use ($fromDate, $toDate) {
            $q->whereDate('accept_from', '>=', date("Y-m-d", strtotime($fromDate)))
                ->whereDate('accept_to', '<=', date("Y-m-d", strtotime($toDate)))->where('status_id', 42);
        })->first();


        $totalLeavesByType = $employee->leaveEntry->filter(function ($leaveEntry) {
            return Carbon::parse($leaveEntry->accept_from)->year === now()->year;
        })->groupBy('leave_type_id')->map(function ($leaveEntries) {
            return $leaveEntries->sum('no_of_days');
        });

        return view('leaves.leave-statement', compact('leaveTypes', 'employee', 'totalLeavesByType', 'fromDate', 'toDate'));
    }
}
