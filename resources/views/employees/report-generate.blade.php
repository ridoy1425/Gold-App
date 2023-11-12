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

        tr {
            line-height: 10px;
            font-size: 14px;
        }

        body {
            font-size: 14px;
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
                <p style="font-size: 12px;font-weight: bold;">YWCA ID NO : {{ $employee->branch->code ?? '' }}</p>
                <p style="font-size: 12px;font-weight: bold; margin-top:-12px;">Staff ID NO :
                    {{ $employee->employee_gid }}</p>
            </div>
            <div class="col-md-6 text-center">
                <h2>YWCA Of Bangladesh</h2>
                <p>3/23, Iqbal Road, Mohammadpur, Dhaka-1207</p>
            </div>
            <div class="col-md-2 d-flex flex-row-reverse">
                <div>
                    <img height="100px" width="100px"
                        src="{{ asset('storage/' . optional($employee->attachment)->file_path) }}" alt="profile image">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <ol>
                    <li>Full Name</li>
                    <li>Branch Name</li>
                    <li>Mother's Name</li>
                    <li>Father's Name</li>
                    <li>Present Designation</li>
                    <li>Joining Designation</li>
                    <li>Date of Joining</li>
                    <li>Date of Birth</li>
                    <li>Permanent Address</li>
                    <ol>
                        <li>Village</li>
                        <li>Police Station</li>
                        <li>Post Office</li>
                        <li>Distric</li>
                    </ol>
                    <li>Present Address</li>
                    <ol>
                        <li>House No/Village</li>
                        <li>Road No</li>
                        <li>Post Office</li>
                        <li>Distric</li>
                        {{-- <li>Telephone/Mobile No</li> --}}
                    </ol>
                    <li>Marital Status</li>
                    <li>Name of Spouse</li>
                    <li>Occupation of Spouse</li>
                    <li>Nationality</li>
                    <li>Telephone No</li>
                    <li>Mobile No</li>
                    <li>Alternative Mobile No</li>
                    <li>National ID</li>
                    <li>Passport No</li>
                    <li>Blood Group</li>
                    <li>E-TIN No</li>
                    <li>Religion</li>
                    <li>Mother Tongue</li>
                    <li>Language/s Known</li>
                    <li>Other Experience/Technical Skill</li>
                    <li>Employee Type</li>
                    <li>Salary Grade</li>
                    <li>Pay Step</li>
                    <li>Employee Status</li>
                </ol>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>: {{ $employee->full_name }}</li>
                    <li>: {{ $employee->branch->name ?? '' }}</li>
                    <li>: {{ $employee->mother_name ?? '' }}</li>
                    <li>: {{ $employee->father_name ?? '' }}</li>
                    <li>: {{ $employee->present_designation->designation ?? '' }}</li>
                    <li>: {{ $employee->joining_designation->designation ?? '' }}</li>
                    <li>: {{ $employee->joining_date ?? '' }}</li>
                    <li>: {{ $employee->dob ?? '' }}</li>
                    <li>------</li>
                    <li>: {{ $employee->address->permanent_village ?? '' }}</li>
                    <li>: {{ $employee->address->permanent_police_station ?? '' }}</li>
                    <li>: {{ $employee->address->permanent_post_off ?? '' }}</li>
                    <li>: {{ $employee->address->permanent_district ?? '' }}</li>
                    <li>------</li>
                    <li>: {{ $employee->address->present_house ?? '' }}</li>
                    <li>: {{ $employee->address->present_road_no ?? '' }}</li>
                    <li>: {{ $employee->address->present_post_off ?? '' }}</li>
                    <li>: {{ $employee->address->present_district ?? '' }}</li>
                    {{-- <li>: {{ $employee->telephone_no ?? '' }}/{{ $employee->mobile_no ?? '' }}</li> --}}
                    <li>: {{ $employee->marital_status->value ?? '' }}</li>
                    <li>: {{ $employee->spouse_name ?? '' }}</li>
                    <li>: {{ $employee->spouse_occupation ?? '' }}</li>
                    <li>: {{ $employee->nationality ?? '' }}</li>
                    <li>: {{ $employee->telephone_no ?? '' }}</li>
                    <li>: {{ $employee->mobile_no ?? '' }}</li>
                    <li>: {{ $employee->alt_mobile_no ?? '' }}</li>
                    <li>: {{ $employee->national_id ?? '' }}</li>
                    <li>: {{ $employee->passport_no ?? '' }}</li>
                    <li>: {{ $employee->blood_group->value ?? '' }}</li>
                    <li>: {{ $employee->tin_no ?? '' }}</li>
                    <li>: {{ $employee->religion->value ?? '' }}</li>
                    <li>: {{ $employee->others->mother_tongue ?? '' }}</li>
                    <li>: {{ $employee->others->language ?? '' }}</li>
                    <li>: {{ $employee->others->skill ?? '' }}</li>
                    <li>: {{ $employee->type->value ?? '' }}</li>
                    <li>: {{ $employee->salary->salary_grade ?? '' }}</li>
                    <li>: {{ $employee->salary->pay_step ?? '' }}</li>
                    <li>: {{ $employee->status->value ?? '' }}</li>
                </ul>
            </div>
        </div>

        <div class="pagebreak">
            <p style="margin-bottom:0px;">30. Academy Qualification</p>
            <table class="table table-bordered border-secondary">
                <thead>
                    <tr>
                        <th>Name Of Degree</th>
                        <th>Educational Institute</th>
                        <th>Passing Year</th>
                        <th>Div/Class/CGPA/Grade</th>
                        <th>Discipline</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employee->academy as $acdemy)
                        <tr>
                            <td>{{ $acdemy->degree->value }}</td>
                            <td>{{ $acdemy->institute }}</td>
                            <td>{{ $acdemy->pass_yr }}</td>
                            <td>{{ $acdemy->grade }}</td>
                            <td>{{ $acdemy->discipline }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <p style="margin-bottom:0px;">31. employment History</p>
            <table class="table table-bordered border-secondary">
                <thead>
                    <th>Organization Name</th>
                    <th>Address</th>
                    <th>Position Last Held</th>
                    <th>Service From</th>
                    <th>Service To</th>
                    <th>Mode of Separation</th>
                </thead>
                <tbody>
                    @foreach ($employee->employment as $employment)
                        <tr>
                            <td>{{ $employment->org_name }}</td>
                            <td>{{ $employment->org_address }}</td>
                            <td>{{ $employment->last_position }}</td>
                            <td>{{ $employment->service_from }}</td>
                            <td>{{ $employment->separation }}</td>
                            <td>{{ $employment->separation }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p style="margin-bottom:0px;">32. Professional Degree</p>
            <table class="table table-bordered border-secondary">
                <thead>
                    <th>Name Of Degree</th>
                    <th>Educational Institute</th>
                    <th>Duration From</th>
                    <th>Duration To</th>
                    <th>Class/Grade</th>
                    <th>Major/Area</th>
                </thead>
                <tbody>
                    @foreach ($employee->profession as $profession)
                        <tr>
                            <td>{{ $profession->degree }}</td>
                            <td>{{ $profession->institute }}</td>
                            <td>{{ $profession->duration_from }}</td>
                            <td>{{ $profession->duration_from }}</td>
                            <td>{{ $profession->grade }}</td>
                            <td>{{ $profession->area }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p style="margin-bottom:0px;">33. Training</p>
            <table class="table table-bordered border-secondary">
                <thead>
                    <th>Training/ Workshop</th>
                    <th>Institute</th>
                    <th>Organized by</th>
                    <th>Major Topic</th>
                    <th>Duration From</th>
                    <th>Duration To</th>
                </thead>
                <tbody>
                    @foreach ($employee->training as $training)
                        <tr>
                            <td>{{ $training->training }}</td>
                            <td>{{ $training->institute }}</td>
                            <td>{{ $training->org_by }}</td>
                            <td>{{ $training->topic }}</td>
                            <td>{{ $training->duration_from }}</td>
                            <td>{{ $training->duration_to }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p style="margin-bottom:0px;">34. Dependet Family Members</p>
            <table class="table table-bordered border-secondary">
                <thead>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Present Age</th>
                    <th>Relation</th>
                    <th>Occupation</th>
                </thead>
                <tbody>
                    @foreach ($employee->family as $family)
                        <tr>
                            <td>{{ $family->name }}</td>
                            <td>{{ $family->dob }}</td>
                            <td>{{ $family->age }}</td>
                            <td>{{ $family->relation }}</td>
                            <td>{{ $family->occupation }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p style="margin-bottom:0px;">35. Name of the official nominee to receive monetary benefits on behalf of the
                employee in case of the
                employee's death/demise(priority)</p>
            <table class="table table-bordered border-secondary">
                <thead>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Relation</th>
                    <th>Address</th>
                    <th>% of amount to be given</th>
                </thead>
                <tbody>
                    @foreach ($employee->nominee as $nominee)
                        <tr>
                            <td>{{ $nominee->name }}</td>
                            <td>{{ $nominee->dob }}</td>
                            <td>{{ $nominee->relation }}</td>
                            <td>{{ $nominee->address }}</td>
                            <td>{{ $nominee->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagebreak">
            <p>* Any change in decision on in the address of the nominee must immediatly be intimated in writing to the
                HR/Admin Department.</p>
            <p>36. I certify that all the statement above are true and complete to the best of my knowledge and belief
            </p>
            <p>I understand that any misrepresentation or material omission in this form renders me liable for
                dismissal or any other disciplinary action</p>
        </div>

        <div class="row" style="margin-left:35px;">
            <div class="col-md-4">
                <p class="mb-5" style="margin-left:20px;">Submitted By:</p>
                <p>--------------------------------</p>
                <ul>
                    <li>Signature</li>
                    <li>Name:</li>
                    <li>Designation:</li>
                    <li>Date:</li>
                </ul>
                <p class="mb-5" style="margin-left:35px; ">varified By:</p>
                <p>--------------------------------</p>
                <ul>
                    <li>Supervisor/Incharge</li>
                    <li>Name:</li>
                    <li>Designation:</li>
                    <li>Date:</li>
                </ul>

            </div>
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <p class="mb-5" style="margin-left:20px; ">Submitted To:</p>
                <p>--------------------------------</p>
                <ul>
                    <li>National General Secretary</li>
                    <li>Name: Helen Menion Sarker</li>
                    <li>Date:</li>
                </ul>
                <p class="mb-5" style="margin-top:40px">Endorsed By (Local YWCA)</p>
                <p>--------------------------------</p>
                <ul>
                    <li>General Secretary</li>
                    <li>Name:</li>
                    <li>Date:</li>
                </ul>
            </div>
        </div>

        <div>
            Attachment:
            <ol>

                <li>
                    Photocopy of all kinds of Acedemic Credit
                </li>
                <li>
                    Previous Experience
                </li>
                <li>
                    Photocopy of National ID Card
                </li>
                <li>
                    Passport Size Photo (1 copy)
                </li>
            </ol>
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
