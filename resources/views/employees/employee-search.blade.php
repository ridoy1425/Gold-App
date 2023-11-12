@extends('ui.admin_panel.master')

@section('title', 'Employee Report Information')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/buttons.dataTables.min.css') }}"> --}}
    <style>
        .button {
            background: forestgreen;
            color: #fff;
            padding: 0 10px;
        }

        div.dt-buttons {
            position: relative;
            float: right;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Employment Basic Report</h4>
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
                    <h6>Employee Search</h6>
                    <form method="GET" action="{{ url('employee/report-search') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1 ">
                                    <label for="name" class=" col-form-label col-form-label-sm">Employee ID</label>
                                    <div class="">
                                        <input type="text" class="form-control form-control-sm" id="employee_id"
                                            name="employee_id">
                                    </div>
                                </div>
                                <div class="mb-1 ">
                                    <label for="name" class=" col-form-label col-form-label-sm">Degree</label>
                                    <select class="form-select-sm form-select designation" id="degree" name="degree"
                                        runat="server">
                                        <option selected value="">Choose...</option>
                                        @foreach ($payloads as $payload)
                                            @if ($payload->type == 'degree')
                                                <option value="{{ $payload->id }}">
                                                    {{ $payload->value }}
                                                </option>
                                            @endif
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
                                <button type="submit" class="btn btn-warning mt-4">Generate Report</button>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="name" class=" col-form-label col-form-label-sm">Designation</label>
                                    <div class="">
                                        <select class="form-select-sm form-select designation" id="designation"
                                            name="designation">
                                            <option selected value="">Choose...</option>
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
                                    <label for="name" class=" col-form-label col-form-label-sm">Age</label>
                                    <div class="">
                                        <select class="form-select-sm form-select" id="age_range" name="age_range">
                                            <option selected value="">Choose...</option>
                                            @foreach ($payloads as $payload)
                                                @if ($payload->type == 'age')
                                                    <option value="{{ $payload->value }}">
                                                        {{ $payload->value }} above
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="name" class=" col-form-label col-form-label-sm">Religion</label>
                                    <div class="">
                                        <select class="form-select-sm form-select" id="religion" name="religion">
                                            <option selected value="">Choose...</option>
                                            @foreach ($payloads as $payload)
                                                @if ($payload->type == 'religion')
                                                    <option value="{{ $payload->id }}">
                                                        {{ $payload->value }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
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
                                <th scope="col">Full Name</th>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Branch</th>
                                {{-- <th scope="col">Degree</th> --}}
                                <th scope="col">Religion</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Age</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($employees))
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->employee_gid }}</td>
                                        <td>{{ $employee->present_designation->designation ?? '' }}</td>
                                        <td>{{ $employee->branch->name ?? '' }}</td>
                                        {{-- <td>{{ $employee->academy[0]->degree ?? '' }}</td> --}}
                                        <td>{{ $employee->religion->value ?? '' }}</td>
                                        <td>{{ $employee->dob }}</td>
                                        <td>{{ $employee->age['years'] }} y, {{ $employee->age['months'] }} m,
                                            {{ $employee->age['days'] }} d</td>
                                        <td>
                                            <a class="button" target="_blank"
                                                href="{{ url('employee/report-page', $employee->id) }}">
                                                Print</a>
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
    </div>
@endsection

@section('script')
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js">
    </script>
    {{-- <script src="{{ asset('ui/admin_assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/jszip.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('ui/admin_assets/js/buttons.print.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            // search form old value set from url
            var urlParams = new URLSearchParams(window.location.search);
            $('#employee_id').val(urlParams.get('employee_id'));
            $('#degree').val(urlParams.get('degree'));
            $('#designation_label').val(urlParams.get('designation_label'));
            $('#designation').val(urlParams.get('designation'));
            $('#branch').val(urlParams.get('branch'));
            $('#age_range').val(urlParams.get('age_range'));
            $('#religion').val(urlParams.get('religion'));
            $('#religion').val(urlParams.get('religion'));


            var table = $('#table_id').DataTable({
                searching: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        customize: function(win) {
                            var body = $(win.document.body).find('table').first();
                            body.find('td:nth-child(10), th:nth-child(10)').hide();
                            $(win.document.body).find('th').css('border', '1px solid #000');
                            $(win.document.body).find('tr').css('border', '1px solid #000');
                            $(win.document.body).find('td').css('border', '1px solid #000');
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                ]
            });
            // table.columnDefs().forEach(function(columnDef, index) {
            //     if (columnDef.targets && columnDef.targets.includes(2)) {
            //         columnDef.visible = false;
            //     }
            // });

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
        });
    </script>
@endsection
