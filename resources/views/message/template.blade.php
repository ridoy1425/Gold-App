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
                <a href="{{ url('message/template/create') }}" class="card-header-link primary-btn btn">Add New Template
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
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $row)
                                <tr>
                                    <td>{{ $row->subject }}</td>
                                    <td>{{ $row->message }}</td>
                                    @if ($row->status == 'enable')
                                        <td><span class="success">Enable</span></td>
                                    @else
                                        <td><span class="rejected">Disable</span></td>
                                    @endif
                                    <td>
                                        <div class="action_td">
                                            <a href="{{ url('message/template/edit', $row->id) }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}"
                                                    alt="Edit" class="action__icon">
                                            </a>
                                            <a href="" onclick="return confirm('Are you sure?')">
                                                <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                    alt="Delete" class="action__icon">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
