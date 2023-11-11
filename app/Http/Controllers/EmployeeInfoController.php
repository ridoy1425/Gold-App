<?php

namespace App\Http\Controllers;

use App\Models\AcademicInfo;
use App\Models\Address;
use App\Models\AppraisalCategory;
use App\Models\Attachment;
use App\Models\Branch;
use App\Models\Designation;
use App\Models\DesignationLabel;
use App\Models\EmployeeInfo;
use App\Models\EmploymentInfo;
use App\Models\FamilyMember;
use App\Models\NomineeInfo;
use App\Models\OtherInfo;
use App\Models\Payload;
use App\Models\ProfessionalInfo;
use App\Models\PromotionInfo;
use App\Models\SalaryInfo;
use App\Models\TrainingInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\AttachmentTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class EmployeeInfoController extends Controller
{
    use AttachmentTrait;

    public function getEmployeeInfo()
    {
        $branches = Branch::all();
        $labels = DesignationLabel::all();
        $payloads = Payload::all();
        $categories = AppraisalCategory::all();
        $designations = Designation::all();

        $user = Auth::user();
        $userInfo = null;
        if ($user->hasRole('employee'))
            $userInfo = EmployeeInfo::findOrFail($user->employee_id);

        return view('employees.employee-info', compact('categories', 'designations', 'userInfo'))->with('branches', $branches)->with('labels', $labels)->with('payloads', $payloads);
    }

    public function employeeInfoStore(Request $request)
    {
        $validate_data = $this->validate($request, [
            'full_name'              => 'required|string',
            'full_name_bn'           => 'required|string',
            'father_name'            => 'nullable|string',
            'father_name_bn'         => 'nullable|string',
            'joining_des_label_id'   => 'nullable|exists:designation_labels,id',
            'joining_date'           => 'nullable|string',
            'joining_age'            => 'nullable|string',
            'present_joining_date'   => 'nullable|string',
            'present_joining_age'    => 'nullable|string',
            'appraisal_category_id'  => 'nullable|exists:appraisal_categories,id',
            'dob'                    => 'nullable|string',
            'today_age'              => 'nullable|string',
            'spouse_name'            => 'nullable|string',
            'spouse_name_bn'         => 'nullable|string',
            'spouse_occupation'      => 'nullable|string',
            'telephone_no'           => 'nullable|string',
            'national_id'            => 'nullable|string',
            'tin_no'                 => 'nullable|string',
            'branch_id'              => 'required|exists:branches,id',
            'present_des_label_id'   => 'nullable|exists:designation_labels,id',
            'joining_designation_id' => 'nullable|exists:designations,id',
            'mobile_no'              => 'nullable|string',
            'passport_no'            => 'nullable|string',
            'mother_name'            => 'nullable|string',
            'mother_name_bn'         => 'nullable|string',
            'present_designation_id' => 'nullable|exists:designations,id',
            'nationality'            => 'nullable|string',
            'religion_id'            => 'nullable|exists:payloads,id',
            'marital_status_id'      => 'nullable|exists:payloads,id',
            'spouse_nationality'     => 'nullable|string',
            'alt_mobile_no'          => 'nullable|string',
            'blood_group_id'         => 'nullable|exists:payloads,id',
            'gender_id'              => 'required|exists:payloads,id',
            'type_id'                => 'required|exists:payloads,id',
            'status_id'              => 'required|exists:payloads,id',
            'status_date'            => 'nullable',
        ]);

        $validate_data['status_date'] = $request->status_date ?? now();

        if ($request->employee_id != null) {
            $employee = EmployeeInfo::find($request->employee_id);
            if ($employee->branch_id != $validate_data['branch_id']) {
                $branch = Branch::find($validate_data['branch_id']);
                $branchCode = $branch->code;

                $employeeCount = EmployeeInfo::where('branch_id', $validate_data['branch_id'])->count();
                $formattedCount = sprintf('%03d', $employeeCount + 1);

                $employee_gid = 'YWCA/' . $branchCode . '/' . $formattedCount;
                $validate_data['employee_gid'] = $employee_gid;
            }
            $employee->update($validate_data);
        } else {
            $branch = Branch::find($validate_data['branch_id']);
            $branchCode = $branch->code;

            $employeeCount = EmployeeInfo::where('branch_id', $validate_data['branch_id'])->count();
            $formattedCount = sprintf('%03d', $employeeCount + 1);

            $employee_gid = 'YWCA/' . $branchCode . '/' . $formattedCount;
            $validate_data['employee_gid'] = $employee_gid;
            $employee = EmployeeInfo::create($validate_data);
        }

        return response()->json([
            'message' => 'Successfully Added',
            'employee_id' => $employee->id
        ]);
    }

    public function employeeAddressStore(Request $request)
    {
        if ($request->has('employee_id')) {
            $validate_data = $this->validate($request, [
                'employee_id'                 => 'required|exists:employee_infos,id',
                'present_house'               => 'required|string',
                'present_house_bn'            => 'required|string',
                'present_road_no'             => 'nullable|string',
                'present_road_no_bn'          => 'nullable|string',
                'present_post_off'            => 'nullable|string',
                'present_post_off_bn'         => 'nullable|string',
                'present_district'            => 'nullable|string',
                'present_district_bn'         => 'nullable|string',
                'permanent_village'           => 'required|string',
                'permanent_village_bn'        => 'required|string',
                'permanent_post_off'          => 'nullable|string',
                'permanent_post_off_bn'       => 'nullable|string',
                'permanent_police_station'    => 'nullable|string',
                'permanent_police_station_bn' => 'nullable|string',
                'permanent_district'          => 'nullable|string',
                'permanent_district_bn'       => 'nullable|string',
            ]);
            Address::updateOrCreate(
                ['employee_id' =>  $request->employee_id],
                $validate_data
            );

            return response()->json([
                'message' => 'Successfully Added'
            ]);
        }
        return response()->json([
            'message' => 'Please Insert Basic Information'
        ]);
    }
    public function profileImageStore(Request $request)
    {
        if ($request->has('employee_id')) {
            $this->validate($request, [
                'employee_id'   => 'required|exists:employee_infos,id',
                'profile_image' => $this->getAttachmentValidationRules('image'),
            ]);
            $image = Attachment::where('attachable_id', $request->employee_id)->first();
            if ($image)
                $image->delete();

            $document_data = [
                'attachable_type' => EmployeeInfo::class,
                'attachable_id' => $request->employee_id,
                'file_type' => 'profile_image',
            ];
            $this->createAttachment($document_data, $request->profile_image);
            return response()->json([
                'message' => 'Profile image Successfully Added'
            ]);
            return response()->json([
                'message' => 'Profile image already exists'
            ]);
        }
        return response()->json([
            'message' => 'Please Insert Basic Information'
        ]);
    }


    private function handleInfoType($modelClass, $request)
    {
        $get_ids = array();
        if ($request->has('addmore')) {
            foreach ($request->addmore as $info) {
                $info['employee_id'] = $request->employee_id;
                if (isset($info['id'])) {
                    $model = $modelClass::find($info['id']);
                    $model->update($info);
                } else {
                    $model = $modelClass::create($info);
                    if (isset($info['attachment'])) {
                        foreach ($info['attachment'] as $image) {
                            $document_data = [
                                'attachable_type' => $modelClass,
                                'attachable_id' => $model->id,
                                'file_type' => 'file',
                            ];
                            $this->createAttachment($document_data, $image);
                        }
                    }
                }
                $get_ids[] = $model->id;
            }
        }

        if ($request->has('attachment')) {
            foreach ($request->attachment as $key => $attachment) {
                foreach ($attachment as $image) {
                    $document_data = [
                        'attachable_type' => $modelClass,
                        'attachable_id' => $get_ids[$key],
                        'file_type' => 'file',
                    ];
                    $this->createAttachment($document_data, $image);
                }
            }
        }

        $infoIds = $modelClass::where('employee_id', $request->employee_id)
            ->whereNotIn('id', $get_ids)
            ->pluck('id')
            ->toArray();

        if (!empty($infoIds)) {
            Attachment::whereIn('attachable_id', $infoIds)
                ->where('attachable_type', $modelClass)
                ->get()
                ->each(function ($attachment) {
                    Storage::disk('public')->delete($attachment->file_path);
                    $attachment->delete();
                });

            $modelClass::whereIn('id', $infoIds)->delete();
        }

        return response()->json(['message' => 'Successfully Added']);
    }

    public function employeeAcademicInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $this->validate($request, [
                'employee_id'            => 'required|exists:employee_infos,id',
                'addmore.*.degree_id'    => 'required|exists:payloads,id',
                'addmore.*.institute'    => 'required|string',
                'addmore.*.pass_yr'      => 'required|string',
                'addmore.*.grade'        => 'required|string',
                'addmore.*.discipline'   => 'required|string',
                'addmore.*.attachment.*' => $this->getAttachmentValidationRules('file'),
            ]);
            return $this->handleInfoType(AcademicInfo::class, $request);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function employmentInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $this->validate($request, [
                'employee_id'             => 'required|exists:employee_infos,id',
                'addmore.*.org_name'      => 'required|string',
                'addmore.*.org_address'   => 'required|string',
                'addmore.*.last_position' => 'required|string',
                'addmore.*.service_from'  => 'required|string',
                'addmore.*.service_to'    => 'required|string',
                'addmore.*.separation'    => 'required|string',
                'addmore.*.attachment.*' => $this->getAttachmentValidationRules('file'),
            ]);

            return $this->handleInfoType(EmploymentInfo::class, $request);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function professionalInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $this->validate($request, [
                'employee_id'             => 'required|exists:employee_infos,id',
                'addmore.*.degree'        => 'required|string',
                'addmore.*.institute'     => 'required|string',
                'addmore.*.duration_from' => 'required|string',
                'addmore.*.duration_to'   => 'required|string',
                'addmore.*.grade'         => 'required|string',
                'addmore.*.area'          => 'required|string',
                'addmore.*.attachment.*' => $this->getAttachmentValidationRules('file'),
            ]);
            return $this->handleInfoType(ProfessionalInfo::class, $request);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function trainingInfo(Request $request)
    {

        if ($request->has('employee_id')) {
            $this->validate($request, [
                'employee_id'             => 'required|exists:employee_infos,id',
                'addmore.*.training'      => 'required|string',
                'addmore.*.institute'     => 'required|string',
                'addmore.*.org_by'        => 'required|string',
                'addmore.*.topic'         => 'required|string',
                'addmore.*.duration_from' => 'required|string',
                'addmore.*.duration_to'   => 'required|string',
            ]);
            return $this->handleInfoType(TrainingInfo::class, $request);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function othersInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $validate_data = $this->validate($request, [
                'employee_id'   => 'required|exists:employee_infos,id',
                'mother_tongue' => 'string',
                'language'      => 'string',
                'skill'         => 'string',
            ]);

            OtherInfo::updateOrCreate(
                ['employee_id' =>  $request->employee_id],
                $validate_data
            );
            return response()->json(['message' => 'Successfully Added']);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function familyInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $family = FamilyMember::where('employee_id', $request->employee_id)->get();
            if (count($family) > 0) {
                foreach ($family as $row) {
                    $row->delete();
                }
            }
            $this->validate($request, [
                'employee_id'          => 'required|exists:employee_infos,id',
                'addmore.*.name'       => 'required|string',
                'addmore.*.dob'        => 'required|string',
                'addmore.*.age'        => 'required|string',
                'addmore.*.relation'   => 'required|string',
                'addmore.*.occupation' => 'nullable|string',
            ]);

            foreach ($request->addmore as $info) {
                $info['employee_id'] = $request->employee_id;
                FamilyMember::create($info);
            }
            return response()->json(['message' => 'Successfully Added']);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function nomineeInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $nominee = NomineeInfo::where('employee_id', $request->employee_id)->get();
            if (count($nominee) > 0) {
                foreach ($nominee as $row) {
                    $row->delete();
                }
            }
            $this->validate($request, [
                'employee_id'          => 'required|exists:employee_infos,id',
                'addmore.*.name'       => 'required|string',
                'addmore.*.dob'        => 'required|string',
                'addmore.*.relation'   => 'required|string',
                'addmore.*.occupation' => 'nullable|string',
                'addmore.*.address'    => 'nullable|string',
                'addmore.*.amount'     => 'required|string',
            ]);

            foreach ($request->addmore as $info) {
                $info['employee_id'] = $request->employee_id;
                NomineeInfo::create($info);
            }

            return response()->json(['message' => 'Successfully Added']);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function salaryInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $validate_data = $this->validate($request, [
                'employee_id'       => 'required|exists:employee_infos,id',
                'salary_grade'      => 'nullable|integer',
                'basic_salary'      => 'nullable|integer',
                'conveyance'        => 'nullable|integer',
                'arban_allowance'   => 'nullable|integer',
                'pay_step'          => 'nullable|integer',
                'house_rent'        => 'nullable|integer',
                'medical_allowance' => 'nullable|integer',
                'note'              => 'nullable|string',
            ]);

            SalaryInfo::updateOrCreate(
                ['employee_id' =>  $request->employee_id],
                $validate_data
            );
            return response()->json(['message' => 'Successfully Added']);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function promotionInfo(Request $request)
    {
        if ($request->has('employee_id')) {
            $this->validate($request, [
                'employee_id'              => 'required|exists:employee_infos,id',
                'addmore.*.designation_id' => 'required|exists:designations,id',
                'addmore.*.effective_date' => 'required|string',
                'addmore.*.salary'         => 'required|integer',
                'addmore.*.salary_grade'   => 'required|integer',
                'addmore.*.pay_step'       => 'required|integer',
            ]);
            return $this->handleInfoType(PromotionInfo::class, $request);
        }
        return response()->json(['message' => 'Please Insert Basic Information']);
    }

    public function employeeSearch(Request $request)
    {
        // dd($request->branch_id, $request->category);
        $user = User::findOrFail(Auth::id());

        if ((!$request->search_value) && (!$request->search_by)) {
            $employees = [];
            return response()->json($employees);
        }

        $query = EmployeeInfo::with('branch', 'appraisalCategory');
        if (($request->search_value) && ($request->search_by != 'all')) {
            $query->where($request->search_by, 'LIKE', '%' . $request->search_value . '%');
        }

        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->where('branch_id', $user->role->branch_id);
        }

        if ($request->branch_id)
            $query->where('branch_id', $request->branch_id);

        if ($request->category)
            $query->where('appraisal_category_id', $request->category);

        $employees =  $query->latest()->get()->toArray();
        return response()->json($employees);
    }

    public function employeeEdit($id)
    {
        $employee = EmployeeInfo::with(['address', 'academy' => function ($q) {
            return $q->with('attachments');
        }, 'employment' => function ($q) {
            return $q->with('attachments');
        }, 'profession' => function ($q) {
            return $q->with('attachments');
        }, 'training' => function ($q) {
            return $q->with('attachments');
        }, 'others', 'family' => function ($q) {
            return $q->with('attachments');
        }, 'nominee', 'salary', 'attachment', 'present_des_label', 'joining_des_label', 'present_designation', 'joining_designation', 'branch', 'religion', 'marital_status', 'blood_group', 'promotions'])->find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        return response()->json($employee);
    }

    public function employeeList()
    {
        $branches = Branch::all();
        $labels = DesignationLabel::all();
        $payloads = Payload::all();
        return view('employees.employee-search')->with('branches', $branches)->with('labels', $labels)->with('payloads', $payloads);
    }

    public function reportSearch(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $branches = Branch::all();
        $labels = DesignationLabel::all();
        $payloads = Payload::all();

        $query = EmployeeInfo::with('present_designation', 'branch', 'religion', 'academy');

        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->where('branch_id', $user->role->branch_id);
        }
        if ($request->employee_id != null)
            $query->where('employee_gid', 'LIKE', '%' . $request->employee_id . '%');
        if ($request->designation_label != null)
            $query->where('present_des_label_id', $request->designation_label);
        if ($request->designation != null)
            $query->where('present_designation_id', $request->designation);
        if ($request->branch != null)
            $query->where('branch_id', $request->branch);
        if ($request->age_range != null) {
            $ageRange = (int)$request->age_range;
            $endDate = Carbon::now();
            $startDate = $endDate->copy()->subYears($ageRange);
            $query->where(DB::raw('STR_TO_DATE(dob, "%Y-%m-%d")'), '<', $startDate->toDateString());
        }
        if ($request->religion != null)
            $query->where('religion_id', $request->religion);
        if ($request->degree != null) {
            $query->whereHas('academy', function ($q) use ($request) {
                $q->where('degree_id', $request->degree);
            });
        }

        $employees = $query->latest()->get();

        return  view('employees.employee-search', compact('employees', 'branches', 'labels', 'payloads'));
    }

    public function reportPage($id)
    {
        $employee = EmployeeInfo::with(['address', 'academy' => function ($q) {
            return $q->with('degree');
        }, 'employment', 'profession', 'training', 'others', 'family', 'nominee', 'attachment', 'present_des_label', 'joining_des_label', 'present_designation', 'joining_designation', 'branch', 'religion', 'marital_status', 'blood_group'])->find($id);
        return view('employees.report-generate', compact('employee'));
    }

    public function getDegree()
    {
        $degrees = Payload::where('type', 'degree')->orderBy('id')->get();
        return response()->json([
            'degrees' => $degrees
        ]);
    }

    public function employeeDelete($id)
    {
        EmployeeInfo::destroy($id);

        return redirect()->back()->with('error', "Successfully Separated");
    }

    public function staffSummaryReport()
    {
        $branches = Branch::all();
        $labels = DesignationLabel::all();
        $payloads = Payload::all();
        return view('employees.summary-report')->with('branches', $branches)->with('labels', $labels)->with('payloads', $payloads);
    }

    public function searchSummaryReport(Request $request)
    {
        $branches = Branch::all();
        $selectedYear = $request->year;
        $query = EmployeeInfo::with('branch');

        if ($request->branch != null)
            $query->where('branch_id', $request->branch);

        $employees = $query->latest()->get()->groupBy('branch_id');
        return  view('employees.summary-report', compact('employees', 'branches', 'selectedYear'));
    }
}
