@extends('ui.admin_panel.master')

@section('title', 'Create Designation')

@section('style')
<style>
.display {
    display: none;
}
</style>
@endsection

@section('content_title')
@if (isset($designation))
<h4 class="mt-2">Update Designation</h4>
@else
<h4 class="mt-2">Create Designation</h4>
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
        @if (isset($designation))
        <form action="{{ url('designation/update', $designation->id) }}" method="post">
            @method('PATCH')
            @else
            <form action="{{ url('designation/store') }}" method="post" enctype="multipart/form-data">
                @endif
                @csrf
                {{-- card-body start --}}
                <div class="card card-default">
                    <div class="card-body">
                        <div class="propertyContent">
                            <h6>Designation Information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-4 col-form-label col-form-label-sm">Designation
                                            Label</label>
                                        <div class="col-sm-8">
                                            <select class="form-select form-select-sm" id="label_id" name="label_id"
                                                required>
                                                <option selected disabled value="">Choose...</option>
                                                @foreach ($labels as $label)
                                                <option value="{{ $label->id }}" @if (isset($designation))
                                                    {{ $label->id == $designation->label_id ? 'selected' : '' }} @endif>
                                                    {{ $label->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="designation"
                                            class="col-sm-4 col-form-label col-form-label-sm">Designation(English)</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                value="{{ old('designation', $designation->designation ?? '') }}"
                                                class="form-control form-control-sm" id="designation" name="designation"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="designation_bn"
                                            class="col-sm-4 col-form-label col-form-label-sm">Designation(বাংলা)</label>
                                        <div class="col-sm-8">
                                            <input type="text"
                                                value="{{ old('designation_bn', $designation->designation_bn ?? '') }}"
                                                class="form-control form-control-sm" id="designation_bn"
                                                name="designation_bn" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 ml-3">
                        <button class="btn btn-warning" type="submit">Submit</button>
                        <a class="btn btn-secondary ml-3" href="{{ url('designation/info') }}">Back</a>
                    </div>
                </div>
                {{-- card-body end --}}
            </form>
    </div>
</div>
@endsection

@section('script')
<script></script>
@endsection