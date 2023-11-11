@extends('ui.admin_panel.master')

@section('title', 'Permissions')

@section('style')
    <style>
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Permissions</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            <form action="{{ url('role/permission') }}" method="post">
                @csrf
                {{-- card-body start --}}
                <div class="card card-default">
                    <div class="card-body">
                        <div class="propertyContent">
                            <h5>Ser Role Wise Permission</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-1 row">
                                        <label for="role_name" class="col-sm-4 col-form-label col-form-label-sm">Role
                                            Name</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" value="{{ old('role_name', $role->id ?? '') }}"
                                                name="role_id">
                                            <input type="text" class="form-control form-control-sm" id="role_name"
                                                name="role_name" value="{{ old('role_name', $role->role_name ?? '') }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach ($permissions as $category => $permission)
                                <hr>
                                <h6>{{ $category }}</h6>
                                <div class="row ml-3">
                                    @foreach ($permission as $data)
                                        <div class="col-md-4">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="permissions[]" value="{{ $data->id }}"
                                                    {{ $role->hasPermission($data) ? 'checked' : '' }}>
                                                {{ $data->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-5 ml-3">
                        <button class="btn btn-warning" type="submit">Submit</button>
                        <a class="btn btn-secondary ml-3" href="{{ url('role/index') }}">Back</a>
                    </div>
                </div>
                {{-- card-body end --}}
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
