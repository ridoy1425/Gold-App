@extends('ui.admin_panel.master')

@section('title', 'Create Designation Label')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
    @if (isset($label))
        <h4 class="mt-2">Update Designation Label</h4>
    @else
        <h4 class="mt-2">Create Designation Label</h4>
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
            @if (isset($label))
                <form action="{{ url('designation/label/update', $label->id) }}" method="post">
                    @method('PATCH')
                @else
                    <form action="{{ url('designation/label/store') }}" method="post">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Designation Label Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="label" class="col-sm-3 col-form-label col-form-label-sm">Designation
                                        Label</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="label"
                                            name="label" value="{{ old('label', $label->label ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 ml-3">
                    <button class="btn btn-warning" type="submit">Submit</button>
                    <a class="btn btn-secondary ml-3" href="{{ url('designation/label') }}">Back</a>
                </div>
            </div>
            {{-- card-body end --}}
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
