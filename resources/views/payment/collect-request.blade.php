@extends('ui.admin_panel.master')

@section('title', 'Request List')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Request List</h4>
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
                                <th scope="col">Order ID</th>
                                <th scope="col">CUSTOMER</th>
                                <th scope="col">COLLECT TYPE</th>
                                <th scope="col">AMOUNT</th>
                                <th scope="col">GOLD</th>
                                <th scope="col">METHOD</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($request as $row)
                                <tr>
                                    <td>{{ date('d-M, Y', strtotime($row->created_at)) }}</td>
                                    <td>{{ $row->order->order_id }}</td>
                                    <td>{{ $row->order->user->name }}</td>
                                    <td>{{ $row->collect_type }}</td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->gold }}</td>
                                    <td>{{ $row->payment_method }}</td>
                                    @if ($row->status == 'active')
                                        <td><span class="success">Active</span>
                                        </td>
                                    @elseif ($row->status == 'in-process')
                                        <td><span class="in_process">In
                                                Process</span></td>
                                    @elseif ($row->status == 'completed')
                                        <td><span class="completed">Completed</span>
                                        </td>
                                    @elseif ($row->status == 'rejected')
                                        <td><span class="rejected">Rejected</span>
                                        </td>
                                    @else
                                        <td><span class="pending">Pending</span>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="action_td">
                                            <a href="button" data-bs-toggle="modal"
                                                data-bs-target="#edit_iconModal{{ $row->id }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}"
                                                    alt="Edit" class="action__icon">
                                            </a>
                                            <!--  <a class="send_message_arrow" href="#" data-bs-toggle="modal"
                                                                                        data-bs-target="#exampleModal">
                                                                                        <img src="{{ asset('ui/admin_assets/dist/img/send_message_arrow.png') }}" alt="Send"
                                                                                            class="action__icon">
                                                                                    </a> -->
                                            <a href="" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $row->id }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/send_message.png') }}"
                                                    alt="Message" class="action__icon">
                                            </a>
                                            <a href="{{ url('collection-delete', $row->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                    alt="Delete" class="action__icon">
                                            </a>
                                            <!-- Modal -->
                                            <div class="payment__modal kyc__modal modal fade action_modal"
                                                id="edit_iconModal{{ $row->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content site-table-modal">
                                                        <div class="modal-body popup-body">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                            <form action="{{ url('change-collection-status') }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="mt-4">
                                                                    <input type="hidden" value="{{ $row->id }}"
                                                                        name="collection_id" readonly>
                                                                    <label for="">Update Status</label>
                                                                    <select class="form-select-md form-select box-input"
                                                                        id="status" name="status" required>
                                                                        @foreach ($statuses as $status)
                                                                            <option
                                                                                value="{{ \Illuminate\Support\Str::slug($status->value) }}"
                                                                                {{ $row->status == \Illuminate\Support\Str::slug($status->value) ? 'selected' : '' }}>
                                                                                {{ $status->value }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button type="submit"
                                                                    class="site-btn-sm mt-3 primary-btn w-100">Update
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                                            Template:</label>
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
                                                                            class="box-input-label">Subject:</label>
                                                                        <input type="text" name="subject"
                                                                            id="subject" class="box-input mb-0"
                                                                            required>
                                                                    </div>
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Details
                                                                            Message</label>
                                                                        <textarea name="message" id="message" class="form-textarea mb-0"></textarea>
                                                                    </div>
                                                                    <input type="hidden" name="receiver_id"
                                                                        value="{{ $row->order->user_id }}">
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
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                rowHeight: 20,
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
