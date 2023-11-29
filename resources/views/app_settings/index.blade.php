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
        <div class="edit__inner__container app__settings__main">
            <div class="site-tab-bars">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link active" id="gold-price-profit-tab" data-bs-toggle="pill"
                            data-bs-target="#gold-price-profit" type="button" role="tab"
                            aria-controls="gold-price-profit" aria-selected="true">
                            <i class="fa-solid fa-circle-info"></i>
                            App Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="" class="nav-link" id="price-package-tab" data-bs-toggle="pill"
                            data-bs-target="#price-package" type="button" role="tab" aria-controls="price-package"
                            aria-selected="true">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            Price & Package</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <!-- Gold Price & Profit -->
                <div class="tab-pane fade active show" id="gold-price-profit" role="tabpanel"
                    aria-labelledby="gold-price-profit-tab">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Today Gold Price</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="{{ url('setting/gold-price-set') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                TITLE/TEXT
                                            </label>
                                            <input type="text" name="title" value="{{ $settings->title ?? '' }}"
                                                class="box-input" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                TODAY GOLD PRICE
                                            </label>
                                            <input type="text" name="gold_price"
                                                value="{{ $settings->gold_price ?? '' }}" class="box-input" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="action-btns">
                                    <button type="submit" class="btn primary-btn centered">
                                        <i class="fas fa-check"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Minimum Price</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="{{ url('setting/minimum-price-set') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                Minimum Quantity
                                            </label>
                                            <input type="text" name="minimum_quantity"
                                                value="{{ $settings->minimum_quantity ?? '' }}" class="box-input"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                Price per gm
                                            </label>
                                            <input type="text" name="price_per_gm"
                                                value="{{ $settings->price_per_gm ?? '' }}" class="box-input"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="action-btns">
                                    <button type="submit" class="btn primary-btn centered">
                                        <i class="fas fa-check"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">App Header</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="{{ url('setting/gold-order-set') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                HEADER TEXT
                                            </label>
                                            <input type="text" name="header_text" class="box-input"
                                                value="{{ $settings->header_text }}" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="action-btns">
                                    <button type="submit" class="btn primary-btn centered">
                                        <i class="fas fa-check"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Account Details for Add Balance</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="{{ url('setting/bank-info') }}" method="post">
                                @csrf
                                <input type="hidden" name="client" value="web">
                                <input type="hidden" name="account_type" value="admin">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                ACCOUNT NAME
                                            </label>
                                            <input type="text" name="account_name" class="box-input"
                                                value="{{ $bankInfo->account_name ?? '' }}" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                ACCOUNT NUMBER
                                            </label>
                                            <input type="text" name="account_number" class="box-input"
                                                value="{{ $bankInfo->account_number ?? '' }}" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                BANK CODE
                                            </label>
                                            <input type="text" name="bank_code" class="box-input"
                                                value="{{ $bankInfo->bank_code ?? '' }}" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="site-input-groups">
                                            <label for="" class="box-input-label">
                                                ROUTING NUMBER
                                            </label>
                                            <input type="text" name="routing_number" class="box-input"
                                                value="{{ $bankInfo->routing_number ?? '' }}" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="action-btns">
                                    <button type="submit" class="btn primary-btn centered">
                                        <i class="fas fa-check"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Account Details for Add Balance -->
                <div class="tab-pane fade" id="price-package" role="tabpanel" aria-labelledby="price-package-tab">
                    <div class="site-card">
                        <div class="site-card-header">
                            <h3 class="title">Delivery time & Percentage (%)</h3>
                        </div>
                        <div class="site-card-body">
                            <form action="{{ url('setting/profit-package-set') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                                        <div class="site-input-groups">
                                            <input type="text" name="month" placeholder="Month 6" class="box-input"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                                        <div class="site-input-groups">
                                            <input type="text" name="percentage" placeholder="% 2" class="box-input"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                        <div class="site-input-groups">
                                            <button class="site-btn-sm primary-btn w-100 centered">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="site-card-body table-responsive">
                            <div class="site-datatable">
                                <div id="user-investment-dataTable_wrapper"
                                    class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="user-investment-dataTable" class="data-table dataTable no-footer"
                                                aria-describedby="user-investment-dataTable_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="user-investment-dataTable" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Schema: activate to sort column ascending">SL
                                                            </td>
                                                        <th class="sorting sorting_asc" tabindex="0"
                                                            aria-controls="user-investment-dataTable" rowspan="1"
                                                            colspan="1" aria-sort="ascending"
                                                            aria-label="Icon: activate to sort column descending">
                                                            Month
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="user-investment-dataTable" rowspan="1"
                                                            colspan="1"
                                                            aria-label="Schema: activate to sort column ascending">
                                                            Percentage (%)
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="user-investment-dataTable" rowspan="1"
                                                            colspan="1"
                                                            aria-label="ROI: activate to sort column ascending">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($packages)
                                                    @foreach ($packages as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->month }} months</td>
                                                        <td>% {{ $row->percentage }}</td>
                                                        <td> <a href="{{ URL('setting/package-delete', $row->id) }}"
                                                                onclick="return confirm('Are you sure?')">
                                                                <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                                    alt="Delete" class="action__icon">
                                                            </a></td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr class="odd">
                                                        <td valign="top" colspan="6" class="dataTables_empty">No
                                                            data
                                                            available in table</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div id="user-investment-dataTable_processing"
                                                class="dataTables_processing card" style="display: none;">
                                                Processing...</div>
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

@section('script') @endsection