@extends('ui.admin_panel.master')

@section('title', 'App Settings')

@section('style')
<style>
.display {
    display: none;
}
</style>
@endsection

@section('content_title')
<h4 class="mt-2">App Settings</h4>
@endsection

@section('main_content')
<div class="row page-content">
    <div class="container">
        {{-- card-body start --}}
        <div class="edit__inner__container">
            <div class="site-tab-bars">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link active" id="gold-price-profit-tab" data-bs-toggle="pill"
                            data-bs-target="#gold-price-profit" type="button" role="tab"
                            aria-controls="gold-price-profit" aria-selected="true">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                            Gold Price & Profit</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link" id="account-details-tab" data-bs-toggle="pill"
                            data-bs-target="#account-details" type="button" role="tab" aria-controls="account-details"
                            aria-selected="true">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            Account Details for Add Balance</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link" id="today-gold-price-tab" data-bs-toggle="pill"
                            data-bs-target="#today-gold-price" type="button" role="tab" aria-controls="today-gold-price"
                            aria-selected="true">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            Today Gold Price</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">


                <!-- Gold Price & Profit -->
                <div class="tab-pane fade" id="gold-price-profit" role="tabpanel"
                    aria-labelledby="gold-price-profit-tab">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Gold Price &amp; Profit</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="http://127.0.0.1:8000/setting/gold-order-set" method="post">
                                <input type="hidden" name="_token" value="o2JwOjsXMW2BT9AdPIIhREGAcj1LwIUxS1H8wF4J">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                HEADER TEXT
                                            </label>
                                            <input type="text" name="header_text" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                SUBHEADER
                                            </label>
                                            <input type="text" name="sub_header" class="box-input" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                BUYING PRICE
                                            </label>
                                            <input type="text" name="buying_price" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                PROFIT Percentage (%)
                                            </label>
                                            <input type="text" name="profit_percentage" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                RETURN period (in DAYS)
                                            </label>
                                            <input type="text" name="return_period" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="btn primary-btn centered">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Details for Add Balance -->
                <div class="tab-pane fade active show" id="account-details" role="tabpanel"
                    aria-labelledby="account-details-tab">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Account Details for Add Balance</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="http://127.0.0.1:8000/setting/bank-info" method="post">
                                <input type="hidden" name="_token" value="o2JwOjsXMW2BT9AdPIIhREGAcj1LwIUxS1H8wF4J">
                                <input type="hidden" name="client" value="web">
                                <input type="hidden" name="account_type" value="admin">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                ACCOUNT NAME
                                            </label>
                                            <input type="text" name="account_name" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                ACCOUNT NUMBER
                                            </label>
                                            <input type="text" name="account_number" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                BANK NAME
                                            </label>
                                            <input type="text" name="bank_name" class="box-input" value="" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                BANK CODE
                                            </label>
                                            <input type="text" name="bank_code" class="box-input" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                BRANCH NAME
                                            </label>
                                            <input type="text" name="branch_name" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                ROUTING NUMBER
                                            </label>
                                            <input type="text" name="routing_number" class="box-input" value=""
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="btn primary-btn centered">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Today Gold Price -->
                <div class="tab-pane fade" id="today-gold-price" role="tabpanel" aria-labelledby="today-gold-price-tab">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Today Gold Price</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="http://127.0.0.1:8000/setting/gold-price-set" method="post">
                                <input type="hidden" name="_token" value="o2JwOjsXMW2BT9AdPIIhREGAcj1LwIUxS1H8wF4J">
                                <input type="hidden" name="id" value="">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                TITLE/TEXT
                                            </label>
                                            <input type="text" name="title" value="" class="box-input" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                TODAY GOLD PRICE
                                            </label>
                                            <input type="text" name="gold_price" value="" class="box-input" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="btn primary-btn centered">Submit</button>
                                    </div>
                                </div>
                            </form>
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