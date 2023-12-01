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
        <div class="card card-default edit__inner__container">
            {{-- <div class=" ml-auto mb-2 mt-2 mr-3">
                <a class="btn btn-warning" href="{{ url('designation/label/create') }}">Add New Label</a>
        </div> --}}
        <div class="card-body table-responsive">
            <table class="table" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Sender Name</th>
                        <th scope="col">Sender ID</th>
                        <th scope="col">Recipient</th>
                        <th scope="col">Recipient ID</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nov 5, 2023</td>
                        <td>Username</td>
                        <td>U00152</td>
                        <td>user name </td>
                        <td>U00153</td>
                        <td>$50</td>
                        <td><span class="success">Success</span></td>
                        <td>
                            <div class="action_td">
                                <a class="send_message_arrow" href="#">
                                    <img src="{{ asset('ui/admin_assets/dist/img/send_message_arrow.png') }}" alt="Send"
                                        class="action__icon">
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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