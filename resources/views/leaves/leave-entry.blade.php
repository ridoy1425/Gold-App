@extends('ui.admin_panel.master')

@section('title', 'Leave Entry')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Leave Entry</h4>
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
                    <div class="propertyContent">
                        <h6>Apply for leave</h6>
                        @if (isset($leave))
                            <form autocomplete="off" method="post" action="{{ url('leave/entry/update', $leave->id) }}">
                                @method('PATCH')
                            @else
                        @endif
                        <form autocomplete="off" method="post" action="{{ url('leave/entry') }}">
                            @csrf
                            <input type="hidden" id="employee_id"
                                value="{{ old('employee_id', $leave->employee_id ?? '') }}" name="employee_id" readonly>
                            <input type="hidden" id="substitute_id"
                                value="{{ old('substitute_id', $leave->substitute_id ?? '') }}" name="substitute_id"
                                readonly>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-1 row">
                                        <label for="entry_date" class="col-sm-6 col-form-label col-form-label-sm">Leave
                                            Entry Date <span
                                            class="important_field">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm datepicker"
                                                id="entry_date" name="entry_date"
                                                value="{{ old('entry_date', $leave->entry_date ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="present_designation_id"
                                            class="col-sm-6 col-form-label col-form-label-sm ">Designation</label>
                                        <div class="col-sm-6">
                                            <select class="form-select-sm form-select designation"
                                                id="present_designation_id" name="present_designation_id" disabled="true">
                                                <option value="{{ $leave->employee->present_designation_id ?? '' }}">
                                                    {{ $leave->employee->present_designation->designation ?? '' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="leave_from" class="col-sm-6 col-form-label col-form-label-sm">Leave
                                            From <span
                                            class="important_field">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm datepicker"
                                                id="leave_from" name="leave_from"
                                                value="{{ old('leave_from', $leave->leave_from ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="reason"
                                            class="col-sm-6 col-form-label col-form-label-sm">Reason <span
                                            class="important_field">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="reason"
                                                name="reason" value="{{ old('reason', $leave->reason ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-1 row">
                                        <label for="employee_gid" class="col-sm-6 col-form-label col-form-label-sm">Employee
                                            Name <span
                                            class="important_field">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="employee_gid"
                                                name="employee_gid" placeholder="Double Click to Search"
                                                value="{{ old('employee_gid', $leave->employee->full_name ?? '') }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="leave_type_id" class="col-sm-6 col-form-label col-form-label-sm ">Leave
                                            Type <span
                                            class="important_field">*</span></label>
                                        <div class="col-sm-6">
                                            <select class="form-select-sm form-select" id="leave_type_id"
                                                name="leave_type_id">
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($leaveTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if (isset($leave)) {{ $type->id == $leave->leave_type_id ? 'selected' : '' }} @endif>
                                                        {{ $type->leave_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="leave_to" class="col-sm-6 col-form-label col-form-label-sm">Leave
                                            To <span
                                            class="important_field">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm datepicker"
                                                id="leave_to" name="leave_to"
                                                value="{{ old('leave_to', $leave->leave_to ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="leave_address" class="col-sm-6 col-form-label col-form-label-sm">Addess
                                            While in Leave</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="leave_address"
                                                name="leave_address"
                                                value="{{ old('leave_address', $leave->leave_address ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-1 row">
                                        <label for="branch_id" class="col-sm-6 col-form-label col-form-label-sm">Branch
                                            Name</label>
                                        <div class="col-sm-6">
                                            <select class="form-select-sm form-select designation" id="branch_id"
                                                name="branch_id" disabled="true">
                                                <option selected value="">Choose...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        @if (isset($leave->employee->branch_id)) {{ $branch->id == $leave->employee->branch_id ? 'selected' : '' }} @endif>
                                                        {{ $branch->name }}( {{ $branch->code }})</option>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="available"
                                            class="col-sm-6 col-form-label col-form-label-sm">Available</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="available"
                                                name="available" value="{{ old('available', $leave->available ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="mb-1
                                                row">
                                        <label for="no_of_days" class="col-sm-6 col-form-label col-form-label-sm">No
                                            of
                                            Days</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" id="no_of_days"
                                                name="no_of_days"
                                                value="{{ old('no_of_days', $leave->no_of_days ?? '') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1
                                                row">
                                        <label for="substitute_name"
                                            class="col-sm-6 col-form-label col-form-label-sm">Name
                                            of
                                            The Substitute</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm"
                                                id="substitute_name" name="substitute_name"
                                                placeholder="Double Click to Search"
                                                value="{{ old('substitute_name', $leave->substitute->full_name ?? '') }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning mt-3">Submit</button>
                            <a class="btn btn-secondary ml-3 mt-3" href="{{ url('leave/entry/index') }}">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            {{-- card-body end --}}
            </form>
        </div>
        @include('employees.employee-search-modal')
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
            // double click to open employe search modal ---------------------------888888888888888------------------
            $("#employee_gid").on("dblclick", function() {
                document.querySelector('#reject_modal').style.display = 'block';
                $('#double_click_value').val('employee_gid');
            });
            $("#substitute_name").on("dblclick", function() {
                document.querySelector('#reject_modal').style.display = 'block';
                $('#double_click_value').val('substitute_id');
            });

            $('.close').on('click', function() {
                document.querySelector('#reject_modal').style.display = 'none';
            });

            // search function----------------------88888888888888888888888888----------------
            function fill_datatable(search_by = '', search_value = '', branch_id = '', category = '') {
                $.ajax({
                    url: "{{ url('employee/search') }}",
                    data: {
                        search_by: search_by,
                        search_value: search_value,
                        branch_id: branch_id,
                        category: category,
                    },
                    success: function(data) {
                        var res = '';
                        $.each(data, function(key, value) {
                            res +=
                                '<tr>' +
                                '<td>' + (key + 1) + '</td>' +
                                '<td>' + value.branch.name + '(' + value.branch.code + ')' +
                                '</td>' +
                                '<td>' + value.employee_gid + '</td>' +
                                '<td>' + value.full_name + '</td>' +
                                '<td>' + (value.appraisal_category ? value.appraisal_category
                                    .name : '') + '</td>' +
                                '<td>' + (value.mobile_no ? value.mobile_no : '') + '</td>' +
                                '<td>' +
                                '<button style="background:green;margin-right:5px; padding: 0 10px;" class="edit-button" data-employee-id="' +
                                value.id +
                                '">Edit</button><a href="{{ url('employee/delete') }}/' + value
                                .id +
                                '" style="background:red;margin-right:5px; color:white; padding: 2px 10px;" class="delete-button" data-employee-id="">Separate</a>' +
                                '</td>' +
                                '</tr>';
                        });

                        $('#myTable tbody').html(res);
                    },
                });
            }
            fill_datatable(); //call search function----------

            // search employee data----------------------88888888888888888888888888----------------
            $('#search').click(function() {
                event.preventDefault();
                var search_by = $('#searchBy').val();
                var search_value = $('#search_value').val();
                var branch_id = $('#branch_modal').val();
                var category = $('#category_modal').val();
                if (search_by == "null") {
                    $('#myTable').DataTable().destroy();
                    fill_datatable();
                } else {
                    $('#myTable').DataTable().destroy();
                    fill_datatable(search_by, search_value, branch_id, category);
                }
            });

            // data insert--------------------8-------------------------------
            function dataInsertInForm(response, type) {
                if (type == "employee_gid") {
                    $("#employee_gid").val(response.full_name);
                    $("#employee_id").val(response.id);
                    $("#present_designation_id").empty();
                    console.log('asdfa');
                    if (response.present_designation) {
                        $.ajax({
                            url: "{{ url('designation/get-designation') }}",
                            type: 'post',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: response.present_designation.id,
                            },
                            success: function(data) {
                                $.each(data, function(index, item) {
                                    var option = '<option value="' + item.id + '"';
                                    if (item.id === response.present_designation
                                        .id) {
                                        option += 'selected';
                                    }
                                    option += '>' + item.designation + '</option>';
                                    $("#present_designation_id").append(option);
                                });
                            }
                        });
                    }
                    if (response.branch)
                        $("#branch_id").val(response.branch.id).change();
                } else if (type = "substitute_id") {
                    $("#substitute_name").val(response.full_name);
                    $("#substitute_id").val(response.id);
                }

            }
            // edit employe function--------------------88888888888888878888888888-----------------
            function editEmployee(employeeId) {
                $.ajax({
                    url: "{{ url('employee/edit') }}/" + employeeId,
                    type: "GET",
                    success: function(response) {
                        var type = $('#double_click_value').val();
                        document.querySelector('#reject_modal').style.display = 'none';
                        dataInsertInForm(response, type);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while processing the request:", error);
                    }
                });
            }
            $(document).on('click', '.edit-button', function() {
                const employeeId = $(this).data('employee-id');
                editEmployee(employeeId);
            });

            // calculate date diffrence --------------88888888888888-------------------
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-20:+20"
            });

            $("#leave_from, #leave_to").on("change", function() {
                var leaveFrom = $("#leave_from").datepicker("getDate");
                var leaveTo = $("#leave_to").datepicker("getDate");

                if (leaveFrom && leaveTo) {
                    var timeDifference = leaveTo.getTime() - leaveFrom.getTime();
                    var daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24)) + 1;

                    $("#no_of_days").val(daysDifference);
                }
            });

            // calculate avaliable no of days per leave type ------------------------888888888888888888888------------------
            $('#leave_type_id').on('change', function() {
                var selectedLeaveTypeId = $(this).val();
                var employeeId = $('#employee_id').val();

                updateAvailableLeaveDays(selectedLeaveTypeId, employeeId);
            });
        });
    </script>
@endsection
