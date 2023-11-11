@extends('ui.admin_panel.master')

@section('title', 'Leave Approval')

@section('style')
    <style>
        .modal-content {
            width: 50% !important;
        }
    </style>

@endsection

@section('content_title')
    <h4 class="mt-2">Leave Approval</h4>
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

            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">Leave From</th>
                                <th scope="col">Leave To</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveDatas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->employee->full_name ?? '' }}</td>
                                    <td>{{ $data->employee->present_designation->designation ?? '' }}</td>
                                    <td>{{ $data->employee->branch->name ?? '' }}({{$data->employee->branch->code ?? '' }})</td>
                                    <td>{{ $data->leaveType->leave_name ?? '' }}</td>
                                    <td>{{ $data->leave_from ?? '' }}</td>
                                    <td>{{ $data->leave_to ?? '' }}</td>
                                    <td>
                                        <button data-id="{{ $data->id }}" class="action_btn"
                                            style="background:#FFCA2C;margin:3px;padding: 0 10px;"
                                            href="{{ URL('/designation/label/edit') }}">Approve/Cancel</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card-body end --}}
        </div>
        <div id="reject_modal" class="modal">
            <div class="modal-content">
                <div>
                    <span class="close">&times;</span>
                </div>
                <div class="container">
                    <h6>Employee Search</h6>
                    <form autocomplete="off" method="post" action="{{ url('leave/approval') }}" id='approve_form'>
                        @csrf
                        <input type="hidden" value="" id="leave_id" name="leave_id" readonly>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="employee_name" class="col-sm-6 col-form-label col-form-label-sm">Employee
                                        Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="employee_name"
                                            name="employee_name" placeholder="Double Click to Search" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="branch_name" class="col-sm-6 col-form-label col-form-label-sm">Branch
                                        Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="branch_name"
                                            name="branch_name" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="accept_from" class="col-sm-6 col-form-label col-form-label-sm">Leave
                                        From</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm datepicker"
                                            id="accept_from" name="accept_from">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="accepted_no_of_days" class="col-sm-6 col-form-label col-form-label-sm">No of
                                        Days</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="accepted_no_of_days"
                                            name="accepted_no_of_days" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="status_id" class="col-sm-6 col-form-label col-form-label-sm ">Approved
                                        Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-select-sm form-select" id="status_id" name="status_id">
                                            <option selected disabled value="">Choose...</option>
                                            @foreach ($status as $data)
                                                <option value="{{ $data->id }}">
                                                    {{ $data->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="employee_gid" class="col-sm-6 col-form-label col-form-label-sm">Employee
                                        ID</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="employee_gid"
                                            name="employee_gid" placeholder="Double Click to Search" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="leave_type" class="col-sm-6 col-form-label col-form-label-sm ">Leave
                                        Type</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="leave_type"
                                            name="leave_type" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="accept_to" class="col-sm-6 col-form-label col-form-label-sm">Leave
                                        To</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm datepicker"
                                            id="accept_to" name="accept_to">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="available"
                                        class="col-sm-6 col-form-label col-form-label-sm">Available</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="available"
                                            name="available" value="{{ old('available', $leave->available ?? '') }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="reason" class="col-sm-6 col-form-label col-form-label-sm">Reason</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-sm" id="rejected_reason"
                                            name="rejected_reason"
                                            value="{{ old('rejected_reason', $leave->rejected_reason ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // function for calculate available leave days -----------888888888888888-----------------
        function updateAvailableLeaveDays(leaveTypeId, employeeId) {
            $.ajax({
                url: "{{ url('leave/get-available-days') }}",
                type: 'GET',
                data: {
                    leave_type_id: leaveTypeId,
                    employee_id: employeeId
                },
                success: function(response) {
                    $('#available').val(response);
                }
            });
        }
        $(document).ready(function() {
            $('#table_id').DataTable({
                rowHeight: 20,
            });

            // data insert--------------------8-------------------------------
            function dataInsertInForm(response) {
                console.log(response)
                if (response.employee) {
                    $("#employee_name").val(response.employee.full_name);
                    $("#employee_gid").val(response.employee.employee_gid);
                    if (response.employee.branch)
                        $("#branch_name").val(response.employee.branch.name);
                }
                if (response.leave_type)
                    $("#leave_type").val(response.leave_type.leave_name);
                $("#accept_from").val(response.leave_from);
                $("#accept_to").val(response.leave_to);
                $("#accepted_no_of_days").val(response.no_of_days);
            }
            // click to open leave approve modal ---------------------------888888888888888------------------
            $(".action_btn").on("click", function() {
                document.querySelector('#reject_modal').style.display = 'block';
                var leaveId = $(this).data("id");
                $('#leave_id').val(leaveId);
                $.ajax({
                    url: "{{ url('leave/single') }}/" + leaveId,
                    type: "GET",
                    success: function(response) {
                        $("#approve_form")[0].reset();
                        dataInsertInForm(response);

                        if (response.leave_type)
                            var selectedLeaveTypeId = response.leave_type.id;
                        if (response.employee)
                            var employeeId = response.employee.id;
                        updateAvailableLeaveDays(selectedLeaveTypeId, employeeId);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while processing the request:", error);
                    }
                });
            });

            $('.close').on('click', function() {
                document.querySelector('#reject_modal').style.display = 'none';
            });

            // calculate date diffrence --------------88888888888888-------------------
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-20:+20"
            });

            $("#accept_from, #accept_to").on("change", function() {
                var leaveFrom = $("#accept_from").datepicker("getDate");
                var leaveTo = $("#accept_to").datepicker("getDate");

                if (leaveFrom && leaveTo) {
                    var timeDifference = leaveTo.getTime() - leaveFrom.getTime();
                    var daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) + 1;

                    $("#accepted_no_of_days").val(daysDifference);
                }
            });
        });
    </script>
@endsection
