@extends('ui.admin_panel.master')

@section('title', 'Appraisal Category')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">Contact Create</h4>
@endsection

@section('main_content')

<div class="row page-content">
    <div class="container">
    <form action="{{ route('contact.Create') }}" method="post">
        @csrf
        {{-- card-body start --}}
        <div class="card card-default">
            <div class="card-body">
                <div class="propertyContent">
                    <h6>About us</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-1 row">
                                <label for="phone" class="col-sm-4 col-form-label col-form-label-sm">Phone Number<span class="important_field">*</span></label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="phone"
                                        name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-1 row">
                                <label for="address" class="col-sm-4 col-form-label col-form-label-sm">Address<span class="important_field">*</span></label>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control form-control-sm" id="address"
                                        name="address" value="{{ old('address') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 ml-3">
                <button class="btn btn-warning" type="submit">Submit</button>
                <a class="btn btn-secondary ml-3" href="{{ route('contact.List') }}">Back</a>
            </div>
        </div>
        {{-- card-body end --}}
        </form>
    </div>
</div>

@endsection

@section('script')

@endsection
