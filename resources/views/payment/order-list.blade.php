@extends('ui.admin_panel.master')

@section('title', 'Order List')

@section('style')

@endsection

@section('content_title')
<h4 class="mt-2">Order List</h4>
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
                    @foreach ($orders as $row)
                    <tr>
                        <td>{{ date('d-M, Y', strtotime($row->created_at)) }}</td>
                        <td>{{ $row->order_id }}</td>
                        <td>{{ optional($row->user)->name }}</td>
                        <td>{{ $row->gold_qty }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->profit_amount }}</td>
                        <td>{{ date('d-M-y', strtotime($row->delivery_date)) }}</td>
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
                        <td><span class="rejected">Canceled</span>
                        </td>
                        @else
                        <td><span class="pending">Pending</span>
                        </td>
                        @endif
                        <td>
                            <div class="action_td">
                                <!-- <a href="{{ URL('kyc/edit', $row->id) }}"> -->
                                <a href="" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}" alt="Edit"
                                        class="action__icon">
                                </a>
                                <a href="button" data-bs-toggle="modal" data-bs-target="#edit_iconModal">
                                    <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}" alt="Edit"
                                        class="action__icon">
                                </a>
                                <a href="" onclick="return confirm('Are you sure?')">
                                    <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}" alt="Delete"
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
                                                            Profit List
                                                        </h3>
                                                        <form action="" method="post">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Profit Date</th>
                                                                        <th scope="col">Amount</th>
                                                                        <th scope="col">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($row->orderProfit as $profit)
                                                                    <tr>
                                                                        <td>{{ date('d-M-y', strtotime($profit->date)) }}
                                                                        </td>
                                                                        <td>{{ $row->profit_amount }}
                                                                        </td>
                                                                        <td>{{ $profit->status }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment__modal kyc__modal modal fade action_modal" id="edit_iconModal"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content site-table-modal">
                                            <div class="modal-body popup-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="mt-4">
                                                    <label for="">Status changes</label>
                                                <select class="form-select-md form-select box-input"
                                                                    id="marital_status_id" name="marital_status_id"
                                                                    required>
                                                    <option value="">sdfsdf</option>
                                                    <option value="">sdfsdf</option>
                                                    <option value="">sdfsdf</option>
                                                    <option value="">sdfsdf</option>
                                                    <option value="">sdfsdf</option>
                                                </select>
                                                </div>
                                                <button type="submit" class="site-btn-sm mt-3 primary-btn w-100">Send Message
                                            </button>
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