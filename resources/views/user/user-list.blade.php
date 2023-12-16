@extends('ui.admin_panel.master')

@section('title', 'User List')

@section('style')
    @include('include_files.css_link')
@endsection

@section('content_title')
    <h4 class="mt-2">User List</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card card-default edit__inner__container">
                <div class="m-3">
                    <h6>Filter</h6>
                    <form method="POST" action="{{ url('user/filter') }}" id="filter" autocomplete="off">
                        @csrf
                        @include('include_files.filter')
                    </form>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">USER NAME</th>
                                <th scope="col">USER Id</th>
                                <th scope="col">PHONE</th>
                                <th scope="col">E-MAIL</th>
                                <th scope="col">BALANCE</th>
                                <th scope="col">KYC</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->master_id }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ optional($user->wallet)->balance ?? '0.00' }}</td>
                                    @if (optional($user->kyc)->status == 'rejected')
                                        <td><span class="rejected">Rejected</span></td>
                                    @elseif(optional($user->kyc)->status == 'approved')
                                        <td><span class="completed">Complete</span></td>
                                    @else
                                        <td><span class="in_process">Incomplete</span></td>
                                    @endif
                                    @if ($user->status == 'pending')
                                        <td><span class="pending">Pending</span></td>
                                    @elseif($user->status == 'active')
                                        <td><span class="success">Active</span></td>
                                    @else
                                        <td><span class="rejected">Inactive</span></td>
                                    @endif
                                    <td>
                                        <div class="action_td">
                                            <a href="{{ URL('user/edit', $user->id) }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}"
                                                    alt="Edit" class="action__icon">
                                            </a>
                                            <a href="" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $user->id }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/send_message.png') }}"
                                                    alt="Message" class="action__icon">
                                            </a>
                                            <a href="{{ URL('user/delete', $user->id) }}"
                                                onclick="return confirm('Are you sure?')">
                                                <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                    alt="Delete" class="action__icon">
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade action_modal" id="exampleModal{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content site-table-modal">
                                                        <div class="modal-body popup-body">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                            <div class="popup-body-text" id="kyc-action-data">
                                                                <h3 class="title mb-4">
                                                                    Send Message to {{ $user->name }}
                                                                </h3>
                                                                <form action="{{ url('message/send') }}" method="post">
                                                                    @csrf
                                                                    <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Message
                                                                            Template</label>
                                                                        <select class="form-select-md form-select box-input"
                                                                            id="template" name="template">
                                                                            <option value="" selected>
                                                                            </option>
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
                                                                        value="{{ $user->id }}">
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
