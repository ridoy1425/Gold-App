@extends('ui.admin_panel.master')

@section('title', 'Dashboard')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">Dashboard</h4>
    <div id="flash_message"></div>
@endsection


@section('main_content')
    <div class="row  page-content">
        <!-- Main content -->
        <section class="content">
            <div class="dashboard_page">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="img_col">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="card_text">
                                <h3>Total Users</h3>
                                <p><span>{{ $data['users'] }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="img_col">
                                <i class="fa-solid fa-money-check-dollar"></i>
                            </div>
                            <div class="card_text">
                                <h3>Pending Payment Request</h3>
                                <p><span>{{ $data['paymentRequests'] }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="img_col">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <div class="card_text">
                                <h3>Order of this month</h3>
                                <p><span>{{ $data['orders'] }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="img_col">
                                <i class="fa-regular fa-money-bill-1"></i>
                            </div>
                            <div class="card_text">
                                <h3>Pending Collect Request</h3>
                                <p><span>{{ $data['collectRequest'] }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="img_col">
                                <i class="fa-solid fa-landmark"></i>
                            </div>
                            <div class="card_text">
                                <h3>Pending Withdraws</h3>
                                <p><span>{{ $data['withdraws'] }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="img_col">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            </div>
                            <div class="card_text">
                                <h3>Transfers In this month</h3>
                                <p><span>{{ $data['transfers'] }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <h4 class="mt-4">Transfer Data of This month</h4>
            <div class="card card-default edit__inner__container">
                <div class="card-body table-responsive">
                    <table class="table dataTable no-footer" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Sender Name</th>
                                <th scope="col">Sender ID</th>
                                <th scope="col">Recipient</th>
                                <th scope="col">Recipient ID</th>
                                <th scope="col">AMOUNT</th>
                                <th scope="col">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferData as $row)
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </section>
        <!-- /.content -->
        {{-- @include('employees.employee-search-modal') --}}
    </div>
@endsection

@section('script')
@endsection
