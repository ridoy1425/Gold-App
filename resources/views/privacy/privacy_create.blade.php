@extends('ui.admin_panel.master')

@section('title', 'Appraisal Category')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">Privacy Create</h4>
@endsection

@section('main_content')

<div class="row page-content">
    <div class="container">
        <form action="{{ route('privacy.Create') }}" method="post">
        @csrf
        {{-- card-body start --}}
        <div class="card card-default">
            <div class="card-body">
                <div class="propertyContent">
                    {{-- <h6>About us</h6> --}}
                    <div class="row">
                        <div class="mb-1 row">
                            <label for="" class="col-sm-4 col-form-label col-form-label-sm">Page Type
                            </label>
                            <div class="col-sm-8">
                                <select name="page_type" class="form-select-md form-select box-input" id="template" name="template">
                                    <option value="" selected></option>
                                    <option value="1">Privacy Policies</option>
                                    <option value="2">Refund Policies</option>
                                    <option value="3">Terms and Conditions</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-1 row">
                                <label for="title" class="col-sm-4 col-form-label col-form-label-sm">Title<span class="important_field">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="title"
                                        name="title" value="{{ old('title') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-1 row">
                                <label for="sub_title" class="col-sm-4 col-form-label col-form-label-sm">Sub Title<span class="important_field">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="sub_title"
                                        name="sub_title" value="{{ old('sub_title') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-1 row">
                                <label for="description" class="col-sm-4 col-form-label col-form-label-sm">Description<span class="important_field">*</span></label>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control form-control-sm" id="description"
                                        name="description" value="{{ old('description') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 ml-3">
                <button class="btn btn-warning" type="submit">Submit</button>
                <a class="btn btn-secondary ml-3" href="{{ route('privacy.List') }}">Back</a>
            </div>
        </div>
        {{-- card-body end --}}
        </form>
    </div>
</div>

@endsection

@section('script')

@endsection
