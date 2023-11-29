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
                                        Investments</a>
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
                                                <h3 class="title">Basic Info</h3>
                                            </div>
                                            <div class="site-card-body">
                                                <form action="https://hyiprio.tdevs.co/admin/user/2835" method="post">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Name:</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->name }}" name="name"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Email:</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->email }}" required=""
                                                                    name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Country:</label>
                                                                <input type="text" class="box-input"
                                                                    value="Bangladesh" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Phone:</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->phone }}" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Username:</label>
                                                                <input type="text" class="box-input" name="username"
                                                                    value="MahfuzAhmed8477" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Email:</label>
                                                                <input type="email" class="box-input"
                                                                    value="ba*********@gm******m" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Gender:</label>
                                                                <input type="text" class="box-input" value=""
                                                                    required="" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Date of
                                                                    Birth:</label>
                                                                <input type="text" class="box-input" value=""
                                                                    disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">City:</label>
                                                                <input type="text" name="city" class="box-input"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Zip
                                                                    Code:</label>
                                                                <input type="text" class="box-input" name="zip_code"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Address:</label>
                                                                <input type="text" class="box-input" name="address"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Joining
                                                                    Date:</label>
                                                                <input type="text" class="box-input"
                                                                    value="Sun, Nov 12, 2023 10:59 AM" required=""
                                                                    disabled="">
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
                                                <h4 class="title">Investments</h4>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-investment-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="dataTables_length"
                                                                    id="user-investment-dataTable_length">
                                                                    <label>Show <select
                                                                            name="user-investment-dataTable_length"
                                                                            aria-controls="user-investment-dataTable"
                                                                            class="form-select form-select-sm">
                                                                            <option value="10">10</option>
                                                                            <option value="25">25</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                        </select> entries</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <div id="user-investment-dataTable_filter"
                                                                    class="dataTables_filter">
                                                                    <label>Search:<input type="search"
                                                                            class="form-control form-control-sm"
                                                                            placeholder=""
                                                                            aria-controls="user-investment-dataTable"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table id="user-investment-dataTable"
                                                                    class="data-table dataTable no-footer"
                                                                    aria-describedby="user-investment-dataTable_info">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                                aria-controls="user-investment-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-sort="ascending"
                                                                                aria-label="Icon: activate to sort column descending">
                                                                                Icon</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-investment-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Schema: activate to sort column ascending">
                                                                                Schema</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-investment-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="ROI: activate to sort column ascending">
                                                                                ROI</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-investment-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Profit: activate to sort column ascending">
                                                                                Profit</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-investment-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Capital Back: activate to sort column ascending">
                                                                                Capital Back</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-investment-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Timeline: activate to sort column ascending">
                                                                                Timeline</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="odd">
                                                                            <td valign="top" colspan="6"
                                                                                class="dataTables_empty">No
                                                                                data
                                                                                available in table</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div id="user-investment-dataTable_processing"
                                                                    class="dataTables_processing card"
                                                                    style="display: none;">
                                                                    Processing...</div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-5">
                                                                <div class="dataTables_info"
                                                                    id="user-investment-dataTable_info" role="status"
                                                                    aria-live="polite">Showing 0
                                                                    to 0 of 0 entries</div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-7">
                                                                <div class="dataTables_paginate paging_simple_numbers"
                                                                    id="user-investment-dataTable_paginate">
                                                                    <ul class="pagination">
                                                                        <li class="paginate_button page-item previous disabled"
                                                                            id="user-investment-dataTable_previous">
                                                                            <a href="#"
                                                                                aria-controls="user-investment-dataTable"
                                                                                data-dt-idx="0" tabindex="0"
                                                                                class="page-link">Previous
                                                                            </a>
                                                                        </li>
                                                                        <li class="paginate_button page-item next disabled"
                                                                            id="user-investment-dataTable_next">
                                                                            <a href="#"
                                                                                aria-controls="user-investment-dataTable"
                                                                                data-dt-idx="1" tabindex="0"
                                                                                class="page-link">Next
                                                                            </a>
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
                            </div> <!-- earnings -->
                            <div class="tab-pane fade" id="pills-deposit" role="tabpanel"
                                aria-labelledby="pills-deposit-tab">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="site-card">
                                            <div class="site-card-header">
                                                <h4 class="title">Earnings</h4>
                                                <div class="card-header-info">Total Earnings 8 USD</div>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-profit-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="dataTables_length"
                                                                    id="user-profit-dataTable_length">
                                                                    <label>Show <select name="user-profit-dataTable_length"
                                                                            aria-controls="user-profit-dataTable"
                                                                            class="form-select form-select-sm">
                                                                            <option value="10">10</option>
                                                                            <option value="25">25</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                        </select> entries</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <div id="user-profit-dataTable_filter"
                                                                    class="dataTables_filter">
                                                                    <label>Search:<input type="search"
                                                                            class="form-control form-control-sm"
                                                                            placeholder=""
                                                                            aria-controls="user-profit-dataTable"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table id="user-profit-dataTable"
                                                                    class="data-table dataTable no-footer"
                                                                    aria-describedby="user-profit-dataTable_info">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                                aria-controls="user-profit-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-sort="ascending"
                                                                                aria-label="Date: activate to sort column descending">
                                                                                Date</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-profit-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Amount: activate to sort column ascending">
                                                                                Amount</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-profit-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Type: activate to sort column ascending">
                                                                                Type</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-profit-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Profit From: activate to sort column ascending">
                                                                                Profit From</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="user-profit-dataTable"
                                                                                rowspan="1" colspan="1"
                                                                                aria-label="Description: activate to sort column ascending">
                                                                                Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="odd">
                                                                            <td class="sorting_1">Nov 12 2023
                                                                                10:59</td>
                                                                            <td>
                                                                                <strong class="green-color">+8
                                                                                    USD</strong>
                                                                            </td>
                                                                            <td>
                                                                                <div class="site-badge primary-bg">
                                                                                    Signup Bonus
                                                                                </div>
                                                                            </td>
                                                                            <td>System</td>
                                                                            <td>Signup Bonus</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div id="user-profit-dataTable_processing"
                                                                    class="dataTables_processing card"
                                                                    style="display: none;">
                                                                    Processing...
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-5">
                                                                <div class="dataTables_info"
                                                                    id="user-profit-dataTable_info" role="status"
                                                                    aria-live="polite">Showing 1
                                                                    to 1 of 1 entries</div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-7">
                                                                <div class="dataTables_paginate paging_simple_numbers"
                                                                    id="user-profit-dataTable_paginate">
                                                                    <ul class="pagination">
                                                                        <li class="paginate_button page-item previous disabled"
                                                                            id="user-profit-dataTable_previous">
                                                                            <a href="#"
                                                                                aria-controls="user-profit-dataTable"
                                                                                data-dt-idx="0" tabindex="0"
                                                                                class="page-link">Previous</a>
                                                                        </li>
                                                                        <li class="paginate_button page-item active">
                                                                            <a href="#"
                                                                                aria-controls="user-profit-dataTable"
                                                                                data-dt-idx="1" tabindex="0"
                                                                                class="page-link">1</a>
                                                                        </li>
                                                                        <li class="paginate_button page-item next disabled"
                                                                            id="user-profit-dataTable_next"><a
                                                                                href="#"
                                                                                aria-controls="user-profit-dataTable"
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
@endsection
