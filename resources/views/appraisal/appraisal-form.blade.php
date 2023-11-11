@extends('ui.admin_panel.master')

@section('title', 'Evaluation Form')

@section('style')
    <style>
        .display {
            display: none;
        }

        p {
            font-size: 12px;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Evaluation Form</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- message alert --}}
            <div class="alert_message mt-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success" role="success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="success">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>
            <form action="{{ url('appraisal/form') }}" method="post" autocomplete="off">
                @csrf
                @if (isset($appraisal))
                    <input type="hidden" name="appraisal_id" value="{{ $appraisal->id }}">
                @endif
                <input type="hidden" name="employee_id" value="{{ $employee_id }}">
                {{-- card-body start --}}
                <div class="card card-default">
                    <div class="card-body">
                        <div class="propertyContent">
                            <h6>Evaluation Form Data</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label for="evaluation_date" class="col-sm-3 col-form-label col-form-label-sm">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="employee_name" id="employee_name"
                                                class="form-control form-control-sm"
                                                value="{{ old('employee_name', $employee->full_name ?? '') }}" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="evaluation_date" class="col-sm-3 col-form-label col-form-label-sm">
                                            Evaluation
                                            Date
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="evaluation_date" id="evaluation_date"
                                                class="form-control form-control-sm datepicker"
                                                value="{{ old('evaluation_date', $appraisal->evaluation_date ?? '') }}" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_send" class="col-sm-3 col-form-label col-form-label-sm">Letter
                                            Send
                                        </label>
                                        <div class="col-sm-9">
                                            <select class="form-select-sm form-select" id="letter_send" name="letter_send">
                                                <option selected disabled value="">Choose...</option>
                                                <option value="yes"
                                                    @if (isset($appraisal)) {{ $appraisal->letter_send == 'yes' ? 'selected' : '' }} @endif>
                                                    Yes
                                                </option>
                                                <option value="no"
                                                    @if (isset($appraisal)) {{ $appraisal->letter_send == 'no' ? 'selected' : '' }} @endif>
                                                    No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label for="evaluation_date" class="col-sm-3 col-form-label col-form-label-sm">
                                            Designation
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="designation" id="designation"
                                                class="form-control form-control-sm"
                                                value="{{ old('present_designation', $employee->present_designation->designation  ?? '') }}" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="category_id" class="col-sm-3 col-form-label col-form-label-sm">
                                            Evaluation
                                            Period
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="From"
                                                value="{{ old('period_from', $appraisal->period_from ?? '') }}"
                                                class="form-control form-control-sm datepicker" id="period_from"
                                                name="period_from" required>
                                        </div>
                                        <div class="col-sm-1">
                                            -
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="To"
                                                value="{{ old('period_to', $appraisal->period_to ?? '') }}"
                                                class="form-control form-control-sm datepicker" id="period_to"
                                                name="period_to" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="letter_sent_date"
                                            class="col-sm-3 col-form-label col-form-label-sm">Letter
                                            Sent
                                            Date
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="letter_sent_date" id="letter_sent_date"
                                                class="form-control form-control-sm datepicker"
                                                value="{{ old('letter_sent_date', $appraisal->letter_sent_date ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="first_part ">
                                <h6>প্রথম অংশঃ দায়িত্ব ও কর্তব্যসমূহ</h6>
                                <p>ক. দায়-দায়িত্বঃ</p>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 9%;">ক্রমিক নং</th>
                                            <th>দায়-দায়িত্ব ও কাজ</th>
                                            <th style="width: 20%;">প্রাপ্ত দায়িত্বের অর্জনসমূহ</th>
                                            <th style="width: 25%;">মান নির্ধারক</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (optional($mainEntity)->DutyResponsibility)
                                            @php
                                                $total_mark_count = 0;
                                            @endphp
                                            @foreach ($mainEntity->DutyResponsibility->sortBy('order') as $key => $item)
                                                @if (isset($appraisal))
                                                    @php
                                                        $dutyResponsibility = $appraisal
                                                            ->duty_responsibility()
                                                            ->where('type_id', $item->id)
                                                            ->first();
                                                    @endphp
                                                @else
                                                    @php
                                                        $dutyResponsibility = null;
                                                    @endphp
                                                @endif
                                                <input type="hidden" name="duty[{{ $key }}][id]"
                                                    value="{{ $item->id }}" readonly>
                                                <tr>
                                                    <td>{{ $item->order }}</td>
                                                    <td>{{ $item->duty_responsibility }}</td>
                                                    <td><input type="text" name="duty[{{ $key }}][mark]"
                                                            class="form-control form-control-sm"
                                                            value="{{ old('mark', optional($dutyResponsibility)->mark) }}">
                                                    </td>
                                                    <td><input type="text" name="duty[{{ $key }}][comment]"
                                                            class="form-control form-control-sm"
                                                            value="{{ old('comment', optional($dutyResponsibility)->comment) }}">
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_mark_count += $dutyResponsibility->mark ?? 0;
                                                @endphp
                                            @endforeach
                                        @endif
                                        <tr class="text-center">
                                            <td colspan="2">মোট</td>
                                            <td>{{ $total_mark_count ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>খ. কর্মীর ব্যক্তিগত মনোভাব ও আচরনঃ</p>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>মনোভাব ও আচরন সংক্রান্ত বিষয়াদি</th>
                                            <th style="width: 10%;">নম্বর</th>
                                            <th style="width: 10%;">প্রাপ্ত নম্বর</th>
                                            <th style="width: 25%;">মন্তব্য</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_attitude_mark = 0;
                                        @endphp
                                        @if (optional($mainEntity)->attitudeBehavior)
                                            @foreach ($mainEntity->attitudeBehavior->sortBy('order') as $key => $item)
                                                @if (isset($appraisal))
                                                    @php
                                                        $attitude = $appraisal
                                                            ->attitude_behavior()
                                                            ->where('type_id', $item->id)
                                                            ->first();
                                                    @endphp
                                                @else
                                                    @php
                                                        $attitude = null;
                                                    @endphp
                                                @endif
                                                <input type="hidden" name="attitude[{{ $key }}][id]"
                                                    value="{{ $item->id }}" readonly>
                                                <tr>
                                                    <td>{{ $item->attitude_behavior }}</td>
                                                    <td>{{ $item->marks }}</td>
                                                    <td><input type="text" name="attitude[{{ $key }}][mark]"
                                                            class="form-control form-control-sm"
                                                            value="{{ old('mark', optional($attitude)->mark) }}">
                                                    </td>
                                                    <td><input type="text"
                                                            name="attitude[{{ $key }}][comment]"
                                                            class="form-control form-control-sm"
                                                            value="{{ old('comment', optional($attitude)->comment) }}">
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_attitude_mark += $attitude->mark ?? 0;
                                                @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>এইচআর ও প্রশাসন সংক্রান্ত বিষয়াদি</th>
                                            <th style="width: 10%;">নম্বর</th>
                                            <th style="width: 10%;">প্রাপ্ত নম্বর</th>
                                            <th style="width: 25%;">মন্তব্য</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_hr_mark = 0;
                                        @endphp
                                        @if (optional($mainEntity)->hrAdministrative)
                                            @foreach ($mainEntity->hrAdministrative->sortBy('order') as $key => $item)
                                                @if (isset($appraisal))
                                                    @php
                                                        $hr = $appraisal
                                                            ->hr_administrative()
                                                            ->where('type_id', $item->id)
                                                            ->first();
                                                    @endphp
                                                @else
                                                    @php
                                                        $hr = null;
                                                    @endphp
                                                @endif
                                                <input type="hidden" name="hr[{{ $key }}][id]"
                                                    value="{{ $item->id }}" readonly>
                                                <tr>
                                                    <td>{{ $item->hr_administrative }}</td>
                                                    <td>{{ $item->marks }}</td>
                                                    <td><input type="text" name="hr[{{ $key }}][mark]"
                                                            class="form-control form-control-sm"
                                                            value="{{ old('mark', optional($hr)->mark) }}"></td>
                                                    <td><input type="text" name="hr[{{ $key }}][comment]"
                                                            class="form-control form-control-sm"
                                                            value="{{ old('comment', optional($hr)->comment) }}"></td>
                                                </tr>
                                                @php
                                                    $total_hr_mark += $hr->mark ?? 0;
                                                @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>আর্থিক লেনদেন সংক্রান্ত বিষয়াদি</th>
                                            <th style="width: 10%;">নম্বর</th>
                                            <th style="width: 10%;">প্রাপ্ত নম্বর</th>
                                            <th style="width: 25%;">মন্তব্য</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_finance_mark = 0;
                                        @endphp
                                        @if (optional($mainEntity)->finance)
                                            @foreach ($mainEntity->finance->sortBy('order') as $key => $item)
                                                @if (isset($appraisal))
                                                    @php
                                                        $finance = $appraisal
                                                            ->finance()
                                                            ->where('type_id', $item->id)
                                                            ->first();
                                                    @endphp
                                                @else
                                                    @php
                                                        $finance = null;
                                                    @endphp
                                                @endif
                                                <input type="hidden" name="finance[{{ $key }}][id]"
                                                    value="{{ $item->id }}" readonly>
                                                <tr>
                                                    <td>{{ $item->finance }}</td>
                                                    <td>{{ $item->marks }}</td>
                                                    <td><input type="text" name="finance[{{ $key }}][mark]"
                                                            class="form-control form-control-sm finance-mark"
                                                            value="{{ old('mark', optional($finance)->mark) }}"></td>
                                                    <td><input type="text"
                                                            name="finance[{{ $key }}][comment]"
                                                            class="form-control form-control-sm "
                                                            value="{{ old('comment', optional($finance)->comment) }}">
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_finance_mark += $finance->mark ?? 0;
                                                @endphp
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="2">মোট</td>
                                            <td>{{ $total_attitude_mark + $total_hr_mark + $total_finance_mark ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="second_part">
                                <h6>দ্বিতীয় অংশঃ সবলতা ও দুর্বলতার বিষয়সমূহঃ</h6>
                                <div class="ml-3">
                                    <div class="mb-1">
                                        <label for="employee_code" class=" col-form-label col-form-label-sm">১.
                                            মূল্যায়নকালীন
                                            সময়ে কর্মীর গুরুত্বপূর্ন সাফল্য(যাদি থাকে):</label>
                                        <div class="w-50 ml-3">
                                            @if (isset($appraisal))
                                                @php
                                                    $evaluation = $appraisal->evaluation_comment()->get();
                                                @endphp
                                            @else
                                                @php
                                                    $evaluation = null;
                                                @endphp
                                            @endif
                                            <input type="text" name="evaluationMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $evaluation[0]->comment ?? '') }}" />
                                            <input type="text" name="evaluationMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $evaluation[1]->comment ?? '') }}" />
                                            <input type="text" name="evaluationMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $evaluation[2]->comment ?? '') }}" />

                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="employee_code" class=" col-form-label col-form-label-sm">২.
                                            সীমাবদ্ধতা(যেসব
                                            ক্ষেত্রে কর্মদক্ষতা বৃদ্ধি করা প্রয়োজন):</label>
                                        <div class="w-50 ml-3">
                                            @if (isset($appraisal))
                                                @php
                                                    $limitation = $appraisal->limitation_comment()->get();
                                                @endphp
                                            @else
                                                @php
                                                    $limitation = null;
                                                @endphp
                                            @endif
                                            <input type="text" name="limitationMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $limitation[0]->comment ?? '') }}" />
                                            <input type="text" name="limitationMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $limitation[1]->comment ?? '') }}" />
                                            <input type="text" name="limitationMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $limitation[2]->comment ?? '') }}" />

                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="employee_code" class=" col-form-label col-form-label-sm">৩. উন্নতি
                                            করার
                                            জন্য প্রয়োজনীয় উদ্যোগ/প্রশিক্ষন:</label>
                                        <div class="w-50 ml-3">
                                            @if (isset($appraisal))
                                                @php
                                                    $development = $appraisal->development_comment()->get();
                                                @endphp
                                            @else
                                                @php
                                                    $development = null;
                                                @endphp
                                            @endif
                                            <input type="text" name="developMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $development[0]->comment ?? '') }}" />
                                            <input type="text" name="developMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $development[1]->comment ?? '') }}" />
                                            <input type="text" name="developMark[]"
                                                class="form-control form-control-sm mb-1"
                                                value="{{ old('developMark', $development[2]->comment ?? '') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border mt-4 p-2">
                                <p>কর্মীর মন্তব্যঃ এই মূল্যায়ন প্রক্রিয়া বা অন্য কোনো ব্যাপারে মতামত(যদি থাকে)</p>
                                <textarea name="staff_comment" id="" cols="50" rows="2">{{ old('staff_comment', $appraisal->staff_comment->comment ?? '') }}</textarea>
                            </div>
                            @foreach ($evaluators as $key => $evaluator)
                                @if (isset($appraisal))
                                    @php
                                        $evaluator_comment = $appraisal
                                            ->evaluator_comment()
                                            ->where('appraisal_evaluator_id', $evaluator->id)
                                            ->first();
                                    @endphp
                                @else
                                    @php
                                        $evaluator_comment = null;
                                    @endphp
                                @endif
                                <div class="border mt-2 p-2">
                                    <p>{{ $evaluator->evaluator->present_designation->designation ?? '' }} মন্তব্যঃ</p>
                                    <input type="hidden" name="evaluator[{{ $key }}][id]"
                                        value="{{ $evaluator->id }}" readonly>
                                    <textarea name="evaluator[{{ $key }}][comment]" id="" cols="50" rows="2">{{ old('evaluator_comment', $evaluator_comment->comment ?? '') }}</textarea>
                                </div>
                            @endforeach
                        </div>
                        <div class="m-3">
                            <button class="btn btn-warning" type="submit">Submit</button>
                            <a class="btn btn-secondary ml-3" href="{{ url('appraisal/index') }}">Back</a>
                        </div>
                    </div>
                    {{-- card-body end --}}
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // calculate date diffrence --------------88888888888888-------------------
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-50:+20"
            });
        });
    </script>
@endsection
