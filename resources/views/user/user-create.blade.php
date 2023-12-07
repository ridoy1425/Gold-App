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
                                @if ($user->status = 'active')
                                    <button class="site-btn-sm active_btn text-white w-100 centered">
                                        Active
                                    </button>
                                @elseif($user->status = 'inactive')
                                    <button class="site-btn-sm inactive_btn text-white w-100 centered">
                                        Inactive
                                    </button>
                                @elseif($user->status = 'pending')
                                    <button class="site-btn-sm pending_btn text-white w-100 centered">
                                        Pending
                                    </button>
                                @endif

                            </div>
                        </div>
                        <div class="profile-card user_nominee_document">
                            <div class="top">
                                <h5>User Document </h5>
                                <div class="avatar">
                                    <img src="{{ asset('storage/' . optional($user->kyc)->front_image) }}" alt="document">
                                </div>
                                <div class="avatar">
                                    <img src="{{ asset('storage/' . optional($user->kyc)->back_image) }}" alt="document">
                                </div>
                            </div>
                        </div>
                        <div class="profile-card user_nominee_document">
                            <div class="top">
                                <h5>Nominee Document</h5>
                                <div class="avatar">
                                    <img src="{{ asset('storage/' . optional($user->nominee)->front_image) }}"
                                        alt="document">
                                </div>
                                <div class="avatar">
                                    <img src="{{ asset('storage/' . optional($user->nominee)->back_image) }}"
                                        alt="document">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="site-tab-bars d-flex justify-content-between">
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
                                        Payments</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link" id="pills-transactions-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-transactions" type="button" role="tab"
                                        aria-controls="pills-transactions" aria-selected="true">
                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                        Transfers</a>
                                </li>
                            </ul>
                            <div class="btn__small text-end">
                                <a href="{{ route('user-list') }}" class="card-header-link primary-btn back_btn btn">Back
                                </a>
                            </div>
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
                                                <form action="{{ url('user/update', $user->id) }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Name</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->name ?? '' }}" name="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Email</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->email ?? '' }}" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Phone
                                                                    Number</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->phone ?? '' }}" name="phone">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">User
                                                                    Role</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->role->name ?? '' }}" name="role_id">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Master
                                                                    ID</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->master_id ?? '' }}"
                                                                    name="master_id">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Status</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->master_id ?? '' }}" name="status">
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
                                                <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Gender</label>
                                                                <input type="hidden"
                                                                    value="{{ $user->userDetails->gender_id ?? '' }}"
                                                                    name="gender_id">
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->userDetails->gender->value ?? '' }}"
                                                                    name="gender" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Date Of
                                                                    Birth</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->userDetails->dob ?? '' }}"
                                                                    required="" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for=""
                                                                    class="box-input-label">Occupation</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->userDetails->occupation ?? '' }}"
                                                                    disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Marital
                                                                    Status</label>
                                                                <input type="hidden"
                                                                    value="{{ $user->userDetails->marital_status_id ?? '' }}"
                                                                    name="marital_status_id">
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->userDetails->maritalStatus->value ?? '' }}"
                                                                    disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">KYC
                                                                    Type</label>
                                                                <input type="text" class="box-input" name="username"
                                                                    value="{{ $user->kyc->kycType->value ?? '' }}"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Card
                                                                    Number</label>
                                                                <input type="email" class="box-input"
                                                                    value="{{ $user->kyc->card_number ?? '' }}"
                                                                    required="">
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
                                                <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Nominee
                                                                    Name</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->nominee->name ?? '' }}"
                                                                    name="name" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Phone
                                                                    Number</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->nominee->phone ?? '' }}"
                                                                    required="" name="phone">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Date of
                                                                    Birth</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->nominee->dob ?? '' }}"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Relation
                                                                    with User</label>
                                                                <input type="text" class="box-input"
                                                                    value="{{ $user->nominee->relation->value ?? '' }}"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">KYC
                                                                    Type</label>
                                                                <input type="text" class="box-input" name="username"
                                                                    value="{{ $user->nominee->kycType->value ?? '' }}"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Card
                                                                    Number</label>
                                                                <input type="text" class="box-input"
                                                                    name="card_number"
                                                                    value="{{ $user->nominee->card_number ?? '' }}"
                                                                    required="">
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
                                                <form action="{{ url('user/password-change', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="new_password" class="box-input-label">New
                                                                    Password:</label>
                                                                <input type="password" name="password" class="box-input"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                            <div class="site-input-groups">
                                                                <label for="" class="box-input-label">Confirm
                                                                    Password:</label>
                                                                <input type="password" name="password_confirmation"
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
                                                                <table class="table table_id" id="table_id">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Order Date</th>
                                                                            <th scope="col">Order ID</th>
                                                                            <th scope="col">GOLD QTY</th>
                                                                            <th scope="col">PRICE</th>
                                                                            <th scope="col">PROFIT</th>
                                                                            <th scope="col">DELIVERY TIME</th>
                                                                            <th scope="col">STATUS</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($user->orders as $row)
                                                                            <tr>
                                                                                <td>{{ date('d-M, Y', strtotime($row->created_at)) }}
                                                                                </td>
                                                                                <td>{{ $row->order_id }}</td>
                                                                                <td>{{ $row->gold_qty }}</td>
                                                                                <td>{{ $row->price }}</td>
                                                                                <td>{{ $row->profit_amount }}</td>
                                                                                <td>{{ date('d-M-y', strtotime($row->delivery_date)) }}
                                                                                </td>
                                                                                @if ($row->status == 'active')
                                                                                    <td><span class="success">Active</span>
                                                                                    </td>
                                                                                @elseif ($row->status == 'in-process')
                                                                                    <td><span class="in_process">In
                                                                                            Process</span></td>
                                                                                @elseif ($row->status == 'completed')
                                                                                    <td><span
                                                                                            class="completed">Completed</span>
                                                                                    </td>
                                                                                @elseif ($row->status == 'rejected')
                                                                                    <td><span
                                                                                            class="rejected">Canceled</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td><span
                                                                                            class="pending">Pending</span>
                                                                                    </td>
                                                                                @endif
                                                                                <td>
                                                                                    <div class="action_td">
                                                                                        <!-- <a href="{{ URL('kyc/edit', $row->id) }}"> -->
                                                                                        <a href="" type="button"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#exampleModal">
                                                                                            <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}"
                                                                                                alt="Edit"
                                                                                                class="action__icon">
                                                                                        </a>
                                                                                        <!-- Modal -->
                                                                                        <div class="payment__modal kyc__modal modal fade action_modal"
                                                                                            id="exampleModal"
                                                                                            tabindex="-1"
                                                                                            aria-labelledby="exampleModalLabel"
                                                                                            aria-hidden="true">
                                                                                            <div
                                                                                                class="modal-dialog modal-dialog-centered">
                                                                                                <div
                                                                                                    class="modal-content site-table-modal">
                                                                                                    <div
                                                                                                        class="modal-body popup-body">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-close"
                                                                                                            data-bs-dismiss="modal"
                                                                                                            aria-label="Close"></button>
                                                                                                        <div
                                                                                                            class="kyc_container">
                                                                                                            <div class="popup-body-text"
                                                                                                                id="kyc-action-data">
                                                                                                                <h3
                                                                                                                    class="title mb-3">
                                                                                                                    Profit
                                                                                                                    List
                                                                                                                </h3>
                                                                                                                <form
                                                                                                                    action=""
                                                                                                                    method="post">
                                                                                                                    <table
                                                                                                                        class="table">
                                                                                                                        <thead>
                                                                                                                            <tr>
                                                                                                                                <th
                                                                                                                                    scope="col">
                                                                                                                                    Profit
                                                                                                                                    Date
                                                                                                                                </th>
                                                                                                                                <th
                                                                                                                                    scope="col">
                                                                                                                                    Amount
                                                                                                                                </th>
                                                                                                                                <th
                                                                                                                                    scope="col">
                                                                                                                                    Status
                                                                                                                                </th>
                                                                                                                            </tr>
                                                                                                                        </thead>
                                                                                                                        <tbody>
                                                                                                                            @foreach ($row->orderProfit as $profit)
                                                                                                                                <tr>
                                                                                                                                    <td>{{ date('d-M-y', strtotime($profit->date)) }}
                                                                                                                                    </td>
                                                                                                                                    <td>{{ $row->profit_amount }}
                                                                                                                                    </td>
                                                                                                                                    <td>{{ $profit->status }}
                                                                                                                                    </td>
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
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
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
                                                <h4 class="title">Payments</h4>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-profit-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table class="table table_id" id="table_id">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Date</th>
                                                                            <th scope="col">REQUEST AMOUNT</th>
                                                                            <th scope="col">STATUS</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($user->payments as $row)
                                                                            <tr>
                                                                                <td>{{ date('d-M, Y', strtotime($row->created_at)) }}
                                                                                </td>
                                                                                <td>{{ $row->payment_amount }}</td>
                                                                                @if ($row->status == 'approved')
                                                                                    <td><span
                                                                                            class="success">Approved</span>
                                                                                    </td>
                                                                                @elseif ($row->status == 'in-process')
                                                                                    <td><span class="in_process">In
                                                                                            Process</span></td>
                                                                                @elseif ($row->status == 'completed')
                                                                                    <td><span
                                                                                            class="completed">Completed</span>
                                                                                    </td>
                                                                                @elseif ($row->status == 'rejected')
                                                                                    <td><span
                                                                                            class="rejected">Canceled</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td><span
                                                                                            class="pending">Pending</span>
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
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
                                                <h4 class="title">Transfers</h4>
                                            </div>
                                            <div class="site-card-body table-responsive">
                                                <div class="site-datatable">
                                                    <div id="user-profit-dataTable_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table class="table table_id" id="table_id">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Date</th>
                                                                            <th scope="col">Recipient</th>
                                                                            <th scope="col">Recipient ID</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            <th scope="col">STATUS</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($user->transfers as $row)
                                                                            <tr>
                                                                                <td>{{ date('d-M, Y', strtotime($row->created_at)) }}
                                                                                </td>
                                                                                <td>{{ $row->receiver->name }}</td>
                                                                                <td>{{ $row->receiver->master_id }}</td>
                                                                                <td>{{ $row->amount }}</td>
                                                                                @if ($row->status == 'success')
                                                                                    <td><span
                                                                                            class="success">Success</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td><span
                                                                                            class="rejected">Failed</span>
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
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
            $('.table_id').DataTable({
                rowHeight: 20,
            });
        });
    </script>
@endsection
