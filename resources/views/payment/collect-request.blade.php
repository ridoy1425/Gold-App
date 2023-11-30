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
                        <td>{{ date('d M Y', strtotime($row->created_at)) }}</td>
                        <td>{{ $row->order_id }}</td>
                        <td>{{ optional($row->user)->name }}</td>
                        <td>{{ $row->collect_type }}</td>
                        <td>{{ $row->amount }}</td>
                        <td>{{ $row->gold }}</td>
                        <td>{{ $row->method }}</td>
                        @if ($row->status == 'active')
                        <td><span class="pending">pending</span></td>
                        @else
                        <td><span class="success">Complete</span></td>
                        @endif
                        <td>
                            <div class="action_td">
                                <!-- <a href="{{ URL('kyc/edit', $row->id) }}"> -->
                                <a href="" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
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