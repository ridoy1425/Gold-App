@extends('ui.admin_panel.master')

@section('title', 'Send Message')

@section('style')

@endsection

@section('content_title')
<h4 class="mt-2">Send Message</h4>
@endsection

@section('main_content')
<div class="row page-content">
    <div class="container">
        {{-- card-body start --}}
        <div class="card-default edit__inner__container">
            <div class="message_to_users">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-md-12">
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title"> Message Box</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="{{ url('message/send-to-users') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="site-input-groups row">
                                        <label for="" class="col-sm-3 col-label">Select Users
                                        </label>
                                        <div class="col-sm-9">
                                            <select class="form-select-md form-select box-input" id="user_data" name="users[]"
                                                multiple="multiple" runat="server">
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="site-input-groups row">
                                        <label for="" class="col-sm-3 col-label">Message Template
                                        </label>
                                        <div class="col-sm-9">
                                            <select class="form-select-md form-select box-input" id="template" name="template">
                                                <option value="" selected></option>
                                                @foreach ($template as $row)
                                                <option value="{{ $row->id }}">
                                                    {{ $row->subject }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="site-input-groups row">
                                        <label for="" class="col-sm-3 col-label">Subject
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="subject" id="subject" class="box-input">
                                        </div>
                                    </div>
                                    <div class="site-input-groups row">
                                        <label for="" class="col-sm-3 col-label">Message Body
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea name="message" class="form-textarea" id="message" cols="30"
                                                rows="8"></textarea>
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

    $('#template').on('change', function() {
        var template_id = $(this).val();
        $.ajax({
            url: "{{ url('message/template/single') }}",
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                id: template_id,
            },
            success: function(data) {
                console.log(data['subject']);
                $("#subject").empty();
                $("#message").empty();
                $("#subject").val(data['subject']);
                $("textarea#message").val(data['message']);
            }
        });
    });
});
</script>
@endsection