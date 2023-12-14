@extends('ui.admin_panel.master')

@section('title', 'Message')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Sent Message</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            <div class="btn__small mb-2 mt-1 text-end">
                <a href="{{ url('message/mark-as-read') }}" class="card-header-link primary-btn btn">All Mark As Read
                </a>
            </div>
            {{-- card-body start --}}
            <div class="card card-default edit__inner__container">
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Sent To</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($message as $row)
                                @php
                                    $data = json_decode($row->data, true);
                                @endphp
                                <tr>
                                    <td>{{ date('d-M, Y', strtotime($row->created_at)) }}
                                    <td>{{ $row->notifiable->name }}
                                    <td>{{ $data['subject'] }}</td>
                                    <td>{{ $data['message'] }}</td>
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
