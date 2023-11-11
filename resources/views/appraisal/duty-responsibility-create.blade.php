@extends('ui.admin_panel.master')

@section('title', 'Duty & Responsibilities')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Duty & Responsibilities</h4>
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
            @if (isset($mainEntity))
                <form action="{{ url('appraisal/responsibility/update', $mainEntity->id) }}" method="post"
                    autocomplete="off">
                    @method('Patch')
                @else
                    <form action="{{ url('appraisal/responsibility/store') }}" method="post" autocomplete="off">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Add Duty & Responsiblity</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label for="branch_id" class="col-sm-2 col-form-label col-form-label-sm"> Branch Info
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="branch_id"
                                            name="branch_id" required>
                                            @if (auth()->user()->hasRole('super-admin') ||
                                                    auth()->user()->hasRole('admin'))
                                                <option selected value="">Choose...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        @if (isset($mainEntity)) {{ $branch->id == $mainEntity->branch_id ? 'selected' : '' }} @endif>
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label for="category_id" class="col-sm-3 col-form-label col-form-label-sm"> Evaluator
                                        Category
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="category_id"
                                            name="category_id" required>
                                            <option selected value="">Choose...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (isset($mainEntity)) {{ $category->id == $mainEntity->category_id ? 'selected' : '' }} @endif>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-right"><button type="button" name="add" id="add"
                                class="btn btn-success mb-1">Add More</button>
                        </div>
                        <table class="table table-bordered" id="responseTable">
                            <thead>
                                <tr>
                                    <th>Duty & Responsibilities</th>
                                    <th style="width: 15%;">Order</th>
                                    <th style="width: 15%;">Marks</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($mainEntity))
                                    @foreach ($mainEntity->DutyResponsibility as $data)
                                        <tr>
                                            <td><input type="text" name="duty_responsibility[]"
                                                    class="form-control form-control-sm"
                                                    value="{{ $data->duty_responsibility ?? '' }}" /></td>
                                            <td>
                                                <input type="hidden" name="master_id[]" value="{{ $data->id ?? '' }}" />
                                                <input type="text" name="order[]" class="form-control form-control-sm"
                                                    value="{{ $data->order ?? '' }}" />
                                            </td>
                                            <td><input type="text" name="marks[]" class="form-control form-control-sm"
                                                    value="{{ $data->marks ?? '' }}" /></td>
                                            <td><button type="button" class="btn btn-danger remove-tr"
                                                    style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td><input type="text" name="addmore[0][duty_responsibility]"
                                                class="form-control form-control-sm" /></td>
                                        <td><input type="text" name="addmore[0][order]"
                                                class="form-control form-control-sm" /></td>
                                        <td><input type="text" name="addmore[0][marks]"
                                                class="form-control form-control-sm" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr"
                                                style="line-height:0.5"><i class="fas fa-trash nav-icon"></i></button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-5 ml-3">
                        <button class="btn btn-warning" type="submit">Submit</button>
                        <a class="btn btn-secondary ml-3" href="{{ url('appraisal/responsibility/index') }}">Back</a>
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
                // dropdown value search -----------------888888888888---------------
                $('#branch_id').select2();

                $(document).on('click', '.remove-tr', function() {
                    $(this).parents('tr').remove();
                });

                var i = 0;
                $("#add").click(function() {
                    i++;
                    event.preventDefault();
                    $("#responseTable").append(
                        '<tr><td><input type="text " name="addmore[' + i +
                        '][duty_responsibility]"  class="evaluator_id_' + i +
                        ' form-control form-control-sm"/></td><td><input type="text" name="addmore[' +
                        i +
                        '][order]" class="employee_id_' + i +
                        ' form-control form-control-sm" /></td><td><input type="text " name="addmore[' + i +
                        '][marks]"  class="evaluator_id_' + i +
                        ' form-control form-control-sm"/></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash nav-icon"></i></button></td></tr>'
                    );
                });
            });
        </script>
    @endsection
