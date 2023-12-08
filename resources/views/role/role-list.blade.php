@extends('ui.admin_panel.master')

@section('title', 'Role List')

@section('style')
    <style>
        .button {
            justify-content: center;
            background-color: rgb(202, 167, 7);
            color: #fff;
            border-radius: 30px;
            width: max-content;
            padding: 3px 15px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Role List</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card card-default">
                <div class=" ml-auto mb-2 mt-2 mr-3">
                    <a class="btn btn-warning" href="{{ url('role/create') }}">Add New Role</a>
                </div>
                <div class="card-body">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Role Slug</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->slug }}</td>
                                    <td>
                                        <a href="{{ URL('/role/edit', $role->id) }}">
                                            <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}" alt="Edit"
                                                class="action__icon">
                                        </a>
                                        <a href="{{ URL('/role/delete', $role->id) }}"
                                            onclick="return confirm('Are you sure?')">
                                            <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                alt="Delete" class="action__icon">
                                        </a>
                                        <a class="button"
                                            href="{{ route('permission-list', ['role_id' => $role->id]) }}">Set
                                            Permission</a>
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
