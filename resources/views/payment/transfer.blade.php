@extends('ui.admin_panel.master')

@section('title', 'Transfer List')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Transfer List</h4>
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
                                            <!-- <a class="send_message_arrow" href="#" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <img src="{{ asset('ui/admin_assets/dist/img/send_message_arrow.png') }}"
                                                    alt="Send" class="action__icon">
                                            </a> -->
                                            <a href="" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <img src="{{ asset('ui/admin_assets/dist/img/send_message.png') }}"
                                                    alt="Send" class="action__icon">
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade action_modal" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <input type="hidden" name="user_id" value="dsfdsf">
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Subject:</label>
                                                                        <input type="text" name="subject"
                                                                            class="box-input mb-0" required>
                                                                    </div>
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Details
                                                                            Message</label>
                                                                        <textarea name="message" class="form-textarea mb-0"></textarea>
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
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                rowHeight: 20,
            });
        });
    </script>
@endsection
