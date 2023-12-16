@extends('ui.admin_panel.master')

@section('title', 'Transfer List')

@section('style')
    @include('include_files.css_link')
@endsection

@section('content_title')
    <h4 class="mt-2">Transfer List</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card card-default edit__inner__container">
                <div class="m-3">
                    <h6>Filter</h6>
                    <form method="POST" action="{{ url('transfer/filter') }}" id="filter" autocomplete="off">
                        @csrf
                        @include('include_files.filter')
                    </form>
                </div>
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
                            @foreach ($transfer as $row)
                                <tr>
                                    <td>{{ date('d-M, Y', strtotime($row->created_at)) }}</td>
                                    <td>{{ $row->sender->name }}</td>
                                    <td>{{ $row->sender->master_id }}</td>
                                    <td>{{ $row->receiver->name }}</td>
                                    <td>{{ $row->receiver->master_id }}</td>
                                    <td>{{ $row->amount }}</td>
                                    @if ($row->status == 'success')
                                        <td><span class="success">Success</span></td>
                                    @else
                                        <td><span class="pending">Failed</span></td>
                                    @endif
                                    <td>
                                        <div class="action_td">
                                            <a href="" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $row->id }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/send_message.png') }}"
                                                    alt="Send" class="action__icon">
                                            </a>
                                            <a href="{{ url('transfer-delete', $row->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                    alt="Delete" class="action__icon">
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade action_modal" id="exampleModal{{ $row->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content site-table-modal">
                                                        <div class="modal-body popup-body">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                            <div class="popup-body-text" id="kyc-action-data">
                                                                <h3 class="title mb-4">
                                                                    Send Message

                                                                </h3>
                                                                <form action="{{ url('message/send') }}" method="post">
                                                                    @csrf
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Message
                                                                            Template</label>
                                                                        <select class="form-select-md form-select box-input"
                                                                            id="template" name="template">
                                                                            <option value="" selected></option>
                                                                            @foreach ($template as $data)
                                                                                <option value="{{ $data->id }}">
                                                                                    {{ $data->subject }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Subject</label>
                                                                        <input type="text" name="subject" id="subject"
                                                                            class="box-input mb-0" required>
                                                                    </div>
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Details
                                                                            Message</label>
                                                                        <textarea name="message" id="message" class="form-textarea mb-0"></textarea>
                                                                    </div>
                                                                    <input type="hidden" name="receiver_id"
                                                                        value="{{ $row->sender_id }}">
                                                                    <div class="action-btns">
                                                                        <button type="submit"
                                                                            class="btn primary-btn centered me-2">
                                                                            <i class="fas fa-paper-plane"></i>
                                                                            Send Message
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    @include('include_files.js_link')
    <script>
        $(document).ready(function() {
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
