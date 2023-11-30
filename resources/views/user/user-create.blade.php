@extends('ui.admin_panel.master')

@section('title', 'User Details')

@section('style')
    <style>
        .display {
            display: none;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">User Details</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="edit__inner__container">
                <div class="row">
                    <div class="col-xxl-3 col-xl-6 col-lg-8 col-md-6 col-sm-12">
                        <div class="profile-card">
                            <div class="top">
                                <h5>Profile Picture</h5>
                                <div class="avatar">
                                    <span class="avatar-text"><img
                                            src="{{ asset('storage/' . optional($user->userDetails)->profile_image) }}"
                                            alt="profile"></span>
                                </div>
                                <div class="title-des">
                                    <h4>{{ $user->name }}</h4>
                                </div>
                                @if ($user->status == 'active')
                                    <button class="site-btn-sm primary-btn w-100 centered">
                                        Active
                                    </button>
                                @elseif($user->status == 'inactive')
                                    <button class="site-btn-sm danger-btn w-100 centered">
                                        Inactive
                                    </button>
                                @else
                                    <button class="site-btn-sm warning-btn w-100 centered">
                                        Pending
                                    </button>
                                @endif

                            </div>
                        </div>
                        <div class="profile-card">
                            <div class="top">
                                <h5>User Document </h5>
                                <div class="avatar">
                                    <span class="avatar-text"><img
                                            src="{{ asset('storage/' . optional($user->kyc)->front_image) }}"
                                            alt="profile"></span>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-text"><img
                                            src="{{ asset('storage/' . optional($user->kyc)->back_image) }}"
                                            alt="profile"></span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-card">
                            <div class="top">
                                <h5>Nominee Document</h5>
                                <div class="avatar">
                                    <span class="avatar-text"><img
                                            src="{{ asset('storage/' . optional($user->nominee)->front_image) }}"
                                            alt="profile"></span>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-text"><img
                                            src="{{ asset('storage/' . optional($user->nominee)->back_image) }}"
                                            alt="profile"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="site-tab-bars">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link active" id="pills-informations-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-informations" type="button"
                                        role="tab" aria-controls="pills-informations" aria-selected="true">
                                        <i class="fas fa-user"></i>
                                        Informations</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link" id="pills-transfer-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-transfer" type="button" role="tab"
                                        aria-controls="pills-transfer" aria-selected="true">
                                        <i class="fas fa-anchor"></i>
                                        Orders</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link" id="pills-deposit-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-deposit" type="button" role="tab"
                                        aria-controls="pills-deposit" aria-selected="true">
                                        <i class="fas fa-money-check"></i>
                                        Earnings</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link" id="pills-transactions-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-transactions" type="button" role="tab"
                                        aria-controls="pills-transactions" aria-selected="true">
                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                        Transactions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <!-- basic Info -->
                            <div class="tab-pane fade show active" id="pills-informations" role="tabpanel"
                                aria-labelledby="pills-informations-tab">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h3 class="title">Basic Information</h3>
                                            </div>
                                            <div class="site-card-body">
                                                <form action="https://hyiprio.tdevs.co/admin/user/2835" method="post">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Name</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->name }}" name="name"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Email</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->email }}" required=""
                                                                    name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Phone
                                                                    Number</label>
                                                                <input type="text" class="box-input"
                                                                    value="Bangladesh" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button type="submit"
                                                                class="site-btn-sm primary-btn w-100 centered">
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h3 class="title">User Details</h3>
                                            </div>
                                            <div class="site-card-body">
                                                <form action="https://hyiprio.tdevs.co/admin/user/2835" method="post">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Gender</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->name }}" name="name"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Date Of
                                                                    Birth</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->email }}" required=""
                                                                    name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Occupation</label>
                                                                <input type="text" class="box-input"
                                                                    value="Bangladesh" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Marital
                                                                    Status</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->phone }}" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">KYC
                                                                    Type</label>
                                                                <input type="text" class="box-input" name="username"
                                                                    value="MahfuzAhmed8477" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Card
                                                                    Number</label>
                                                                <input type="email" class="box-input"
                                                                    value="ba*********@gm******m" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button type="submit"
                                                                class="site-btn-sm primary-btn w-100 centered">
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h3 class="title">Nominee Information</h3>
                                            </div>
                                            <div class="site-card-body">
                                                <form action="https://hyiprio.tdevs.co/admin/user/2835" method="post">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Nominee
                                                                    Name</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->name }}" name="name"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Phone
                                                                    Number</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->email }}" required=""
                                                                    name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Date of
                                                                    Birth</label>
                                                                <input type="text" class="box-input"
                                                                    value="Bangladesh" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Relation
                                                                    with User</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->phone }}" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">KYC
                                                                    Type</label>
                                                                <input type="text" class="box-input" name="username"
                                                                    value="MahfuzAhmed8477" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Card
                                                                    Number</label>
                                                                <input type="email" class="box-input"
                                                                    value="ba*********@gm******m" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button type="submit"
                                                                class="site-btn-sm primary-btn w-100 centered">
                                                                Save Changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h3 class="title">Change Password</h3>
                                            </div>
                                            <div class="site-card-body">
                                                <form action="https://hyiprio.tdevs.co/admin/user/password-update/2835"
                                                    method="post">
                                                    <input type="hidden" name="_token"
                                                        value="HoURYRw8yjEK5pUXqBZJAtFAQIXvUlfeZZJUytt4">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">New
                                                                    Password:</label>
                                                                <input type="password" name="new_password"
                                                                    class="box-input" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Confirm
                                                                    Password:</label>
                                                                <input type="password" name="new_confirm_password"
                                                                    class="box-input" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <button type="submit"
                                                                class="site-btn-sm primary-btn w-100 centered">Change
                                                                Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- investments -->
                            <div class="tab-pane fade" id="pills-transfer" role="tabpanel"
                                aria-labelledby="pills-transfer-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h4 class="title">Orders</h4>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-investment-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12">
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

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- earnings -->
                            <div class="tab-pane fade" id="pills-deposit" role="tabpanel"
                                aria-labelledby="pills-deposit-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h4 class="title">Transaction</h4>
                                                <div class="card-header-info">Total Earnings 8 USD</div>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-profit-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12">
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
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- transaction -->
                            <div class="tab-pane fade" id="pills-transactions" role="tabpanel"
                                aria-labelledby="pills-transactions-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h4 class="title">Transactions</h4>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-transaction-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="dataTables_length"
                                                                    id="user-transaction-dataTable_length">
                                                                    <label>Show <select
                                                                            name="user-transaction-dataTable_length"
                                                                            aria-controls="user-transaction-dataTable"
                                                                            class="form-select form-select-sm">
                                                                            <option value="10">10</option>
                                                                            <option value="25">25</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                        </select> entries</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <div id="user-transaction-dataTable_filter"
                                                                    class="dataTables_filter">
                                                                    <label>Search:<input type="search"
                                                                            class="form-control form-control-sm"
                                                                            placeholder=""
                                                                            aria-controls="user-transaction-dataTable"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table id="user-transaction-dataTable"
                                                                    class="data-table dataTable no-footer"
                                                                    aria-describedby="user-transaction-dataTable_info">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-sort="ascending"
                                                                                aria-label="Date: activate to sort column descending">
                                                                                Date</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Transaction ID: activate to sort column ascending">
                                                                                Transaction ID</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Type: activate to sort column ascending">
                                                                                Type</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Amount: activate to sort column ascending">
                                                                                Amount</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Gateway: activate to sort column ascending">
                                                                                Gateway</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Status: activate to sort column ascending">
                                                                                Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="odd">
                                                                            <td class="sorting_1">Nov 12 2023
                                                                                10:59</td>
                                                                            <td>TRXWW8HNNGU26</td>
                                                                            <td>
                                                                                <div class="site-badge primary-bg">
                                                                                    Signup Bonus</div>
                                                                            </td>
                                                                            <td><strong class="green-color">+8
                                                                                    USD</strong>
                                                                            </td>
                                                                            <td>System</td>
                                                                            <td>
                                                                                <div class="site-badge success">
                                                                                    Success</div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div id="user-transaction-dataTable_processing"
                                                                    class="dataTables_processing card"
                                                                    style="display: none;">
                                                                    Processing...</div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-5">
                                                                <div class="dataTables_info"
                                                                    id="user-transaction-dataTable_info" role="status"
                                                                    aria-live="polite">Showing 1
                                                                    to 1 of 1 entries</div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-7">
                                                                <div class="dataTables_paginate paging_simple_numbers"
                                                                    id="user-transaction-dataTable_paginate">
                                                                    <ul class="pagination">
                                                                        <li class="paginate_button page-item previous disabled"
                                                                            id="user-transaction-dataTable_previous">
                                                                            <a href="#"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                data-dt-idx="0" tabindex="0"
                                                                                class="page-link">Previous</a>
                                                                        </li>
                                                                        <li class="paginate_button page-item active">
                                                                            <a href="#"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                data-dt-idx="1" tabindex="0"
                                                                                class="page-link">1</a>
                                                                        </li>
                                                                        <li class="paginate_button page-item next disabled"
                                                                            id="user-transaction-dataTable_next">
                                                                            <a href="#"
                                                                                aria-controls="user-transaction-dataTable"
                                                                                data-dt-idx="2" tabindex="0"
                                                                                class="page-link">Next</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- card-body end --}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                rowHeight: 20,
            });
        });
    </script>
@endsection
