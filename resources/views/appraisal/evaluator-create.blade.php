@extends('ui.admin_panel.master')

@section('title', 'Appraisal Category')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Evaluator Information</h4>
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
            @if (isset($evaluator))
                <form action="{{ url('appraisal/evaluator/update', $evaluator->id) }}" method="post" autocomplete="off">
                    @method('Patch')
                @else
                    <form action="{{ url('appraisal/evaluator/store') }}" method="post" autocomplete="off">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Add Evaluator</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label for="branch_id" class="col-sm-4 col-form-label col-form-label-sm"> Branch Info
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="branch_id"
                                            name="branch_id" required>
                                            @if (auth()->user()->hasRole('super-admin') ||
                                                    auth()->user()->hasRole('admin'))
                                                <option selected value="">Choose...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        @if (isset($evaluator)) {{ $branch->id == $evaluator->branch_id ? 'selected' : '' }} @endif>
                                                        {{ $branch->name }}({{ $branch->code }})
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected value="{{ auth()->user()->role->branch_id }}">
                                                    {{ auth()->user()->role->branch->name ?? '' }}({{ auth()->user()->role->branch->code ?? '' }})
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="category_id" class="col-sm-4 col-form-label col-form-label-sm"> Appraisal
                                        Category
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="category_id"
                                            name="category_id" required>
                                            <option selected value="">Choose...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (isset($evaluator)) {{ $category->id == $evaluator->category_id ? 'selected' : '' }} @endif>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-4 col-form-label col-form-label-sm"> Add Evaluators
                                    </label>
                                    <div class="col-sm-8">
                                        <button class="btn btn-success remove-tr float-right mb-2" id="add">Add
                                            More</i></button>
                                        <table class="table table-bordered" id="evaluatorTable">
                                            <tbody>
                                                @if (isset($evaluators))
                                                    @foreach ($evaluators as $key => $row)
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="evaluator_id[]"
                                                                    class="employee_id_{{ $key }}"
                                                                    value="{{ old('evaluator_id', $row->evaluator_id ?? '') }}"
                                                                    readonly /><input type="text" name="valuator_name[]"
                                                                    class="evaluator_id_{{ $key }} form-control form-control-sm"
                                                                    placeholder="Double Click to Browse"
                                                                    value="{{ old('evaluator_name', $row->evaluator->full_name ?? '') }}" />
                                                                <input type="hidden" name="master_id[]"
                                                                    value="{{ old('id', $row->id ?? '') }}" readonly />
                                                            </td>
                                                            <td>
                                                                <button style="color:red; padding:0 15px; border-color:red"
                                                                    class="remove-tr"><i class="fas fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="addmore[0][evaluator_id]"
                                                                class="employee_id_0" readonly /><input type="text"
                                                                name="addmore[0][evaluator_name]"
                                                                class="evaluator_id_0 form-control form-control-sm"
                                                                placeholder="Double Click to Browse" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger remove-tr"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 ml-3">
                        <button class="btn btn-warning" type="submit">Submit</button>
                        <a class="btn btn-secondary ml-3" href="{{ url('appraisal/evaluator/index') }}">Back</a>
                    </div>
                </div>
                {{-- card-body end --}}
                </form>
            </div>
            @include('employees.employee-search-modal')
            <input type="hidden" value="" id="gettingDynamicId">
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                // dropdown value search -----------------888888888888---------------
                $('#branch_id').select2();

                $(document).on('click', '.remove-tr', function() {
                    $(this).parents('tr').remove();
                });

                var i = 0;
                $("#add").click(function() {
                    i++;
                    event.preventDefault();
                    $("#evaluatorTable").append(
                        '<tr><td><input type="hidden" name="addmore[' +
                        i +
                        '][evaluator_id]" class="employee_id_' + i +
                        '"/><input type="text " name="addmore[' + i +
                        '][evaluator_name]"  class="evaluator_id_' + i +
                        ' form-control form-control-sm" placeholder="Double Click to Browse"/></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash nav-icon"></i></button></td></tr>'
                    );
                });

                $(document).on("dblclick", "[class^='evaluator_id']", function() {
                    var evaluatorIndex = $(this).index("[class^='evaluator_id']");
                    $("#gettingDynamicId").val(evaluatorIndex);
                    document.querySelector('#reject_modal')
                        .style.display = 'block';
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
                function dataInsertInForm(response) {
                    var evaluatorIndex = $("#gettingDynamicId").val();
                    console.log(evaluatorIndex)
                    var evaluator_name = ".evaluator_id_" + evaluatorIndex;
                    var evaluator_id = ".employee_id_" + evaluatorIndex;
                    $(evaluator_name).val(response.full_name);
                    $(evaluator_id).val(response.id);
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
