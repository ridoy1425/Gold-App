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
            @if (isset($label))
                <form action="{{ url('designation/label/update', $label->id) }}" method="post">
                    @method('PATCH')
                @else
                    <form action="{{ url('designation/label/store') }}" method="post">
            @endif
            @csrf
            {{-- card-body start --}}
            <div class="edit__inner__container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title">Today Gold Price</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="https://hyiprio.tdevs.co/admin/user/password-update/2835" method="post">
                                    <input type="hidden" name="_token" value="HoURYRw8yjEK5pUXqBZJAtFAQIXvUlfeZZJUytt4">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    TITLE/TEXT
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    TODAY GOLD PRICE
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
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title">Account Details for Add Balance</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="https://hyiprio.tdevs.co/admin/user/password-update/2835" method="post">
                                    <input type="hidden" name="_token" value="HoURYRw8yjEK5pUXqBZJAtFAQIXvUlfeZZJUytt4">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    BANK NAME
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    ACCOUNT NUMBER
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    BANK CODE
                                                </label>
                                                <input type="text" name="" class="box-input" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="site-input-groups">
                                                <label for="" class="box-input-label">
                                                    ROUTING NUMBER
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="site-card">
                            <div class="site-card-header">
                                <h3 class="title">Gold Price & Profit</h3>
                            </div>
                            <div class="site-card-body">
                                <form action="https://hyiprio.tdevs.co/admin/user/password-update/2835" method="post">
                                    <input type="hidden" name="_token" value="HoURYRw8yjEK5pUXqBZJAtFAQIXvUlfeZZJUytt4">
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
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
