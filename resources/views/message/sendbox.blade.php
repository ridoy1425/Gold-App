@extends('ui.admin_panel.master')

@section('title', 'Message')

@section('style')

@endsection

@section('content_title')
<h4 class="mt-2">Inbox</h4>
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
                            <h3 class="title"> Edit New User Template</h3>
                            <div class="card-header-links">
                                <a href="" class="card-header-link primary-btn back_btn btn">Back
                                </a>
                            </div>
                        </div>
                        <div class="site-card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="site-input-groups row">
                                    <label for="" class="col-sm-3 col-label">Message Body
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" data-lucide="info"
                                            icon-name="info" data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="Write the main Messages here"
                                            class="lucide lucide-info">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 16v-4"></path>
                                            <path d="M12 8h.01"></path>
                                        </svg>
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea name="message_body" class="form-textarea" cols="30"
                                            rows="8">Thanks for joining us  [[full_name]] [[message]]</textarea>

                                        <p class="paragraph mb-0 mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                data-lucide="alert-triangle" icon-name="alert-triangle"
                                                class="lucide lucide-alert-triangle">
                                                <path
                                                    d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z">
                                                </path>
                                                <path d="M12 9v4"></path>
                                                <path d="M12 17h.01"></path>
                                            </svg>The Shortcuts you can use
                                            <strong>[[full_name]], [[message]]</strong>
                                        </p>
                                    </div>
                                </div>

                                <div class="row site-input-groups">
                                    <label for="" class="col-sm-3 col-label pt-0">Template Status<svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" data-lucide="info"
                                            icon-name="info" data-bs-toggle="tooltip" title=""
                                            data-bs-original-title="Template Status" class="lucide lucide-info">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 16v-4"></path>
                                            <path d="M12 8h.01"></path>
                                        </svg>
                                    </label>
                                    <div class="col-sm-5">
                                        <div class="site-input-groups mb-0">
                                            <div class="switch-field mb-0">
                                                <input type="radio" id="template_status_enable" name="status" value="1"
                                                    checked="">
                                                <label for="template_status_enable">Enable</label>
                                                <input type="radio" id="template_status_disable" name="status"
                                                    value="0">
                                                <label for="template_status_disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="site-btn-sm primary-btn w-100">Save
                                            Changes
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
    $('#table_id').DataTable({
        rowHeight: 20,
    });
});
</script>
@endsection