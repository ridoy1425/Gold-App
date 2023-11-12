@extends('ui.admin_panel.master')

@section('title', 'Leave Register')

@section('style')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/buttons.dataTables.min.css') }}">
    <style>
        .button {
            background: forestgreen;
            color: #fff;
            padding: 0 2px;
        }

        div.dt-buttons {
            position: relative;
            float: right;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Leave Register</h4>
    <div id="flash_message"></div>
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
                <div class="m-3">
                    <h6>Leave Report Search</h6>
                    <form method="GET" action="{{ url('leave/register-search') }}" id="report_form" autocomplete="off">
                        <input type="hidden" id="employee_id" name="employee_id">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1 ">
                                    <label for="from_date" class=" col-form-label col-form-label-sm">From Date <span
                                            class="important_field">*</span> </label>
                                    <div class="">
                                        <input type="text" id="from_date" name="from_date"
                                            class="form-control form-control-sm datepicker" />
                                    </div>
                                </div>
                                <div class="mb-1 ">
                                    <label for="employee_code" class=" col-form-label col-form-label-sm">Employee
                                        Code</label>
                                    <div class="">
                                        <input type="text" id="employee_code" name="employee_code"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1 ">
                                    <label for="to_date" class="col-form-label col-form-label-sm">To Date <span
                                            class="important_field">*</span></label>
                                    <div class="">
                                        <input type="text" id="to_date" name="to_date"
                                            class="form-control form-control-sm datepicker" />
                                    </div>
                                </div>
                                <div class="mb-1 ">
                                    <label for="leave_type" class=" col-form-label col-form-label-sm">Leave Type</label>
                                    <select class="form-select-sm form-select" id="leave_type" name="leave_type"
                                        runat="server">
                                        <option selected value="">Choose...</option>
                                        @foreach ($leaveTypes as $leaveType)
                                            <option value="{{ $leaveType->id }}">
                                                {{ $leaveType->leave_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="name" class=" col-form-label col-form-label-sm">Designation
                                        Label</label>
                                    <div class="">
                                        <select class="form-select-sm form-select designation" id="designation_label"
                                            name="designation_label" runat="server">
                                            <option selected value="">Choose...</option>
                                            @foreach ($labels as $label)
                                                <option value="{{ $label->id }}">
                                                    {{ $label->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning mt-4">Generate
                                    Report</button>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="name" class=" col-form-label col-form-label-sm">Designation</label>
                                    <div class="">
                                        <select class="form-select-sm form-select designation" id="designation"
                                            name="designation">
                                            <option selected value="">Choose...</option>
                                            @foreach ($designationInfo as $row)
                                                <option value="{{ $row->id }}">
                                                    {{ $row->designation }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="name" class=" col-form-label col-form-label-sm">Branch</label>
                                    <div class="">
                                        <select class="form-select-sm form-select designation" id="branch"
                                            name="branch">
                                            <option selected value="">Choose...</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->name }}({{ $branch->code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="employee_name" class=" col-form-label col-form-label-sm">Employee
                                        Name</label>
                                    <div class="">
                                        <input type="text" class="form-control form-control-sm" id="employee_gid"
                                            name="employee_gid" placeholder="Double Click to Search"
                                            value="{{ old('employee_gid', $leave->employee->full_name ?? '') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="cell-border" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Branch</th>
                                @foreach ($leaveTypes as $leaveType)
                                    <th scope="col">{{ $leaveType->leave_name }}</th>
                                @endforeach
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($employees))
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->present_designation->designation ?? '' }}</td>
                                        <td>{{ $employee->branch->name ?? '' }}</td>
                                        @foreach ($leaveTypes as $leaveType)
                                            <td>
                                                {{ $perTypeLeaves[$loop->parent->index][$leaveType->id] ?? 0 }}
                                            </td>
                                        @endforeach
                                        <td>
                                            <a class="button" target="_blank"
                                                href="{{ route('leave.statement', ['id' => $employee->id, 'from' => $from_date ?? '', 'to' => $to_date ?? '']) }}">
                                                Leave Statement
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card-body end --}}
        </div>
        @include('employees.employee-search-modal')
    </div>
@endsection

@section('script')
    {{-- <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
        </script> --}}
    {{-- <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
    {{-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
            </script> --}}
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js">
            </script> --}}
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js">
            </script> --}}
    <script src="{{ asset('ui/admin_assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/jszip.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/buttons.print.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('ui/admin_assets/dist/js/employee-search.js') }}"></script>
    <script>
        $(document).ready(function() {
            // search form old value set from url
            var urlParams = new URLSearchParams(window.location.search);
            var fromDateGet = urlParams.get('from_date');
            var toDateGet = urlParams.get('to_date');
            var employee_code = urlParams.get('employee_code');
            var leave_type = urlParams.get('leave_type');
            var designation_label = urlParams.get('designation_label');
            var designation = urlParams.get('designation');
            var branch = urlParams.get('branch');
            $('#from_date').val(fromDateGet);
            $('#to_date').val(toDateGet);
            $('#employee_code').val(employee_code);
            $('#leave_type').val(leave_type);
            $('#designation_label').val(designation_label);
            $('#designation').val(designation);
            $('#branch').val(branch);

            $("#report_form").submit(function(event) {
                var fromDateValue = $("#from_date").val();
                var toDateValue = $("#to_date").val();

                if (fromDateValue === "") {
                    event.preventDefault();
                    alert("Please select a valid From Date.");
                } else if (toDateValue === "") {
                    event.preventDefault();
                    alert("Please select a valid To Date.");
                }
            });

            const from_date = "<?php echo $from_date ?? ''; ?>";
            const to_date = "<?php echo $to_date ?? ''; ?>";
            var table = $('#table_id').DataTable({
                searching: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        title: '<div style="text-align:center;"><h2>YWCA of Bangladesh</h2><p style="font-size:14px;">3/23, Iqbal Road, Mohammadpur, Dhaka-1207</p></div><div style="text-align:center;font-size:16px; text-decoration:underline">Leave Register</div></div><div style="text-align:center;font-size:15px; margin-top:5px;">Period: ' +
                            from_date + ' to ' + to_date + '</div>',
                        customize: function(win) {
                            var body = $(win.document.body).find('table').first();
                            body.find('td:last-child(), th:last-child()').hide();
                            $(win.document.body).find('th').css('border', '1px solid #000');
                            $(win.document.body).find('tr').css('border', '1px solid #000');
                            $(win.document.body).find('td').css('border', '1px solid #000');
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        customizeData: function(excelData) {
                            var header = excelData.header;
                            header.pop();
                        }
                    }
                ]
            });

            $('#designation_label').on('change', function() {
                if ($(this).val() != '') {
                    var label_id = $(this).val();
                    $.ajax({
                        url: "{{ url('designation/get-designation') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            label: label_id,
                        },
                        success: function(data) {
                            $("#designation").empty();
                            $(`<option value="">Choose...</option>`).appendTo(
                                "#designation");
                            $.each(data, function(key, value) {
                                $("#designation").append(` <option value="` +
                                    value
                                    .id + `">` + value.designation + `</option>`)

                            });
                        }
                    });
                }
            });

            // dropdown value search -----------------888888888888---------------
            $('.designation').select2();

            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-70:+50",
            });

            // search function----------------------88888888888888888888888888----------------
            $("#employee_gid").on("dblclick", function() {
                document.querySelector('#reject_modal').style.display = 'block';
                $('#double_click_value').val('employee_gid');
            });

            $('.close').on('click', function() {
                document.querySelector('#reject_modal').style.display = 'none';
            });

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
                $("#employee_gid").val(response.full_name);
                $("#employee_id").val(response.id);
                $("#employee_code").val(response.employee_gid);
                $("#designation").val(response.present_designation_id).change();
            }
            // edit employe function--------------------88888888888888878888888888-----------------
            function editEmployee(employeeId) {
                $.ajax({
                    url: "{{ url('employee/edit') }}/" + employeeId,
                    type: "GET",
                    success: function(response) {
                        document.querySelector('#reject_modal').style.display = 'none';
                        dataInsertInForm(response);
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
        });
    </script>
@endsection
