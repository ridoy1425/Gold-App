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
        
        p{
            margin-bottom: 0;
        }
        tr {
            line-height: 15px;
            height: 15px;
            font-size: 15px
        }
    </style>
</head>

<body>
    <div class="d-grid gap-2 col-2 mx-auto">
        <button class="btn btn-warning mt-3 " onclick="printDiv('employee_report')">Print this page</button>
    </div>
    <div class=" container mt-2 p-3 border" style="font-size:12px" id="employee_report">
        <div class="title mb-2 ">
            <div class=" text-center">
                <h2>YWCA Of Bangladesh</h2>
                <p>3/23, Iqbal Road, Mohammadpur, Dhaka-1207</p>
                <h5 style="text-decoration:underline">Statement of Leave</h5>
            </div>
        </div>
        <div class="mt-3" style="font-size:14px">
                <p>Employee Code: {{ $employee->employee_gid ?? '' }}</p>
                <p>Employee Name: {{ $employee->full_name ?? '' }}</p>
                <p>Designation: {{ $employee->present_designation->designation ?? '' }}</p>
                <p>Branch: {{ $employee->branch->name ?? '' }}</p>
                <p>Period: {{ $fromDate ?? '' }} to {{ $toDate ?? '' }}</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered border-secondary text-center">
                    <tr>
                        <th rowspan="2">particulars</th>
                        <th colspan="4">Leave</th>
                    </tr>
                    <tr>
                        <th>Carry forward</th>
                        <th>Entitlement for this period</th>
                        <th>Enjoyed</th>
                        <th>Remaining Balance</th>
                    </tr>
                    @foreach ($leaveTypes as $leaveType)
                        <tr>
                            <td>{{ $leaveType->leave_name }}</td>
                            <td>0</td>
                            <td>{{ $leaveType->no_of_days }}</td>
                            <td>{{ $totalLeavesByType[$leaveType->id] ?? 0 }}</td>
                            <td>{{ $leaveType->no_of_days - ($totalLeavesByType[$leaveType->id] ?? 0) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <p>*3 days adjusted from Annual Leave for Christmas Holiday</p>
        </div>

        <div class="text-center mt-5">
            <h6>Leave Enjoyed from {{ $from_date ?? '' }} to {{ $to_date ?? '' }}</h6>
            <table class="table table-bordered border-secondary" id="table_id">
                <tr>
                    <th>SL</th>
                    <th>From</th>
                    <th>To</th>
                    @foreach ($leaveTypes as $leaveType)
                        <th scope="col">{{ $leaveType->leave_name }}</th>
                    @endforeach
                    <th>Comments</th>
                </tr>
                @foreach ($employee->leaveEntry as $leaveEntry)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $leaveEntry->accept_from }}</td>
                        <td>{{ $leaveEntry->accept_to }}</td>
                        @foreach ($leaveTypes as $leaveType)
                            <td>
                                {{ $leaveEntry->leave_type_id == $leaveType->id ? $leaveEntry->no_of_days : 0 }}
                            </td>
                        @endforeach
                        <td>{{ $leaveEntry->comments }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3">Total Leave</th>
                    @foreach ($leaveTypes as $leaveType)
                        @php
                            $totalDays = $totalLeavesByType->has($leaveType->id) ? $totalLeavesByType[$leaveType->id] : 0;
                        @endphp
                        <th scope="col">{{ $totalDays }}</th>
                    @endforeach
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-left:35px; margin-top:100px; font-size:14px">
            <div class="col-md-7">
                <ul>
                    <li>________________________________</li>
                    <li>Human Resource Manager</li>
                    <li>YWCA of Bangladesh</li>
                </ul>
            </div>
            <div class="col-md-5">
                <ul>
                    <li>________________________________</li>
                    <li>National General Secretary</li>
                    <li>YWCA of Bangladesh</li>
                </ul>
            </div>
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
