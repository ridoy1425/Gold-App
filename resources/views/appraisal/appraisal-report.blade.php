<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- print css --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/dist/css/print.css') }}">
    <style>
        ul {
            list-style: none;
        }

        ol {
            list-style-type: bengali;
        }

        tr {
            line-height: 15px;
        }

        .pagebreak {
            page-break-before: always;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="d-grid gap-2 col-2 mx-auto">
        <button class="btn btn-warning mt-3 " onclick="printDiv('employee_report')">Print this page</button>
    </div>
    <div class=" container mt-2 mb-5 p-3 border" style="font-size:12px" id="employee_report">
        <div class="row">
            <div class="col-md-4">
                <img height="70px" width="100px" src="{{ asset('images/ywca.png') }}" alt="">
            </div>
            <div class="col-md-6 text-center">
                <h2>ওয়াইডাব্লিউসিএ অব বাংলাদেশ</h2>
                <p>৩/২৩, ইকবাল রোড, মোহাম্মাদপুর, ঢাকা-১২০৭</p>
                <div>
                    <p><b style="padding: 3px; border:1px solid"> কর্মী মূল্যায়ন ফরম</b></p>
                </div>
            </div>
        </div>

        <div class="float-end">
            <p>{{ $employee->appraisalCategory->name ?? '' }}</p>
        </div>
        <div>
            <table class="table table-bordered  border-secondary">
                <thead>
                    <tr>
                        <th>কর্মী কর্তৃক পূরনকৃত</th>
                        <th>অফিস কর্তৃক পূরনকৃত</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Function to convert English digits to Bangla digits
                    function englishToBanglaNumber($number)
                    {
                        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                        return str_replace(range(0, 9), $banglaDigits, $number);
                    }
                    
                    $basicSalary = $employee->salary->basic_salary ?? 0;
                    $houseRent = $employee->salary->house_rent ?? 0;
                    $conveyance = $employee->salary->conveyance ?? 0;
                    $medicalAllowance = $employee->salary->medical_allowance ?? 0;
                    $arbanAllowance = $employee->salary->arban_allowance ?? 0;
                    $pf = (10 / 100) * ($employee->salary->basic_salary ?? 0);
                    $total = $basicSalary + $houseRent + $conveyance + $medicalAllowance + $arbanAllowance + $pf;
                    $removePF = (20 / 100) * $basicSalary;
                    $mainTotal = $total - $removePF;
                    $totalForContract = $employee->salary->contractual_salary ?? 0;
                    
                    // Format and convert to Bangla
                    $pf = englishToBanglaNumber(number_format($pf, 2));
                    $total = englishToBanglaNumber(number_format($total, 2));
                    $removePF = englishToBanglaNumber(number_format($removePF, 2));
                    $mainTotal = englishToBanglaNumber(number_format($mainTotal, 2));
                    $totalForContract = englishToBanglaNumber(number_format($totalForContract, 2));
                    
                    ?>
                    <tr style="line-height: 10px;">
                        <td width="50%">
                            <p>কর্মীর নাম : {{ $employee->full_name_bn }}</p>
                            <p>জন্ম তারিখ : {{ englishToBanglaNumber($employee->dob) }}</p>
                            <p>স্মামী/স্ত্রীর নাম :</p>
                            <p>পিতার নাম : {{ $employee->father_name_bn }}</p>
                            <p>মাতার নাম : {{ $employee->mother_name_bn }}</p>
                            <?php
                            $sortedAcademy = $employee->academy->sortByDesc('id')->values();
                            ?>
                            <p>শিক্ষাগত যোগ্যতা : {{ $sortedAcademy[0]->degree->value ?? '' }}</p>
                            <p>বর্তমান ঠিকানা :</p>
                            <p style="margin-bottom:20px;">
                                {{ $employee->address->present_house_bn ?? '' }},
                                {{ $employee->address->present_road_no_bn ?? '' }},
                                {{ $employee->address->present_post_off_bn ?? '' }},
                                {{ $employee->address->present_district_bn ?? '' }}
                            </p>
                            <p>স্থায়ী ঠিকানা : </p>
                            <p style="margin-bottom:20px;">
                                {{ $employee->address->permanent_village_bn ?? '' }},
                                {{ $employee->address->permanent_police_station_bn ?? '' }},
                                {{ $employee->address->permanent_post_off_bn ?? '' }},
                                {{ $employee->address->permanent_district_bn ?? '' }}
                            </p>
                            <p>বর্তমান ওয়াইডাব্লিউসিএ - এর নাম : {{ $employee->branch->name }}</p>
                            <p>কাজের যোগদানের তারিখ : {{ englishToBanglaNumber($employee->joining_date) }}</p>
                            <p>বর্তমান পদবী : {{ $employee->present_designation->designation_bn ?? '' }}</p>
                            <p>বর্তমান পদবীতে চাকরির মেয়াদ :
                                {{ englishToBanglaNumber($employee->PresentDesJoiningAge['years']) ?? '' }} বছর
                                {{ englishToBanglaNumber($employee->PresentDesJoiningAge['months']) ?? '' }} মাস
                            </p>
                            <?php
                            $sortedPromotions = $employee->promotions->sortByDesc('id')->values();
                            if ($sortedPromotions->count() > 1) {
                                $previousPromotion = $sortedPromotions[1]->designation->designation_bn;
                                $previousPromotionDate = $sortedPromotions[1]->effective_date;
                            } elseif ($sortedPromotions->count() == 1) {
                                $previousPromotion = $sortedPromotions[0]->designation->designation_bn;
                                $previousPromotionDate = $sortedPromotions[0]->effective_date;
                            } else {
                                $previousPromotion = '';
                                $previousPromotionDate = '';
                            }
                            ?>
                            <p>পূর্ববর্তী পদবী : {{ $previousPromotion }}</p>
                            <p>কার্যকরের তারিখ : {{ englishToBanglaNumber($previousPromotionDate) }}</p>
                            <p>
                                কর্মীর ধরন :
                                @if ($employee->type_id == 36)
                                    স্থায়ী
                                @elseif($employee->type_id == 36)
                                    চুক্তিভিত্তিক
                                @endif
                            </p>
                        </td>
                        <td width="50%">

                            <p><b>বেতনের বর্তমান অবস্থা (প্রযোজ্য ক্ষেত্রে) :</b></p>
                            <p>বেতন গ্রেড : {{ englishToBanglaNumber($employee->salary->salary_grade ?? 0) }}</p>
                            <p>পে স্টেপ : {{ englishToBanglaNumber($employee->salary->pay_step ?? 0) }}</p>
                            <p><b>ক. বর্তমান বেতন প্যাকেজ (প্রযোজ্য ক্ষেত্রে) :</b></p>
                            <div>
                                <table class="table table-bordered  border-secondary">
                                    <thead>
                                        <tr>
                                            <th colspan="2">বিবরন</th>
                                            <th width="30%">টাকা</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td colspan="2">মূল বেতন :</td>
                                            <td>{{ englishToBanglaNumber(number_format($basicSalary)) }}</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5">ভাতাদি ও সুবিধা</td>
                                            <td>ঘর ভাড়া</td>
                                            <td>{{ englishToBanglaNumber(number_format($houseRent)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>যাতায়াত ভাতা</td>
                                            <td>{{ englishToBanglaNumber(number_format($conveyance)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>চিকিৎসা ভাতা</td>
                                            <td>{{ englishToBanglaNumber(number_format($medicalAllowance)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>আরবান ভাতা</td>
                                            <td>{{ englishToBanglaNumber(number_format($arbanAllowance)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>প্রতিষ্ঠানের পিএফ অবদান (মূল্য বেতনের ১০%)</td>
                                            <td>{{ $pf }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">সর্বমোট মাসিক বেতন ও ভাতাদি</th>
                                            <th>{{ $total }}</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">বিয়োগ: ২০% পিএফ অবদান</td>
                                            <td>{{ $removePF }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">মোট মাসিক বেতন ও ভাতাদি</th>
                                            <th>{{ $mainTotal }}</th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <p><b>খ. সর্বসাকুল্য মোট বেতন (প্রযোজ্য ক্ষেত্রে) :</b></p>
                            <ul>
                                <li>টাকা {{ $totalForContract }}</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="padding:5px; border:1px solid;">
            <h5>সহঃ জাতীয় সাধারন সম্পাদক/তদারককারী কর্মকর্তা কর্তৃক পূরণ :</h5>
            <p>মূল্যায়নের তারিখ : {{ englishToBanglaNumber($appraisal->evaluation_date) }} <span
                    style="margin-left:50px;">মূল্যায়নের সময়কাল :
                    {{ englishToBanglaNumber($appraisal->period_from) }} থেকে
                    {{ englishToBanglaNumber($appraisal->period_to) }}</span> </p>
            <p>সর্বশেষ মূল্যায়নের তারিখ : {{ englishToBanglaNumber($last_appraisal) }}</p>
            <p>মূল্যায়নকালীন সময়ে কোন সতর্কীকরন চিঠি প্রদান করা হয়েছে : <?php echo $appraisal->letter_send === 'yes' ? 'হ্যাঁ' : 'না'; ?> <span
                    style="margin-left:50px;"> প্রদানের তারিখ :
                    {{ englishToBanglaNumber($appraisal->letter_sent_date) ?? '' }}</span></p>
        </div>

        <div style=" margin-top:15px; padding:5px; border:1px solid;" class="d-flex flex-row">
            <div class="slide1">
                <h6>মূল্যায়নকারীদের নাম</h6>
            </div>
            <div class="slide2">
                <ol>
                    @foreach ($evaluators as $row)
                        <li>{{ $row->evaluator->appraisalCategory->name ?? '' }} :
                            {{ $row->evaluator->full_name_bn ?? '' }} </li>
                    @endforeach
                </ol>
            </div>
        </div>

        <div class="pagebreak">
            <h6>প্রথম অংশঃ দায়িত্ব ও কর্তব্যসমূহ (<span style="font-size:12px;">সহঃ জাতীয় সাধারন সম্পাদক/তদারককারী
                    কর্মকর্তা কর্তৃক পূরণ</span> )</h6>
            <p>ক. দায়-দায়িত্বঃ</p>
            <table class="table table-bordered border-secondary">
                <thead class="text-center">
                    <tr>
                        <th style="width: 9%;">ক্রমিক নং</th>
                        <th>দায়-দায়িত্ব ও কাজ <br> (কর্মী)</th>
                        <th style="width: 20%;">প্রাপ্ত দায়িত্বের অর্জনসমূহ <br> (সহঃ জাতীয় সম্পাদক/তদারককারী কর্মকর্তা)
                        </th>
                        <th style="width: 25%;">মান নির্ধারক (*) <br> (সহঃ জাতীয় সাধারণ সম্পাদক/তদারককারী কর্মকর্তা)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_duty = 0;
                    @endphp
                    @if (optional($mainEntity)->DutyResponsibility)
                        @foreach ($mainEntity->DutyResponsibility->sortBy('order') as $key => $item)
                            @if (isset($appraisal))
                                @php
                                    $dutyResponsibility = $appraisal
                                        ->duty_responsibility()
                                        ->where('type_id', $item->id)
                                        ->first();
                                    
                                    $total_duty += $dutyResponsibility->mark;
                                @endphp
                            @else
                                @php
                                    $dutyResponsibility = null;
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $item->order }}</td>
                                <td>{{ $item->duty_responsibility }}</td>
                                <td>{{ $dutyResponsibility->comment ?? '' }}</td>
                                <td>{{ englishToBanglaNumber($dutyResponsibility->mark ?? 0) }} </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr class="text-center">
                        <th colspan="3">মোট</th>
                        <th>{{ englishToBanglaNumber($total_duty ?? 0) }}</th>
                    </tr>
                    <tr>
                        <th colspan="4"> মান নির্ধারক স্কেলঃ খুব ভাল = ৫, ভাল = ৪, ভাল নয় = ২, অসন্তোষজনক = ১</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagebreak">
            <p>খ. কর্মীর ব্যক্তিগত মনোভাব ও আচরন (তদারককারী কর্মকর্তা কর্তৃক পূরনকৃত)</p>
            <table class="table table-bordered border-secondary">
                <thead class="text-center">
                    <tr>
                        <th>বিষয়</th>
                        <th style="width: 10%;">নম্বর</th>
                        <th style="width: 10%;">প্রাপ্ত নম্বর</th>
                        <th style="width: 25%;">মন্তব্য</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="4">মনোভাব ও আচরন সংক্রান্ত বিষয়াদি :</th>
                    </tr>
                    @php
                        $total_attitude = 0;
                        $total_hr = 0;
                        $total_finance = 0;
                        
                        $mark_attitude = 0;
                        $mark_hr = 0;
                        $mark_finance = 0;
                    @endphp
                    @if (optional($mainEntity)->attitudeBehavior)
                        @foreach ($mainEntity->attitudeBehavior->sortBy('order') as $key => $item)
                            @if (isset($appraisal))
                                @php
                                    $attitude = $appraisal
                                        ->attitude_behavior()
                                        ->where('type_id', $item->id)
                                        ->first();
                                    
                                    $mark_attitude += $item->marks;
                                    $total_attitude += $attitude->mark;
                                @endphp
                            @else
                                @php
                                    $attitude = null;
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $item->attitude_behavior }}</td>
                                <td>{{ englishToBanglaNumber($item->marks ?? 0) }}</td>
                                <td>{{ englishToBanglaNumber($attitude->mark ?? 0) }}</td>
                                <td>{{ $attitude->comment ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th colspan="4">এইচআর ও প্রশাসন সংক্রান্ত বিষয়াদি :</th>
                    </tr>
                    @if (optional($mainEntity)->hrAdministrative)
                        @foreach ($mainEntity->hrAdministrative->sortBy('order') as $key => $item)
                            @if (isset($appraisal))
                                @php
                                    $hr = $appraisal
                                        ->hr_administrative()
                                        ->where('type_id', $item->id)
                                        ->first();
                                    
                                    $mark_hr += $item->marks;
                                    $total_hr += $hr->mark;
                                @endphp
                            @else
                                @php
                                    $hr = null;
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $item->hr_administrative }}</td>
                                <td>{{ englishToBanglaNumber($item->marks ?? 0) }}</td>
                                <td>{{ englishToBanglaNumber($hr->mark ?? 0) }}</td>
                                <td>{{ $hr->comment }}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th colspan="4">আর্থিক লেনদেন সংক্রান্ত বিষয়াদি :</th>
                    </tr>
                    @if (optional($mainEntity)->finance)
                        @foreach ($mainEntity->finance->sortBy('order') as $key => $item)
                            @if (isset($appraisal))
                                @php
                                    $finance = $appraisal
                                        ->finance()
                                        ->where('type_id', $item->id)
                                        ->first();
                                    
                                    $mark_finance += $item->marks;
                                    $total_finance += $finance->mark;
                                @endphp
                            @else
                                @php
                                    $finance = null;
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $item->finance }}</td>
                                <td>{{ englishToBanglaNumber($item->marks ?? 0) }}</td>
                                <td>{{ englishToBanglaNumber($finance->mark ?? 0) }}</td>
                                <td>{{ $finance->comment }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                @php
                    $total_mark = 0;
                    $main_mark = 0;
                    $total_mark = $total_attitude + $total_hr + $total_finance;
                    $main_mark = $mark_attitude + $mark_hr + $mark_finance;
                @endphp
                <tr class="text-center">
                    <th>মোট</th>
                    <th>{{ englishToBanglaNumber($main_mark ?? 0) }}</th>
                    <th>{{ englishToBanglaNumber($total_mark ?? 0) }}</th>
                    <th></th>
                </tr>
            </table>
        </div>

        <div class="pagebreak">
            <h6>দ্বিতীয় অংশঃ সবলতা ও দুর্বলতার বিষয়সমূহঃ</h6>
            <div class="ml-3">
                <div class="mb-1">
                    <p>১. মূল্যায়নকালীন সময়ে কর্মীর গুরুত্বপূর্ন সাফল্য(যাদি থাকে):</p>
                    @if (isset($appraisal))
                        @php
                            $evaluation = $appraisal->evaluation_comment()->get();
                        @endphp
                    @else
                        @php
                            $evaluation = null;
                        @endphp
                    @endif
                    <ul>
                        @foreach ($evaluation as $item)
                            <li style="list-style-type: circle;">{{ $item->comment }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-1">
                    <p>২. সীমাবদ্ধতা(যেসব ক্ষেত্রে কর্মদক্ষতা বৃদ্ধি করা প্রয়োজন):</p>
                    @if (isset($appraisal))
                        @php
                            $limitation = $appraisal->limitation_comment()->get();
                        @endphp
                    @else
                        @php
                            $limitation = null;
                        @endphp
                    @endif
                    <ul>
                        @foreach ($limitation as $item)
                            <li style="list-style-type: circle;">{{ $item->comment }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-1">
                    <p>৩. উন্নতি করার জন্য প্রয়োজনীয় উদ্যোগ/প্রশিক্ষন:</p>
                    @if (isset($appraisal))
                        @php
                            $development = $appraisal->development_comment()->get();
                        @endphp
                    @else
                        @php
                            $development = null;
                        @endphp
                    @endif
                    <ul>
                        @foreach ($development as $item)
                            <li style="list-style-type: circle;">{{ $item->comment }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div style="margin-top:10px; padding:5px; border:1px solid;">
            <p style="margin-bottom:0px;">কর্মীর মন্তব্যঃ এই মূল্যায়ন প্রক্রিয়া বা অন্য কোনো ব্যাপারে মতামত(যদি থাকে)
            </p>
            <p style="margin-bottom:0px;">{{ $appraisal->staff_comment->comment ?? '' }}</p>
            <p style="margin-top:30px; margin-bottom:0px;">-------------------------------- <br> কর্মীর স্বাক্ষর
                <br>তারিখ:
            </p>
        </div>
        @foreach ($evaluators->sortByDesc('id') as $evaluator)
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
            <div style="margin-top:10px; padding:2px; border:1px solid; margin-bottom:0px;">
                <p style="margin-bottom:0px;">{{ $evaluator->evaluator->appraisalCategory->name ?? '' }}
                    মন্তব্যঃ </p>
                <p style="margin-bottom:0px;">{{ $evaluator_comment->comment ?? '' }}</p>
                <p style="margin-top:30px; margin-bottom:0px;">-------------------------------- <br>
                    {{ $evaluator->evaluator->appraisalCategory->name ?? '' }} স্বাক্ষর <br>তারিখ:</p>
            </div>
        @endforeach
        <div style="margin-top:40px;">
            <p>-------------------------------- <br>
                জাতীয় সাধারন সম্পাদকের স্বাক্ষর <br>তারিখ:</p>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>
