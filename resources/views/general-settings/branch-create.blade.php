@extends('ui.admin_panel.master')

@section('title', 'Create Branch')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
 @if (isset($branch))
 <h4 class="mt-2">Update Branch</h4>
 @else
 <h4 class="mt-2">Create Branch</h4>
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
            @if (isset($branch))
                <form action="{{ url('branch/update', $branch->id) }}" method="post">
                    @method('Patch')
                @else
                    <form action="{{ url('branch/store') }}" method="post">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="card card-default">
                <div class="card-body">
                    <div class="propertyContent">
                        <h6>Branch Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Branch
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="name"
                                            name="name" value="{{ old('name', $branch->name ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Branch
                                        short Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="short_name"
                                            name="short_name" value="{{ old('name', $branch->short_name ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Branch
                                        Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="phone"
                                            name="phone" value="{{ old('phone', $branch->phone ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Branch
                                        Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="email"
                                            name="email" value="{{ old('email', $branch->email ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Branch
                                        Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="code"
                                            name="code" value="{{ old('name', $branch->code ?? '') }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <label for="name" class="col-sm-3 col-form-label col-form-label-sm">Branch
                                        Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" id="address"
                                            name="address" value="{{ old('address', $branch->address ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 ml-3">
                    <button class="btn btn-warning" type="submit">Submit</button>
                    <a class="btn btn-secondary ml-3" href="{{ url('branch/info') }}">Back</a>
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
