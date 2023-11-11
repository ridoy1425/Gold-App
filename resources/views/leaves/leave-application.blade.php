@extends('ui.admin_panel.master')

@section('title', 'Leave Application Form')

@section('style')
    {{-- print css --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/dist/css/print.css') }}">
    <style>
        ul {
            list-style: none;
        }

        tr {
            line-height: 0px;
        }

        .box {
            width: 200px;
            height: 50px;
            border: 1px solid black;
        }

        .leave-type-box {
            display: inline-block;
            border: 1px solid #333;
            padding: 10px;
            margin: 5px;
            text-align: center;
        }



        .table>:not(caption)>*>* {
            padding: 25px 10px;
        }

        table,
        th {
            text-align: center;
            padding: 10px !important;
        }

        .horizontal-line {
            border-top: 1px solid #333;
            margin: 20px 0 30px;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Leave Application Form</h4>
    <div id="flash_message"></div>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <button class="btn btn-warning mt-2 " onclick="printDiv('employee_report')">Print</button>
            </div>
            <div class=" container mt-2 mb-5 p-3 border" style="font-size:12px" id="employee_report">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-2 mt-2">
                        <img height="70px" width="100px" src="{{ asset('images/ywca.png') }}" alt="">
                    </div>
                    <div class="col-md-6 text-center">
                        <h2>YWCA Of Bangladesh</h2>
                        <p>3/23, Iqbal Road, Mohammadpur, Dhaka-1207</p>
                        <h6>Application Form</h6>
                    </div>
                    <div class="col-md-4 d-flex flex-row-reverse">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        Program/Department
                        <div class="box"></div>
                    </div>
                    <div class="col-md-6 d-flex flex-row-reverse">
                        <p>Date:___________________________</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h6>To be filled by the employee</h6>
                    <p>Name:___________________________________________________________________________________Designation:____________________________________________________________________________________________
                    </p>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <p>Types of Leaves: (please give ✓)</p>
                        </div>
                        <div class="col-md-8">
                            @foreach ($leaveTypes as $leaveType)
                                <div class="leave-type-box">{{ $leaveType->leave_name }}</div>
                            @endforeach
                        </div>
                    </div>
                    <p>
                        Leave
                        from/on:____________________________________________________________________to/and:________________________________________________________________for______________________________day/s
                    </p>
                    <p>
                        If special, write
                        reasons:__________________________________________________________________________________________________________________________________________________________________________
                    </p>
                    <p>
                        Address while on
                        leave:__________________________________________________________________________________________________________________________________________________________________________
                    </p>
                </div>
                <div class="d-flex flex-row-reverse text-center">
                    <div class="signature-container mt-5 ">
                        <p>_______________________________<br><span class="">Signature of Employee</span> </p>
                    </div>
                </div>
                <div class="">
                    <p>Leave due as of _______________________________</p>
                    <table class="table table-bordered border-secondary">
                        <tr>
                            @foreach ($leaveTypes as $leaveType)
                                <th>
                                    <p>{{ $leaveType->leave_name }}</p>
                                    <p>({{ $leaveType->no_of_days }} days)</p>
                                </th>
                            @endforeach
                            <th>Other</th>
                            <td rowspan="3">
                                <div class="signature-container mt-5">
                                    <p>________________________________________</p>
                                    <p class="">Signature & Date, HR Manager</span> </p>
                                </div>
                            </td>
                        </tr>
                        <tr style="padding:10px;">
                            @foreach ($leaveTypes as $leaveType)
                                <td></td>
                            @endforeach
                            <td></td>
                        </tr>
                    </table>
                </div>

                <div class="">
                    <h6>To be filled in by Responsible person of Program/Department:</h6>
                    <p>
                        Name of
                        substitue:_______________________________________________________________________________________________________________________________________________________________________________
                    </p>
                </div>

                <div class="row" style="margin-left:35px;">
                    <div class="col-md-5">
                        <ul>
                            <li>
                                <h6 class="mb-5">Recommended for Approval</h6>
                            </li>
                            <li>_______________________________________________</li>
                            <li>
                                <h6> Responsible Person of Project/Department </h6>
                            </li>
                            <li>
                                <p>Date:_____________________________</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <ul>
                            <li>
                                <h6 class="mb-5">Approved By</h6>
                            </li>
                            <li>_______________________________________________</li>
                            <li>
                                <h6>National General Secretary</h6>
                            </li>
                            <li>
                                <p>Date:_____________________________</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="horizontal-line"></div>

                <div class="">
                    <p>
                        Notes:____________________________________________________________________________________________________________________________________________________________________________________________
                        ____________________________________________________________________________________________________________________________________________________________
                    </p>
                    <p>
                        Annual/Sick/casual/Other leave granted
                        from/on:__________________________________________________________________to/and:_____________________________________________________________________
                        for__________________________day/s
                    </p>
                </div>
                <div class="d-flex flex-row-reverse ">
                    <ul class="mt-5">
                        <li>_______________________________________________</li>
                        <li>
                            <h6> HR Manager </h6>
                        </li>
                        <li>
                            <p>Date:_____________________________</p>
                        </li>
                    </ul>
                </div>

                <div class="">
                    <p>* Employee shall apply for casul leave at least 2 working days in advance to avail of Casual Leave.
                        In
                        case of emergency employee should submit the Leave Application with in 3 days of enjoyed leave.</p>
                    <p>* Employee shall apply for annual leave at least 1 working days in advance to avail of Annual Leave.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
@endsection
