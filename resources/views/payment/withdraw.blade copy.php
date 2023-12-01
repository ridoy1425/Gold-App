@extends('ui.admin_panel.master')

@section('title', 'Message')

@section('style')

@endsection

@section('content_title')
<h4 class="mt-2">Inbox</h4>
@endsection

@section('main_content')
<div class="row page-content">
    <div class="container">
        {{-- card-body start --}}
        <div class="edit__inner__container">
            <div class="site-tab-bars">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link active" id="pills-informations-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-informations" type="button" role="tab"
                            aria-controls="pills-informations" aria-selected="true">
                            <i class="fas fa-user"></i>
                            Pending Withdraws </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link" id="pills-transfer-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-transfer" type="button" role="tab" aria-controls="pills-transfer"
                            aria-selected="true">
                            <i class="fas fa-anchor"></i>
                            Automatic Method</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link" id="pills-deposit-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-deposit" type="button" role="tab" aria-controls="pills-deposit"
                            aria-selected="true">
                            <i class="fas fa-money-check"></i>
                            Manual Method</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link" id="pills-transactions-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-transactions" type="button" role="tab"
                            aria-controls="pills-transactions" aria-selected="true">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Withdraw Schedule</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link" id="pills-withdraw-history-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-withdraw-history" type="button" role="tab"
                            aria-controls="pills-withdraw-history" aria-selected="true">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Withdraw Schedule
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <!-- basic Info -->
                <div class="tab-pane fade show active" id="pills-informations" role="tabpanel"
                    aria-labelledby="pills-informations-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h4 class="title">Pending Withdraws</h4>
                                </div>
                                <div class="site-card-body table-responsive">
                                    <div class="site-datatable">
                                        <div id="" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table" id="table_id">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">User</th>
                                                                <th scope="col">Transaction ID</th>
                                                                <th scope="col">Amount</th>
                                                                <th scope="col">Charge</th>
                                                                <th scope="col">Gateway</th>
                                                                <th scope="col">Status</th>
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
                </div>
                <!-- investments -->
                <div class="tab-pane fade" id="pills-transfer" role="tabpanel" aria-labelledby="pills-transfer-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h3 class="title">Withdraw Methods</h3>
                                </div>
                                <div class="site-card-body">
                                    <p class="paragraph">
                                        All the <strong>Withdraw Methods</strong> setup for user
                                    </p>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/paypal.png') }}" alt="">
                                                <span class="icon-currency-type">USD</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Paypal</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/Coinbase.png') }}" alt="">
                                                <span class="icon-currency-type">USD</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Coinbase</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/coinremitter.png') }}"
                                                    alt="">
                                                <span class="icon-currency-type">BTC</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Coinremitter</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/cryptomus.png') }}" alt="">
                                                <span class="icon-currency-type">USDT</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Crytomus</h4>
                                                <p>Minimum Withdraw:100 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/perfectmoney.png') }}"
                                                    alt="">
                                                <span class="icon-currency-type">USD</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Perfect Money USD</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/flutterwave.png') }}"
                                                    alt="">
                                                <span class="icon-currency-type">USD</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Flutterwave USD</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/paypal.png') }}" alt="">
                                                <span class="icon-currency-type">USDT</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Binance USDT</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/cashmaal.png') }}" alt="">
                                                <span class="icon-currency-type">USD</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Cashmaal</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/blockio.png') }}" alt="">
                                                <span class="icon-currency-type">BTC</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Block.io BTC</h4>
                                                <p>Minimum Withdraw:50 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href="1"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- earnings -->
                <div class="tab-pane fade" id="pills-deposit" role="tabpanel" aria-labelledby="pills-deposit-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h3 class="title">Withdraw Methods</h3>
                                </div>
                                <div class="site-card-body">
                                    <p class="paragraph">
                                        All the <strong>Withdraw Methods</strong> setup for user
                                    </p>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/dm1.png') }}" alt="">
                                                <span class="icon-currency-type">USDT</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Tether USDT (TRC20)</h4>
                                                <p>Minimum Withdraw:100 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="single-gateway">
                                        <div class="gateway-name">
                                            <div class="gateway-icon">
                                                <img src="{{ asset('ui/admin_assets/dist/img/dm2.png') }}" alt="">
                                                <span class="icon-currency-type">USD</span>
                                            </div>
                                            <div class="gateway-title">
                                                <h4>Bank Transfer</h4>
                                                <p>Minimum Withdraw:150 USD</p>
                                            </div>
                                        </div>
                                        <div class="gateway-right">
                                            <div class="gateway-status">
                                                <div class="site-badge success">Activated</div>
                                            </div>
                                            <div class="gateway-edit">
                                                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" data-lucide="settings-2"
                                                        icon-name="settings-2" class="lucide lucide-settings-2">
                                                        <path d="M20 7h-9"></path>
                                                        <path d="M14 17H5"></path>
                                                        <circle cx="17" cy="17" r="3"></circle>
                                                        <circle cx="7" cy="7" r="3"></circle>
                                                    </svg></a>
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
                        <div class="col-xl-7 col-md-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h3 class="title">Withdraw Schedule</h3>
                                </div>
                                <div class="site-card-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="_token"
                                            value="zoTfekejQneqUt2vWhOIr9FtC4xFEWBCgqhBEVOX">
                                        <div class="site-input-groups row">
                                            <div class="col-sm-4 col-label pt-0">Sunday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-1" name="Sunday" value="1"
                                                            checked="">
                                                        <label for="active-1">Enable</label>
                                                        <input type="radio" id="disable-1" name="Sunday" value="0">
                                                        <label for="disable-1">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Monday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-2" name="Monday" value="1"
                                                            checked="">
                                                        <label for="active-2">Enable</label>
                                                        <input type="radio" id="disable-2" name="Monday" value="0">
                                                        <label for="disable-2">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Tuesday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-3" name="Tuesday" value="1"
                                                            checked="">
                                                        <label for="active-3">Enable</label>
                                                        <input type="radio" id="disable-3" name="Tuesday" value="0">
                                                        <label for="disable-3">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Wednesday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-4" name="Wednesday" value="1"
                                                            checked="">
                                                        <label for="active-4">Enable</label>
                                                        <input type="radio" id="disable-4" name="Wednesday" value="0">
                                                        <label for="disable-4">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Thursday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-5" name="Thursday" value="1"
                                                            checked="">
                                                        <label for="active-5">Enable</label>
                                                        <input type="radio" id="disable-5" name="Thursday" value="0">
                                                        <label for="disable-5">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Friday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-6" name="Friday" value="1"
                                                            checked="">
                                                        <label for="active-6">Enable</label>
                                                        <input type="radio" id="disable-6" name="Friday" value="0">
                                                        <label for="disable-6">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Saturday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-7" name="Saturday" value="1"
                                                            checked="">
                                                        <label for="active-7">Enable</label>
                                                        <input type="radio" id="disable-7" name="Saturday" value="0">
                                                        <label for="disable-7">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="submit" class="site-btn-sm primary-btn w-100">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-withdraw-history" role="tabpanel"
                    aria-labelledby="pills-withdraw-history-tab">
                    <div class="row">
                        <div class="col-xl-7 col-md-12">
                            <div class="site-card">
                                <div class="site-card-header">
                                    <h3 class="title">Withdraw Schedule</h3>
                                </div>
                                <div class="site-card-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="_token"
                                            value="zoTfekejQneqUt2vWhOIr9FtC4xFEWBCgqhBEVOX">
                                        <div class="site-input-groups row">
                                            <div class="col-sm-4 col-label pt-0">Sunday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-1" name="Sunday" value="1"
                                                            checked="">
                                                        <label for="active-1">Enable</label>
                                                        <input type="radio" id="disable-1" name="Sunday" value="0">
                                                        <label for="disable-1">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Monday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-2" name="Monday" value="1"
                                                            checked="">
                                                        <label for="active-2">Enable</label>
                                                        <input type="radio" id="disable-2" name="Monday" value="0">
                                                        <label for="disable-2">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Tuesday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-3" name="Tuesday" value="1"
                                                            checked="">
                                                        <label for="active-3">Enable</label>
                                                        <input type="radio" id="disable-3" name="Tuesday" value="0">
                                                        <label for="disable-3">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Wednesday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-4" name="Wednesday" value="1"
                                                            checked="">
                                                        <label for="active-4">Enable</label>
                                                        <input type="radio" id="disable-4" name="Wednesday" value="0">
                                                        <label for="disable-4">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Thursday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-5" name="Thursday" value="1"
                                                            checked="">
                                                        <label for="active-5">Enable</label>
                                                        <input type="radio" id="disable-5" name="Thursday" value="0">
                                                        <label for="disable-5">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Friday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-6" name="Friday" value="1"
                                                            checked="">
                                                        <label for="active-6">Enable</label>
                                                        <input type="radio" id="disable-6" name="Friday" value="0">
                                                        <label for="disable-6">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-label pt-0">Saturday</div>
                                            <div class="col-sm-8">
                                                <div class="form-switch ps-0">
                                                    <div class="switch-field">
                                                        <input type="radio" id="active-7" name="Saturday" value="1"
                                                            checked="">
                                                        <label for="active-7">Enable</label>
                                                        <input type="radio" id="disable-7" name="Saturday" value="0">
                                                        <label for="disable-7">Disabled</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="submit" class="site-btn-sm primary-btn w-100">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
    $('#table_id').DataTable({
        rowHeight: 20,
    });
});
</script>
@endsection