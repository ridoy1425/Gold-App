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
        <div class="btn__small mb-2 mt-1 text-end">
            <a href="#" class="card-header-link primary-btn btn">Add
            </a>
        </div>
        {{-- card-body start --}}
        <div class="card card-default edit__inner__container">
            {{-- <div class=" ml-auto mb-2 mt-2 mr-3">
                <a class="btn btn-warning" href="{{ url('designation/label/create') }}">Add New Label</a>
        </div> --}}

        <div class="card-body table-responsive">
            <table class="table dataTable no-footer" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">SMS FOR</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        <div class="table-description d-flex">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" data-lucide="mail" icon-name="mail"
                                    class="lucide lucide-mail">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                            </div>
                            <div class="description">
                                <strong>New User</strong>
                                <div class="date fst-italic">Admin</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="success">Active</span></td>
                    <td>
                        <div class="action_td">
                            <a href="">
                                <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}" alt="Edit"
                                    class="action__icon">
                            </a>
                            <a href="" onclick="return confirm('Are you sure?')">
                                <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}" alt="Delete"
                                    class="action__icon">
                            </a>
                        </div>
                    </td>
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