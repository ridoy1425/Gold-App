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
            {{-- message alert --}}
            <div class="alert_message mt-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success" role="success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="success">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>

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
                                    <td class="action_td">
                                        <!-- <a href="{{ URL('kyc/edit', $label->id) }}"> -->
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}" alt="Edit"
                                                class="action__icon">
                                        </a>

                                        <!-- Modal -->
                                        <div class="kyc__modal modal fade action_modal" id="exampleModal" tabindex="-1"
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
                                                                            <img src="https://images.pexels.com/photos/3693901/pexels-photo-3693901.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="nid_img">
                                                                            <p>
                                                                                NID Back Side
                                                                            </p>
                                                                            <img src="data:image/jpeg;base64,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"
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
                                                                                <input type="text">
                                                                            </div>
                                                                            <div class="site-input-groups">
                                                                                <label for=""
                                                                                    class="box-input-label">Account
                                                                                    Number</label>
                                                                                <input type="text">
                                                                            </div>
                                                                        </div>
                                                                        <div class="input__group">
                                                                            <div class="site-input-groups">
                                                                                <label for=""
                                                                                    class="box-input-label">Bank
                                                                                    Name</label>
                                                                                <input type="text" value="">
                                                                            </div>
                                                                            <div class="site-input-groups">
                                                                                <label for=""
                                                                                    class="box-input-label">Branch
                                                                                    Name</label>
                                                                                <input type="text" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="input__group">
                                                                            <div class="site-input-groups">
                                                                                <label for=""
                                                                                    class="box-input-label">Routing
                                                                                    Number</label>
                                                                                <input type="text">
                                                                            </div>
                                                                            <div class="site-input-groups">
                                                                                <label for=""
                                                                                    class="box-input-label">Branch
                                                                                    Location</label>
                                                                                <input type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
