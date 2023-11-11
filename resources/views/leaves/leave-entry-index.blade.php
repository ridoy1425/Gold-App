@extends('ui.admin_panel.master')

@section('title', 'Leave Entry')

@section('style')
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
                <div class=" ml-auto mb-2 mt-2 mr-3">
                    <a class="btn btn-warning" href="{{ url('leave/entry') }}">New Leave Entry</a>
                </div>
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
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveDatas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->employee->full_name ?? '' }}</td>
                                    <td>{{ $data->employee->present_designation->designation ?? '' }}</td>
                                    <td>{{ $data->employee->branch->name ?? '' }}</td>
                                    <td>{{ $data->leaveType->leave_name ?? '' }}</td>
                                    <td>{{ $data->leave_from ?? '' }}</td>
                                    <td>{{ $data->leave_to ?? '' }}</td>
                                    <td>{{ $data->status->value ?? '' }}</td>
                                    <td>
                                        <a href="{{ URL('leave/entry/edit', $data->id) }}"><i class="fas fa-edit"></i></a>
                                        <a style="color:red;" href="{{ URL('leave/entry/delete', $data->id) }}"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- card-body end --}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
