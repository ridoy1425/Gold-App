<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\AppraisalCategory;
use App\Models\AppraisalEvaluator;
use App\Models\AppraisalMarkComment;
use App\Models\AppraisalSuccessFail;
use App\Models\AttitudeBehavior;
use App\Models\Branch;
use App\Models\BranchCategory;
use App\Models\Designation;
use App\Models\DutyResponsibility;
use App\Models\EmployeeInfo;
use App\Models\EvaluatorComment;
use App\Models\Finance;
use App\Models\HrAdministrative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppraisalController extends Controller
{
    public function getCategoryList()
    {
        $categories = AppraisalCategory::all();
        return view('general-settings.appraisal-category-index', compact('categories'));
    }

    public function createCategory()
    {
        return view('general-settings.appraisal-category');
    }

    public function storeCategory(Request $request)
    {
        $validate_data = $this->validate($request, [
            'name' => 'required|string|unique:appraisal_categories,name',
        ]);

        AppraisalCategory::create($validate_data);

        return redirect('appraisal/category/index')->with('success', 'Successfully Added');
    }

    public function editCategory($id)
    {
        $category = AppraisalCategory::findOrFail($id);
        return view('general-settings.appraisal-category', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validate_data = $this->validate($request, [
            'name' => 'required|string',
        ]);

        $category = AppraisalCategory::findOrFail($id);
        $category->update($validate_data);

        return redirect('appraisal/category/index')->with('success', 'Successfully Updated');
    }

    public function deleteCategory($id)
    {
        AppraisalCategory::destroy($id);
        return redirect('appraisal/category/index')->with('error', 'Successfully Deleted');
    }


    public function  getEvaluatorList()
    {
        $user = User::findOrFail(Auth::id());

        $query = AppraisalEvaluator::with('branch', 'category', 'evaluator');
        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->where('branch_id', $user->role->branch_id);
        }
        $evaluators = $query->orderBy('id')->get();

        $evaluatorData = [];
        foreach ($evaluators as $evaluator) {
            $key = $evaluator->branch_id . '-' . $evaluator->category_id;
            if (!isset($evaluatorData[$key])) {
                $evaluatorData[$key] = [
                    'branch' => $evaluator->branch->name ?? '',
                    'code' => $evaluator->branch->code ?? '',
                    'category' => $evaluator->category->name ?? '',
                    'evaluators' => [],
                    'id' => $evaluator->id,
                ];
            }
            $evaluatorData[$key]['evaluators'][] = $evaluator->evaluator->full_name ?? '';
        }
        return view("appraisal.evaluator-info", compact('evaluatorData'));
    }

    public function createEvaluator()
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        return view('appraisal.evaluator-create', compact('branches', 'categories'));
    }

    public function storeEvaluator(Request $request)
    {
        $this->validate($request, [
            'branch_id'   => 'required|exists:branches,id',
            'category_id' => 'required|exists:appraisal_categories,id',
            'addmore'     => 'required|array',
        ]);

        foreach ($request->addmore as $data) {
            AppraisalEvaluator::create([
                'branch_id' => $request->branch_id,
                'category_id' => $request->category_id,
                'evaluator_id' => $data['evaluator_id'],
            ]);
        }

        return redirect('appraisal/evaluator/index')->with('success', 'Successfully Added');
    }

    public function editEvaluator($id)
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();

        $evaluator = AppraisalEvaluator::findOrFail($id);
        $evaluators = $evaluator->where('branch_id', $evaluator->branch_id)->where('category_id', $evaluator->category_id)->get();
        return view('appraisal.evaluator-create', compact('branches', 'categories', 'evaluators', 'evaluator'));
    }

    public function updateEvaluator(Request $request)
    {
        $this->validate($request, [
            'branch_id'    => 'required|exists:branches,id',
            'category_id'  => 'required|exists:appraisal_categories,id',
            'evaluator_id' => 'required|array',
            'master_id'    => 'required|array',
        ]);

        foreach ($request->master_id as $key => $data) {
            $evaluator = AppraisalEvaluator::findOrFail($data);
            $evaluator->update([
                'branch_id' => $request->branch_id,
                'category_id' => $request->category_id,
                'evaluator_id' => $request->evaluator_id[$key],
            ]);
        }
        AppraisalEvaluator::whereNotIn('id', $request->master_id)->where('branch_id', $request->branch_id)->where('category_id', $request->category_id)->delete();

        if ($request->has('addmore')) {
            foreach ($request->addmore as $data) {
                AppraisalEvaluator::create([
                    'branch_id' => $request->branch_id,
                    'category_id' => $request->category_id,
                    'evaluator_id' => $data['evaluator_id'],
                ]);
            }
        }

        return redirect('appraisal/evaluator/index')->with('success', 'Successfully Updated');
    }

    public function deleteEvaluator($id)
    {
        AppraisalEvaluator::destroy($id);
        return redirect('appraisal/evaluator/index')->with('error', 'Successfully Deleted');
    }

    public function getDutyResponsibilityList()
    {
        $user = User::findOrFail(Auth::id());

        $query = BranchCategory::with('branch', 'category')->whereHas('DutyResponsibility');

        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->where('branch_id', $user->role->branch_id);
        }

        $entities = $query->latest()->get();
        return view('appraisal.duty-responsibility', compact('entities'));
    }

    public function createDutyResponsibility()
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        return view('appraisal.duty-responsibility-create', compact('branches', 'categories'));
    }

    public function storeDutyResponsibility(Request $request)
    {
        $this->validate($request, [
            'branch_id'                     => 'required|exists:branches,id',
            'category_id'                   => 'required|exists:appraisal_categories,id',
            'addmore'                       => 'required|array',
        ]);

        $mainEntity = BranchCategory::firstOrCreate([
            'branch_id' => $request->branch_id,
            'category_id' => $request->category_id
        ]);

        foreach ($request->addmore as $itemData) {
            $mainEntity->DutyResponsibility()->create([
                'branch_category_id'  => $mainEntity->id,
                'duty_responsibility' => $itemData['duty_responsibility'],
                'order'               => $itemData['order'],
                'marks'               => $itemData['marks'],
            ]);
        }

        return redirect('appraisal/responsibility/index')->with('success', 'Successfully Added');
    }

    public function editDutyResponsibility($id)
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();

        $mainEntity = BranchCategory::findOrFail($id);
        return view('appraisal.duty-responsibility-create', compact('branches', 'categories', 'mainEntity'));
    }

    public function updateDutyResponsibility(Request $request, $id)
    {
        $this->validate($request, [
            'branch_id'                     => 'required|exists:branches,id',
            'category_id'                   => 'required|exists:appraisal_categories,id',
            'addmore'                       => 'nullable|array',
        ]);

        $mainEntity = BranchCategory::findOrFail($id);
        $mainEntity->update([
            'branch_id' => $request->branch_id,
            'category_id' => $request->category_id
        ]);

        foreach ($request->master_id as $key => $data) {
            $responsibility = DutyResponsibility::findOrFail($data);
            $responsibility->update([
                'duty_responsibility' => $request->duty_responsibility[$key],
                'order' => $request->order[$key],
                'marks' => $request->marks[$key],
            ]);
        }
        DutyResponsibility::whereNotIn('id', $request->master_id)->where('branch_category_id', $mainEntity->id)->delete();

        if ($request->has('addmore')) {
            foreach ($request->addmore as $itemData) {
                $mainEntity->DutyResponsibility()->create([
                    'branch_category_id'  => $mainEntity->id,
                    'duty_responsibility' => $itemData['duty_responsibility'],
                    'order'               => $itemData['order'],
                    'marks'               => $itemData['marks'],
                ]);
            }
        }

        return redirect('appraisal/responsibility/index')->with('success', 'Successfully updated');
    }

    public function deleteDutyResponsibility($id)
    {
        $entity = BranchCategory::findOrFail($id);
        $entity->DutyResponsibility()->delete();
        if (!$entity->attitudeBehavior()->exists()) {
            $entity->delete();
        }

        return redirect('appraisal/responsibility/index')->with('error', 'Successfully Deleted');
    }

    public function getAttitudeBehaviorList()
    {
        $user = User::findOrFail(Auth::id());

        $query = BranchCategory::with('branch', 'category')->whereHas('attitudeBehavior')->whereHas('hrAdministrative')->whereHas('finance');

        if (!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
            $query->where('branch_id', $user->role->branch_id);
        }

        $entities = $query->latest()->get();
        return view('appraisal.attitude-behavior', compact('entities'));
    }

    public function createAttitudeBehavior()
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        return view('appraisal.attitude-behavior-create', compact('branches', 'categories'));
    }

    public function storeAttitudeBehavior(Request $request)
    {
        $this->validate($request, [
            'branch_id'   => 'required|exists:branches,id',
            'category_id' => 'required|exists:appraisal_categories,id',
            'addmore'     => 'required|array',
            'hr'          => 'required|array',
            'finance'     => 'required|array',
        ]);

        $mainEntity = BranchCategory::firstOrCreate([
            'branch_id'   => $request->branch_id,
            'category_id' => $request->category_id
        ]);

        foreach ($request->addmore as $itemData) {
            $mainEntity->attitudeBehavior()->create([
                'branch_category_id' => $mainEntity->id,
                'attitude_behavior'  => $itemData['attitude_behavior'],
                'order'              => $itemData['order'],
                'marks'              => $itemData['marks'],
            ]);
        }

        foreach ($request->hr as $itemData) {
            $mainEntity->hrAdministrative()->create([
                'branch_category_id' => $mainEntity->id,
                'hr_administrative'  => $itemData['hr_administrative'],
                'order'              => $itemData['hr_order'],
                'marks'              => $itemData['hr_marks'],
            ]);
        }

        foreach ($request->finance as $itemData) {
            $mainEntity->finance()->create([
                'branch_category_id' => $mainEntity->id,
                'finance'            => $itemData['finance'],
                'order'              => $itemData['finance_order'],
                'marks'              => $itemData['finance_marks'],
            ]);
        }

        return redirect('appraisal/behavior/index')->with('success', 'Successfully Added');
    }

    public function editAttitudeBehavior($id)
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();

        $mainEntity = BranchCategory::findOrFail($id);
        return view('appraisal.attitude-behavior-create', compact('branches', 'categories', 'mainEntity'));
    }

    public function updateAttitudeBehavior(Request $request, $id)
    {
        $this->validate($request, [
            'branch_id'   => 'required|exists:branches,id',
            'category_id' => 'required|exists:appraisal_categories,id',
            'addmore'     => 'nullable|array',
            'hr'          => 'nullable|array',
            'finance'     => 'nullable|array',
        ]);

        $mainEntity = BranchCategory::findOrFail($id);
        $mainEntity->update([
            'branch_id' => $request->branch_id,
            'category_id' => $request->category_id
        ]);

        foreach ($request->master_id as $key => $data) {
            $responsibility = AttitudeBehavior::findOrFail($data);
            $responsibility->update([
                'attitude_behavior' => $request->attitude_behavior[$key],
                'order' => $request->order[$key],
                'marks' => $request->marks[$key],
            ]);
        }
        AttitudeBehavior::whereNotIn('id', $request->master_id)->where('branch_category_id', $mainEntity->id)->delete();

        foreach ($request->hr_master_id as $key => $data) {
            $responsibility = HrAdministrative::findOrFail($data);
            $responsibility->update([
                'hr_administrative' => $request->hr_administrative[$key],
                'order'             => $request->hr_order[$key],
                'marks'             => $request->hr_marks[$key],
            ]);
        }
        HrAdministrative::whereNotIn('id', $request->hr_master_id)->where('branch_category_id', $mainEntity->id)->delete();

        foreach ($request->finance_master_id as $key => $data) {
            $responsibility = Finance::findOrFail($data);
            $responsibility->update([
                'finance' => $request->finance_data[$key],
                'order'   => $request->finance_order[$key],
                'marks'   => $request->finance_marks[$key],
            ]);
        }
        Finance::whereNotIn('id', $request->finance_master_id)->where('branch_category_id', $mainEntity->id)->delete();

        if ($request->has('addmore')) {
            foreach ($request->addmore as $itemData) {
                $mainEntity->attitudeBehavior()->create([
                    'branch_category_id' => $mainEntity->id,
                    'attitude_behavior'  => $itemData['attitude_behavior'],
                    'order'              => $itemData['order'],
                    'marks'              => $itemData['marks'],
                ]);
            }
        }

        if ($request->has('hr')) {
            foreach ($request->hr as $itemData) {
                $mainEntity->hrAdministrative()->create([
                    'branch_category_id' => $mainEntity->id,
                    'hr_administrative'  => $itemData['hr_administrative'],
                    'order'              => $itemData['hr_order'],
                    'marks'              => $itemData['hr_marks'],
                ]);
            }
        }

        if ($request->has('finance')) {
            foreach ($request->finance as $itemData) {
                $mainEntity->finance()->create([
                    'branch_category_id' => $mainEntity->id,
                    'finance'            => $itemData['finance'],
                    'order'              => $itemData['finance_order'],
                    'marks'              => $itemData['finance_marks'],
                ]);
            }
        }

        return redirect('appraisal/behavior/index')->with('success', 'Successfully updated');
    }

    public function deleteAttitudeBehavior($id)
    {
        $entity = BranchCategory::findOrFail($id);
        $entity->attitudeBehavior()->delete();
        $entity->hrAdministrative()->delete();
        $entity->finance()->delete();
        if (!$entity->DutyResponsibility()->exists()) {
            $entity->delete();
        }

        return redirect('appraisal/behavior/index')->with('error', 'Successfully Deleted');
    }

    public function getAppraisalList()
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $designations = Designation::all();
        return view('appraisal.appraisal-list', compact('branches', 'categories', 'designations'));
    }

    public function evaluationForm(Request $request)
    {
        $employee_id = $request->query('id');
        $status      = $request->query('status');
        $year        = $request->query('year');

        $employee = EmployeeInfo::findOrFail($employee_id);
        $mainEntity = BranchCategory::where('branch_id', $employee->branch_id)->where('category_id', $employee->appraisal_category_id)->first();
        $evaluators = AppraisalEvaluator::where('branch_id', $employee->branch_id)->where('category_id', $employee->appraisal_category_id)->get();

        if ($status == "approved") {
            $appraisal = Appraisal::where('employee_id', $employee_id)->whereRaw('YEAR(evaluation_date) = ?', [$year])->first();

            return view('appraisal.appraisal-form', compact('mainEntity', 'evaluators', 'employee_id', 'appraisal', 'employee'));
        }
        return view('appraisal.appraisal-form', compact('mainEntity', 'evaluators', 'employee_id', 'employee'));
    }

    public function evaluationFormSubmit(Request $request)
    {
        $this->validate($request, [
            'evaluation_date'  => 'required|date',
            'letter_send'      => 'required|string',
            'period_from'      => 'required|date',
            'period_to'        => 'required|date',
            'letter_sent_date' => 'required|date',
            'duty'             => 'nullable|array',
            'attitude'         => 'nullable|array',
            'hr'               => 'nullable|array',
            'finance'          => 'nullable|array',
            'evaluationMark'   => 'nullable|array',
            'limitationMark'   => 'nullable|array',
            'limitationMark'   => 'nullable|array',
        ]);

        $appraisal = Appraisal::updateOrCreate([
            'id' => $request->appraisal_id,
            'employee_id' => $request->employee_id,
        ], [
            'evaluation_date' => date('Y-m-d', strtotime($request->evaluation_date)),
            'period_from' => date('Y-m-d', strtotime($request->period_from)),
            'period_to' => date('Y-m-d', strtotime($request->period_to)),
            'letter_send' => $request->letter_send,
            'letter_sent_date' => date('Y-m-d', strtotime($request->letter_sent_date)),
        ]);

        if ($request->has('duty')) {
            foreach ($request->duty as $duty) {
                AppraisalMarkComment::updateOrCreate([
                    'appraisal_id' => $appraisal->id,
                    'type'         => 'duty',
                    'type_id'      => $duty['id'],
                ], [
                    'mark'         => $duty['mark'],
                    'comment'      => $duty['comment'],
                ]);
            }
        }

        if ($request->has('attitude')) {
            foreach ($request->attitude as $attitude) {
                AppraisalMarkComment::updateOrCreate(
                    [
                        'appraisal_id' => $appraisal->id,
                        'type'         => 'attitude',
                        'type_id'      => $attitude['id'],
                    ],
                    [
                        'mark'         => $attitude['mark'],
                        'comment'      => $attitude['comment'],
                    ]
                );
            }
        }

        if ($request->has('hr')) {
            foreach ($request->hr as $hr) {
                AppraisalMarkComment::updateOrCreate([
                    'appraisal_id' => $appraisal->id,
                    'type'         => 'hr',
                    'type_id'      => $hr['id'],
                ], [
                    'mark'         => $hr['mark'],
                    'comment'      => $hr['comment'],
                ]);
            }
        }

        if ($request->has('finance')) {
            foreach ($request->finance as $finance) {
                AppraisalMarkComment::updateOrCreate(
                    [
                        'appraisal_id' => $appraisal->id,
                        'type'         => 'finance',
                        'type_id'      => $finance['id'],
                    ],
                    [
                        'mark'         => $finance['mark'],
                        'comment'      => $finance['comment'],
                    ]
                );
            }
        }

        if ($request->has('evaluationMark')) {
            $existingRecord = AppraisalSuccessFail::where('appraisal_id', $appraisal->id)
                ->where('type', 'evaluation')
                ->pluck('id')->toArray();
            foreach ($request->evaluationMark as $key => $evaluation) {
                if ($existingRecord) {
                    AppraisalSuccessFail::where('id', $existingRecord[$key])->update(['comment' => $evaluation]);
                } else {
                    AppraisalSuccessFail::create([
                        'appraisal_id' => $appraisal->id,
                        'type'         => 'evaluation',
                        'comment'      => $evaluation,
                    ]);
                }
            }
        }

        if ($request->has('limitationMark')) {
            $existingRecord = AppraisalSuccessFail::where('appraisal_id', $appraisal->id)
                ->where('type', 'limitation')
                ->pluck('id')->toArray();

            foreach ($request->limitationMark as $key => $limitation) {
                if ($existingRecord) {
                    AppraisalSuccessFail::where('id', $existingRecord[$key])->update(['comment' => $limitation]);
                } else {
                    AppraisalSuccessFail::create([
                        'appraisal_id' => $appraisal->id,
                        'type'         => 'limitation',
                        'comment'      => $limitation,
                    ]);
                }
            }
        }

        if ($request->has('developMark')) {
            $existingRecord = AppraisalSuccessFail::where('appraisal_id', $appraisal->id)
                ->where('type', 'development')
                ->pluck('id')->toArray();
            foreach ($request->developMark as $key => $development) {
                if ($existingRecord) {
                    AppraisalSuccessFail::where('id', $existingRecord[$key])->update(['comment' => $development]);
                } else {
                    AppraisalSuccessFail::create([
                        'appraisal_id' => $appraisal->id,
                        'type' => 'development',
                        'comment' => $development,
                    ]);
                }
            }
        }

        if ($request->has('staff_comment')) {
            EvaluatorComment::updateOrCreate([
                'appraisal_id' => $appraisal->id,
                'appraisal_evaluator_id' => null
            ], [
                'comment'      => $request->staff_comment,
            ]);
        }
        if ($request->has('evaluator')) {
            foreach ($request->evaluator as $evaluator) {
                EvaluatorComment::updateOrCreate(
                    [
                        'appraisal_id'           => $appraisal->id,
                        'appraisal_evaluator_id' => $evaluator['id'],
                    ],
                    [
                        'comment'                => $evaluator['comment'],
                    ]
                );
            }
        }
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $designations = Designation::all();
        return view('appraisal.appraisal-list', compact('branches', 'categories', 'designations'))->with('success', 'Successfully added');
    }

    public function reportList()
    {
        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $designations = Designation::all();
        return view('appraisal.evaluation-list', compact('branches', 'categories', 'designations'));
    }

    public function commonSearch(Request $request, $viewName)
    {

        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $designations = Designation::all();

        $query = EmployeeInfo::with(['present_designation', 'branch', 'appraisalCategory']);

        if ($request->branch != null)
            $query->where('branch_id', $request->branch);
        if ($request->category != null)
            $query->where('appraisal_category_id', $request->category);
        if ($request->designation != null)
            $query->where('present_designation_id', $request->designation);
        if ($request->employee_id != null)
            $query->where('id', $request->employee_id);

        if ($request->status == 'pending') {
            if ($request->year != null) {
                $query->whereDoesntHave('appraisal', function ($query) use ($request) {
                    $query->whereRaw('YEAR(evaluation_date) = ?', [$request->year]);
                });
            } else {
                $query->whereDoesntHave('appraisal');
            }
        }
        if ($request->status == 'approved') {
            if ($request->year != null) {
                $query->whereHas('appraisal', function ($query) use ($request) {
                    $query->whereRaw('YEAR(evaluation_date) = ?', [$request->year]);
                });
            } else {
                $query->whereHas('appraisal');
            }
        }

        $employees = $query->latest()->get();
        $status = $request->status;
        $year = $request->year;
        $branch_id = $request->branch;
        $category_id = $request->category;

        return  view($viewName, compact('employees', 'branches', 'categories', 'designations', 'status', 'year', 'branch_id', 'category_id'));
    }

    public function appraisalSearch(Request $request)
    {
        return $this->commonSearch($request, 'appraisal.appraisal-list');
    }

    public function evaluationSearch(Request $request)
    {
        return $this->commonSearch($request, 'appraisal.evaluation-list');
    }

    public function appraisalReport(Request $request)
    {
        $employee_id = $request->query('id');
        $status      = $request->query('status');
        $year        = $request->query('year');

        $employee = EmployeeInfo::findOrFail($employee_id);
        $mainEntity = BranchCategory::where('branch_id', $employee->branch_id)->where('category_id', $employee->appraisal_category_id)->first();
        $evaluators = AppraisalEvaluator::where('branch_id', $employee->branch_id)->where('category_id', $employee->appraisal_category_id)->get();


        $appraisal = Appraisal::where('employee_id', $employee_id)->whereRaw('YEAR(evaluation_date) = ?', [$year])->first();
        $last_appraisal = Appraisal::where('employee_id', $employee_id)->whereRaw('YEAR(evaluation_date) = ?', [$year - 1])->first()->evaluation_date ?? '';

        return view('appraisal.appraisal-report', compact('mainEntity', 'evaluators', 'employee_id', 'appraisal', 'employee', 'last_appraisal'));
    }

    public function appraisalSummaryReport(Request $request)
    {
        if ($request->has('branch')) {
            return $this->commonSearch($request, 'appraisal.summary-report');
        }

        $branches = Branch::all();
        $categories = AppraisalCategory::all();
        $designations = Designation::all();
        return view('appraisal.summary-report', compact('branches', 'categories', 'designations'));
    }
}
