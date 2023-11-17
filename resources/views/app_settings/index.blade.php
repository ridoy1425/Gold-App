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
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title">Today Gold Price</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="{{ url('setting/gold-price-set') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $settings->id ?? '' }}">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    TITLE/TEXT
                                                </label>
                                                <input type="text" name="title" value="{{ $settings->title ?? '' }}"
                                                    class="box-input" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    TODAY GOLD PRICE
                                                </label>
                                                <input type="text" name="gold_price"
                                                    value="{{ $settings->gold_price ?? '' }}" class="box-input" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <button type="submit" class="btn primary-btn centered">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title">Account Details for Add Balance</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="{{ url('bank-info') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="client" value="web">
                                    <input type="hidden" name="account_type" value="admin">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    ACCOUNT NAME
                                                </label>
                                                <input type="text" name="account_name" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    ACCOUNT NUMBER
                                                </label>
                                                <input type="text" name="account_number" class="box-input"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    BANK NAME
                                                </label>
                                                <input type="text" name="bank_name" class="box-input" required="">
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    BANK CODE
                                                </label>
                                                <input type="text" name="bank_code" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    BRANCH NAME
                                                </label>
                                                <input type="text" name="branch_name" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    ROUTING NUMBER
                                                </label>
                                                <input type="text" name="routing_number" class="box-input"
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title">Gold Price & Profit</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="https://hyiprio.tdevs.co/admin/user/password-update/2835" method="post">
                                    <input type="hidden" name="_token"
                                        value="HoURYRw8yjEK5pUXqBZJAtFAQIXvUlfeZZJUytt4">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    HEADER TEXT
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    SUBHEADER
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    BUYING PRICE
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    PROFIT Percentage (%)
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    RETURN period (in DAYS)
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
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
