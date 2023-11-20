@extends('ui.admin_panel.master')

@section('title', 'Payment List')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Payment List</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card card-default edit__inner__container">
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">USER NAME</th>
                                <th scope="col">REQUEST AMOUNT</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($row->user)->name }}</td>
                                    <td>{{ $row->payment_amount }}</td>
                                    @if ($row->status == 'rejected')
                                        <td><span class="rejected">Rejected</span></td>
                                    @elseif ($row->status == 'approved')
                                        <td><span class="success">Success</span></td>
                                    @else
                                        <td><span class="pending">Pending</span></td>
                                    @endif
                                    <td class="action_td">
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $row->id }}">
                                            <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}" alt="Edit"
                                                class="action__icon">
                                        </a>
                                        <!-- Modal -->
                                        <div class="payment__modal kyc__modal modal fade action_modal"
                                            id="exampleModal{{ $row->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content site-table-modal">
                                                    <div class="modal-body popup-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="kyc_container">
                                                            <div class="popup-body-text" id="kyc-action-data">
                                                                <h3 class="title mb-3">
                                                                    Payment Details
                                                                </h3>
                                                                <p>
                                                                    Amount: <strong>$
                                                                        <span>{{ $row->payment_amount }}</span> </strong>
                                                                </p>
                                                                <div class="nid_img mb-4">
                                                                    <p>
                                                                        Payment Receipt (Screenshot)
                                                                    </p>
                                                                    <img src="{{ asset('storage/' . $row->receipt_image) }}"
                                                                        alt="">
                                                                </div>
                                                                @if ($row->status != 'approved')
                                                                    <form action="{{ url('payment/add-wallet') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $row->id }}"
                                                                            name="id">
                                                                        <div class="user_bank_info">
                                                                            <div class="site-input-groups ">
                                                                                <label for=""
                                                                                    class="box-input-label">
                                                                                    Add to Wallet
                                                                                </label>
                                                                                <input type="number" name="add_amount"
                                                                                    value="{{ $row->payment_amount }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="action-btns">
                                                                            <button type="submit" name="action"
                                                                                value="approved"
                                                                                class="btn primary-btn centered me-2">
                                                                                <i class="fas fa-check"></i>
                                                                                Approve
                                                                            </button>
                                                                            <button type="submit" name="action"
                                                                                value="rejected"
                                                                                class="btn centered red-btn">
                                                                                <i class="fa fa-close"></i>
                                                                                Reject
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                @endif
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
