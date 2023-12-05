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
                            <p><span>150</span>k</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="img_col">
                            <i class="fa-solid fa-money-check-dollar"></i>
                        </div>
                        <div class="card_text">
                            <h3>Total Payment</h3>
                            <p><span>100</span>k</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="img_col">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="card_text">
                            <h3>Total Orders</h3>
                            <p><span>05</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="img_col">
                            <i class="fa-regular fa-money-bill-1"></i>
                        </div>
                        <div class="card_text">
                            <h3>Collect Request</h3>
                            <p><span>75</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="img_col">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div class="card_text">
                            <h3>Withdraws</h3>
                            <p><span>725</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="img_col">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                        <div class="card_text">
                            <h3>Transfer</h3>
                            <p><span>725</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-default edit__inner__container">
            <div class="card-body table-responsive">
                <table class="table dataTable no-footer" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5052</td>
                            <td>gsdgs</td>
                            <td>dsfsdf</td>
                            <td>
                                <span class="completed">Completed</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
    {{-- @include('employees.employee-search-modal') --}}
</div>
@endsection

@section('script')
@endsection