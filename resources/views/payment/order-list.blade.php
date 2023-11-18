@extends('ui.admin_panel.master')

@section('title', 'Deposit List')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Deposit List</h4>
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
            <div class="card card-default edit__inner__container">
                {{-- <div class=" ml-auto mb-2 mt-2 mr-3">
                <a class="btn btn-warning" href="{{ url('designation/label/create') }}">Add New Label</a>
            </div> --}}
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">CUSTOMER</th>
                                <th scope="col">GOLD QTY</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">PROFIT</th>
                                <th scope="col">DELIVERY TIME</th>
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
                                    @if ($row->status == 'pending')
                                        <td><span class="pending">Pending</span></td>
                                    @else
                                        <td><span class="success">Success</span></td>
                                    @endif
                                    <td class="action_td">
                                        <!-- <a href="{{ URL('kyc/edit', $row->id) }}"> -->
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}" alt="Edit"
                                                class="action__icon">
                                        </a>
                                        <!-- Modal -->
                                        <div class="payment__modal kyc__modal modal fade action_modal" id="exampleModal"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    Amount: $ <span>10</span>
                                                                </p>
                                                                <div class="nid_img mb-4">
                                                                    <p>
                                                                        Payment Receipt (Screenshot)
                                                                    </p>
                                                                    <img src="https://www.printablecashreceipts.com/samples-free/Payment_Receipt-free.png"
                                                                        alt="">
                                                                </div>
                                                                <form action="" method="post">
                                                                    <div class="user_bank_info">
                                                                        <div class="site-input-groups ">
                                                                            <label for="" class="box-input-label">
                                                                                Add to Wallet
                                                                            </label>
                                                                            <input type="number" placeholder="$ 10">
                                                                        </div>
                                                                    </div>
                                                                    <div class="action-btns">
                                                                        <button type="submit"
                                                                            class="btn primary-btn centered me-2">
                                                                            <i class="fas fa-check"></i>
                                                                            Approve
                                                                        </button>
                                                                        <button type="submit" class="btn centered red-btn">
                                                                            <i class="fa fa-close"></i>
                                                                            Reject
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
