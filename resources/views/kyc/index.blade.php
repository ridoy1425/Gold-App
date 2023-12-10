@extends('ui.admin_panel.master')

@section('title', 'Kyc List')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Kyc List</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card card-default edit__inner__container ">
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">USER NAME</th>
                                <th scope="col">DATE</th>
                                <th scope="col">KYC TYPE</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kycInfo as $label)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $label->user->name }}</td>
                                    <td>{{ $label->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $label->kycType ? $label->kycType->value : '' }}</td>
                                    @if ($label->status == 'pending')
                                        <td><span class="pending">Pending</span></td>
                                    @elseif($label->status == 'approved')
                                        <td><span class="success">Approved</span></td>
                                    @else
                                        <td><span class="rejected">Rejected</span></td>
                                    @endif
                                    <td>
                                        <div class="action_td">
                                            <a href="" type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $label->id }}">
                                                <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}"
                                                    alt="Edit" class="action__icon">
                                            </a>

                                            <!-- Modal -->
                                            <div class="kyc__modal modal fade action_modal"
                                                id="exampleModal{{ $label->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content site-table-modal">
                                                        <div class="modal-body popup-body">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                            <div class="kyc_container">
                                                                <div class="popup-body-text" id="kyc-action-data">
                                                                    <h3 class="title mb-3">
                                                                        User KYC Details
                                                                    </h3>

                                                                    <ul class="list-group mb-4">
                                                                        <li class="list-group-item">
                                                                            <p class="mb-0">Card Number:
                                                                                <strong>{{ $label->card_number }}</strong>
                                                                            </p>
                                                                        </li>
                                                                        <li class="list-group-item nid_img_container">
                                                                            <div class="nid_img">
                                                                                <p>
                                                                                    NID Front Side:
                                                                                </p>
                                                                                <img src="{{ asset('storage/' . $label->front_image) }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="nid_img">
                                                                                <p>
                                                                                    NID Back Side
                                                                                </p>
                                                                                <img src="{{ asset('storage/' . $label->back_image) }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <h3 class="title mb-3">
                                                                        Nominee KYC Details
                                                                    </h3>

                                                                    <ul class="list-group mb-4">
                                                                        <li class="list-group-item">
                                                                            <p class="mb-0">Card Number:
                                                                                <strong>{{ optional($label->user->nominee)->card_number }}</strong>
                                                                            </p>
                                                                        </li>
                                                                        <li class="list-group-item nid_img_container">
                                                                            <div class="nid_img">
                                                                                <p>
                                                                                    NID Front Side:
                                                                                </p>
                                                                                <img src="{{ asset('storage/' . optional($label->user->nominee)->front_image) }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="nid_img">
                                                                                <p>
                                                                                    NID Back Side
                                                                                </p>
                                                                                <img src="{{ asset('storage/' . optional($label->user->nominee)->back_image) }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <form action="{{ url('kyc/status-update') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        {{-- <div class="site-input-groups">
                                                                        <label for=""
                                                                            class="box-input-label">Details
                                                                            Message(Optional)</label>
                                                                        <textarea name="message" class="form-textarea mb-0" placeholder="Details Message"></textarea>
                                                                    </div> --}}
                                                                        <input type="hidden" value="{{ $label->id }}"
                                                                            name="kyc_id">
                                                                        <div class="user_bank_info">
                                                                            <h3 class="title mb-2">
                                                                                Nominee Bank Information
                                                                            </h3>
                                                                            <div class="input__group">
                                                                                <div class="site-input-groups ">
                                                                                    <label for=""
                                                                                        class="box-input-label">Account
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        value="{{ optional($label->user->bankInfo)->account_name }}">
                                                                                </div>
                                                                                <div class="site-input-groups">
                                                                                    <label for=""
                                                                                        class="box-input-label">Account
                                                                                        Number</label>
                                                                                    <input type="text"
                                                                                        value="{{ optional($label->user->bankInfo)->account_number }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input__group">
                                                                                <div class="site-input-groups">
                                                                                    <label for=""
                                                                                        class="box-input-label">Bank
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        value="{{ optional($label->user->bankInfo)->bank_name }}">
                                                                                </div>
                                                                                <div class="site-input-groups">
                                                                                    <label for=""
                                                                                        class="box-input-label">Branch
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        value="{{ optional($label->user->bankInfo)->branch_name }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="input__group">
                                                                                <div class="site-input-groups">
                                                                                    <label for=""
                                                                                        class="box-input-label">Routing
                                                                                        Number</label>
                                                                                    <input type="text"
                                                                                        value="{{ optional($label->user->bankInfo)->routing_number }}">
                                                                                </div>
                                                                                <div class="site-input-groups">
                                                                                    <label for=""
                                                                                        class="box-input-label">Branch
                                                                                        Location</label>
                                                                                    <input type="text"
                                                                                        value="{{ optional($label->user->bankInfo)->branch_location }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @if ($label->status == 'pending')
                                                                            <div class="action-btns">
                                                                                <button type="submit" name="action"
                                                                                    value="rejected"
                                                                                    class="btn centered red-btn me-2">
                                                                                    <i class="fa fa-close"></i>
                                                                                    Reject
                                                                                </button>
                                                                                <button type="submit" name="action"
                                                                                    value="approved"
                                                                                    class="btn primary-btn centered">
                                                                                    <i class="fas fa-check"></i>
                                                                                    Approve
                                                                                </button>
                                                                            </div>
                                                                            @endif
                                                                    </form>
                                                                </div>
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
