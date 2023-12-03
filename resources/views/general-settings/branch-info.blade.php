@extends('ui.admin_panel.master')

@section('title', 'Branch Information')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">Branch Information</h4>
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
                    <a class="btn btn-warning" href="{{ url('branch/create') }}">Add New Branch</a>
                </div>
                <div class="card-body">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Branch Name</th>
                                <th scope="col">Branch Code</th>
                                <th scope="col">Short Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->code }}</td>
                                    <td>{{ $branch->short_name }}</td>
                                    <td>{{ $branch->email }}</td>
                                    <td>{{ $branch->phone }}</td>
                                    <td>{{ $branch->address }}</td>
                                    <td>
                                        <a href="{{ URL('branch/edit', $branch->id) }}"><i class="fas fa-edit"></i></a>
                                        <a style="color:red;" href="{{ URL('branch/delete', $branch->id) }}"><i
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
