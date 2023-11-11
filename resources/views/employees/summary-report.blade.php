@extends('ui.admin_panel.master')

@section('title', 'Staff Information')

@section('style')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/datepicker.min.css') }}">
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

        /* tr{
                                                                                                            font-size: 10px;
                                                                                                        } */
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Staff Summary Report</h4>
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
                    <form method="GET" action="{{ url('employee/search-summary-report') }}" autocomplete="off">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label for="name" class=" col-form-label col-form-label-sm">Branch</label>
                                    <div class="">
                                        <select class="form-select-sm form-select branch" id="branch" name="branch">
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
                                <div class="mb-1 ">
                                    <label for="year" class=" col-form-label col-form-label-sm">Select Year <span
                                            class="important_field">*</span> </label>
                                    <div class="">
                                        <input type="text" id="year" name="year"
                                            class="form-control form-control-sm datepicker"
                                            value="{{ $selectedYear ?? '' }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <button type="submit" id="" class="btn btn-warning mt-3">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="cell-border" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">Name of the YWCA</th>
                                <th scope="col">Total Staff (Permanent & Contractual)</th>
                                <th scope="col">Permanent Staff</th>
                                <th scope="col">Contractual Staff</th>
                                <th scope="col">Female</th>
                                <th scope="col">Male</th>
                                <th scope="col">No. of Newly recruited Staff</th>
                                <th scope="col">No. of Retired Staff</th>
                                <th scope="col">No. of Resigned Staff</th>
                                <th scope="col">No. of Staff on Contract after Retirement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($employees))
                                <?php
                                $startDate = $selectedYear - 1 . '-07-01';
                                $endDate = $selectedYear . '-06-30';
                                ?>
                                @foreach ($employees as $item)
                                    <tr>
                                        <td>{{ $item[0]->branch->name }}({{ $item[0]->branch->code }})</td>
                                        <td>{{ count($item) }}</td>
                                        <td>{{ $item->where('type_id', '36')->count() }}</td>
                                        <td>{{ $item->where('type_id', '37')->count() }}</td>
                                        <td>{{ $item->where('gender_id', 2)->count() }}</td>
                                        <td>{{ $item->where('gender_id', 1)->count() }}</td>
                                        <td>
                                            <?php
                                            $newRecruited = $item->whereBetween('joining_date', [$startDate, $endDate])->count();
                                            echo $newRecruited;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $retired = $item
                                                ->where('status_id', 39)
                                                ->whereBetween('status_date', [$startDate, $endDate])
                                                ->count();
                                            echo $retired;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $retired = $item
                                                ->where('status_id', 40)
                                                ->whereBetween('status_date', [$startDate, $endDate])
                                                ->count();
                                            echo $retired;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $retired = $item
                                                ->where('status_id', 41)
                                                ->whereBetween('status_date', [$startDate, $endDate])
                                                ->count();
                                            echo $retired;
                                            ?>
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
    {{-- <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script> --}}
    {{-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
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
    <script src="{{ asset('ui/admin_assets/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var selectedYear = urlParams.get('year');
            if (selectedYear !== null) {
                selectedYear = parseInt(selectedYear);
                var previousYear = selectedYear - 1;
            }

            var table = $('#table_id').DataTable({
                searching: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        title: '<div style="text-align:center;"><h2>YWCA of Bangladesh</h2><p style="font-size:12px;">3/23, Iqbal Road, Mohammadpur, Dhaka-1207</p></div><div style="text-align:center;font-size:15px;">Staff Information</div></div><div style="font-size:15px; margin-top:5px;">Period: July, ' +
                            previousYear + ' to June, ' + selectedYear + '</div>',
                        customize: function(win) {
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

            $(".datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true //to close picker once year is selected
            });

            // dropdown value search -----------------888888888888---------------
            $('.branch').select2();
        });
    </script>
@endsection
