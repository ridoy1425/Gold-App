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
                                        Name <span class="important_field">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="role_name"
                                            name="name" value="{{ old('role_name', $role->name ?? '') }}">
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
    </div>
@endsection

@section('script')
@endsection
