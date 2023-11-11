@extends('ui.admin_panel.master')

@section('title', 'Create Role')

@section('style')
    <style>
    </style>
@endsection

@section('content_title')
 @if (isset($role))
 <h4 class="mt-2">Update Role</h4>
 @else
 <h4 class="mt-2">Create Role</h4>
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
            @if (isset($role))
                <form action="{{ url('role/update', $role->id) }}" method="post" autocomplete="off">
                    @method('PATCH')
                @else
                    <form action="{{ url('role/store') }}" method="post" autocomplete="off">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Role Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="role_name" class="col-sm-4 col-form-label col-form-label-sm">Role
                                        Name <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="role_name"
                                            name="role_name" value="{{ old('role_name', $role->role_name ?? '') }}">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="display_name" class="col-sm-4 col-form-label col-form-label-sm">Display
                                        Name <span
                                            class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="display_name"
                                            name="display_name"
                                            value="{{ old('display_name', $role->display_name ?? '') }}">
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="branch_id" class="col-sm-4 col-form-label col-form-label-sm">Branch
                                        Name</label>
                                    <div class="col-sm-8">
                                        <select class="form-select-sm form-select designation" id="branch_id"
                                            name="branch_id">
                                            <option selected value="">Choose...</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (isset($role->branch_id)) {{ $branch->id == $role->branch_id ? 'selected' : '' }} @endif>
                                                    {{ $branch->name }}( {{ $branch->code }})</option>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        @include('employees.employee-search-modal')
    </div>
@endsection

@section('script')
@endsection
