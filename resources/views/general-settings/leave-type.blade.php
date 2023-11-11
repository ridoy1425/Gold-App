@extends('ui.admin_panel.master')

@section('title', 'Leave Type')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
    @if (isset($leaveType))
        <h4 class="mt-2">Update Leave Type</h4>
    @else
        <h4 class="mt-2">Create Leave Type</h4>
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
            @if (isset($leaveType))
                <form action="{{ url('leave/type', $leaveType->id) }}" method="post">
                    @method('Patch')
                @else
                    <form action="{{ url('leave/type') }}" method="post">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Leave Type</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Leave
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ old('leave_name', $leaveType->leave_name ?? '') }}"
                                            class="form-control form-control-sm" id="leave_name" name="leave_name" required>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">No of
                                        Days</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ old('no_of_days', $leaveType->no_of_days ?? '') }}"
                                            class="form-control form-control-sm" id="no_of_days" name="no_of_days" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mb-5 ml-3">
                    <button class="btn btn-warning" type="submit">Submit</button>
                    <a class="btn btn-secondary ml-3" href="{{ url('leave/index') }}">Back</a>
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
