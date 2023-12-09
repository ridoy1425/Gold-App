@extends('ui.admin_panel.master')

@section('title', 'Message Template')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Message Template</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card-default edit__inner__container">
                {{-- <div class=" ml-auto mb-2 mt-2 mr-3">
                <a class="btn btn-warning" href="{{ url('designation/label/create') }}">Add New Label</a>
        </div> --}}
                <div class="message_to_users">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-md-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h3 class="title"> Message Box</h3>
                                    <div class="card-header-links">
                                        <a href="{{ route('template-index') }}"
                                            class="card-header-link back_btn btn">Back
                                        </a>
                                    </div>
                                </div>
                                <div class="site-card-body">
                                    {{-- @if (isset($template)) --}}
                                    <form action="{{ url('message/template/update') }}" method="post">
                                        @csrf

                                        {{-- @else
                                            <form action="{{ url('message/template/create') }}" method="post">
                                                @csrf --}}
                                        {{-- @endif --}}
                                        <div class="site-input-groups row">
                                            <label for="" class="col-sm-3 col-label">Subject
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="subject" value="{{ $template->subject ?? '' }}"
                                                    class="box-input">
                                            </div>
                                        </div>
                                        <div class="site-input-groups row">
                                            <label for="" class="col-sm-3 col-label">Message Body
                                            </label>
                                            <div class="col-sm-9">
                                                <textarea name="message" class="form-textarea" cols="30" rows="8">{{ $template->message ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row site-input-groups">
                                            <label for="" class="col-sm-3 col-label pt-0">Template Status
                                            </label>
                                            <div class="col-sm-5">
                                                <div class="site-input-groups mb-0">
                                                    <div class="switch-field mb-0">
                                                        <input type="radio" id="template_status_enable" name="status"
                                                            value="enable" <?php if (isset($template)) {
                                                                echo $template->status == 'enable' ? 'checked' : '';
                                                            } else {
                                                                echo 'checked';
                                                            } ?>>
                                                        <label for="template_status_enable">Enable</label>
                                                        <input type="radio" id="template_status_disable" name="status"
                                                            value="disable" <?php if (isset($template)) {
                                                                echo $template->status == 'disable' ? 'checked' : '';
                                                            } ?>>
                                                        <label for="template_status_disable">Disable</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="site-btn-sm primary-btn w-100">Send Message
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- card-body end --}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#user_data").select2({
                maximumSelectionLength: 2
            });
        });
    </script>
@endsection
