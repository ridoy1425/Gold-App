@extends('ui.admin_panel.master')

@section('title', 'User List')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">User List</h4>
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
                    <a class="btn btn-warning" href="{{ url('user/create') }}">Add User</a>
                </div>
                <div class="card-body">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">user Name</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Degisnation</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->employee->full_name ?? '' }}</td>
                                    <td>{{ $user->employee->branch->name ?? '' }}({{ $user->employee->branch->code ?? '' }})</td>
                                    <td>{{ $user->role->role_name ?? '' }}</td>
                                    <td>{{ $user->employee->present_designation->designation ?? '' }}</td>
                                    <td>
                                        <a href="{{ URL('/user/edit', $user->id) }}"><i class="fas fa-edit"></i></a>
                                        <a style="color:red;" href="{{ URL('/user/delete', $user->id) }}"><i
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
