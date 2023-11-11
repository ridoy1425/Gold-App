@extends('ui.admin_panel.master')

@section('title', 'Create User')

@section('style')
    <style>
    </style>
@endsection

@section('content_title')
    @if (isset($user))
        <h4 class="mt-2">Update User</h4>
    @else
        <h4 class="mt-2">Create User</h4>
    @endif
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
            @if (isset($user))
                <form action="{{ url('user/update', $user->id) }}" method="post" autocomplete="off">
                    @method('PATCH')
                @else
                    <form action="{{ url('user/store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>User Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="employee_gid" class="col-sm-4 col-form-label col-form-label-sm">Employee
                                        Name <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="hidden" value="{{ old('employee_gid', $user->employee_id ?? '') }}"
                                            name="employee_id" id="employee_id" readonly>
                                        <input type="text" class="form-control form-control-sm" id="employee_gid"
                                            name="employee_gid" placeholder="Double Click to Search"
                                            value="{{ old('employee_gid', $user->employee->full_name ?? '') }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="branch_id" class="col-sm-4 col-form-label col-form-label-sm">Branch
                                        Name</label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="branch_id"
                                            name="branch_id" disabled="true">
                                            <option selected value=""></option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (isset($user->employee->branch_id)) {{ $branch->id == $user->employee->branch_id ? 'selected' : '' }} @endif>
                                                    {{ $branch->name }}( {{ $branch->code }})</option>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name"
                                        class="col-sm-4 col-form-label col-form-label-sm">Designation</label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="present_designation_id"
                                            name="present_designation_id" disabled="true">
                                            <option value=""></option>
                                            <option value="{{ $user->employee->present_designation_id ?? '' }} "
                                                @if (isset($user->employee->present_designation)) selected @endif>
                                                {{ $user->employee->present_designation->designation ?? '' }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="image" class="col-sm-4 col-form-label col-form-label-sm">Profile
                                        Image</label>
                                    <div class="col-sm-8">
                                        <img height="150px" width="130px" id="output"
                                            src="{{ asset('storage/' . optional($user->employee->attachment ?? '')->file_path) }}"
                                            alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="employee_gid" class="col-sm-4 col-form-label col-form-label-sm">User
                                        Name <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="user_name"
                                            name="user_name" value="{{ old('employee_gid', $user->user_name ?? '') }}">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="branch_id"
                                        class="col-sm-4 col-form-label col-form-label-sm">Password <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm" id="password"
                                            name="password" value="">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-4 col-form-label col-form-label-sm">Expire
                                        Date <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('expire_date', $user->expire_date ?? '') }}"
                                            class="form-control form-control-sm datepicker" id="expire_date"
                                            name="expire_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="employee_gid" class="col-sm-4 col-form-label col-form-label-sm">User
                                        Role <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="role_id"
                                            name="role_id">
                                            <option value="">Choose...</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @if (isset($user)) {{ $role->id == $user->role_id ? 'selected' : '' }} @endif>
                                                    {{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="branch_id" class="col-sm-4 col-form-label col-form-label-sm">Confirm
                                        Password <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm"
                                            id="password_confirmation" name="password_confirmation"
                                            value="{{ old('employee_gid', $leave->employee->full_name ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 ml-3">
                    <button class="btn btn-warning" type="submit">Submit</button>
                    <a class="btn btn-secondary ml-3" href="{{ url('user/index') }}">Back</a>
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
        $(document).ready(function() {
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
                $("#present_designation_id").empty();
                if (response.present_designation) {
                    $.ajax({
                        url: "{{ url('designation/show') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: response.present_designation.id,
                        },
                        success: function(data) {
                            $("#present_designation_id").append(
                                `<option value="${data.id}">${data.designation}</option>`
                            );
                        }
                    });
                }
                if (response.branch)
                    $("#branch_id").val(response.branch.id).change();
                // image
                if (response.attachment) {
                    var baseUrl = "{{ asset('storage/') }}";
                    var imagePath = baseUrl + '/' + response.attachment.file_path;
                    $('#output').attr('src', imagePath);
                    $('#output').on('error', function() {
                        $('#output').replaceWith(
                            '<p>Image not available</p>'); // Replace with an error message
                    });
                } else {
                    $('#output').removeAttr('src');
                }
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

            // calculate date diffrence --------------88888888888888-------------------
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-20:+20"
            });
        });
    </script>
@endsection
