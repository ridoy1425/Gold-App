@php
    $route = Route::current()->getName();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>World Shine-@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/ywca.png') }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/fonts.css') }}">
    <!-- Font Awesome Icons -->
    <!-- <link rel="stylesheet" href="{{ asset('ui/admin_assets/plugins/fontawesome-free/css/all.min.css') }}"> -->
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/dist/css/adminlte.min.css') }}">
    {{-- bootstart css --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/bootstrap.min.css') }}">
    {{-- select2  --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/select2.css') }}">
    {{-- datepicker --}}
    {{-- <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'> --}}
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/jquery-ui.css') }}">
    {{-- datatable --}}
    {{-- <link rel="stylesheet" href="{{ asset('ui/login_assets/css/jquery.dataTables.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/dist/css/style.css') }}">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <div class="top-header">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>
                @yield('content_title')

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item mr-3">
                        <div class="dropdown logout_btn">

                            <a class="dropdown-toggle" href="#" id="dropdownMenu2" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                                <li>
                                    <a class="dropdown-item" href="#" type="button">
                                        @auth
                                            {{ auth()->user()->name }}
                                        @endauth
                                    </a>

                                </li>
                                <li><a class="dropdown-item" href="{{ url('logout') }}" type="button">Log Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('images/ywca.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text">World Shine</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (auth()->user()->hasPermission('dashboard'))
                            <li class="nav-item ">
                                <a href="{{ route('dashboard') }}"
                                    class="nav-link {{ $route == 'dashboard' ? ' active' : '' }}">
                                    <i class="fas fa-tachometer-alt nav-icon"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('users'))
                            <li class="nav-item ">
                                <a href="{{ route('user-list') }}"
                                    class="nav-link {{ $route == 'user-list' || $route == 'user-edit' ? ' active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('kyc'))
                            <li class="nav-item ">
                                <a href="{{ route('kyc-list') }}"
                                    class="nav-link {{ $route == 'kyc-list' || $route == 'kyc-edit' ? ' active' : '' }}">
                                    <i class="fa-regular fa-square-check nav-icon"></i>
                                    <p>
                                        KYC
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('app-settings'))
                            <li class="nav-item ">
                                <a href="{{ route('app-index') }}"
                                    class="nav-link {{ $route == 'app-index' ? ' active' : '' }}">
                                    <i class="fa-solid fa-gear nav-icon"></i>
                                    <p>
                                        App Settings
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('payments'))
                            <li class="nav-item ">
                                <a href="{{ route('payment-index') }}"
                                    class="nav-link {{ $route == 'payment-index' ? ' active' : '' }}">
                                    <i class="fa-solid fa-hand-holding-dollar nav-icon"></i>
                                    <p>
                                        Payments
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('orders'))
                            <li class="nav-item ">
                                <a href="{{ route('Order-index') }}"
                                    class="nav-link {{ $route == 'Order-index' ? ' active' : '' }}">
                                    <!-- <i class="fa-solid fa-basket-shopping nav-icon"></i> -->
                                    <i class="fa-solid fa-cart-plus nav-icon"></i>
                                    <p>
                                        Orders
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('collection-request'))
                            <li class="nav-item ">
                                <a href="{{ route('collect-request') }}"
                                    class="nav-link {{ $route == 'collect-request' ? ' active' : '' }}">
                                    <i class="fa-regular fa-money-bill-1 nav-icon"></i>
                                    <p>
                                        Collect Request
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('withdraws'))
                            <li class="nav-item ">
                                <a href="{{ route('withdraw-list') }}"
                                    class="nav-link {{ $route == 'withdraw-list' ? ' active' : '' }}">
                                    <i class="fa-solid fa-landmark nav-icon"></i>
                                    <p>
                                        Withdraws
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('transfers'))
                            <li class="nav-item ">
                                <a href="{{ route('transfer-list') }}"
                                    class="nav-link {{ $route == 'transfer-list' ? ' active' : '' }}">
                                    <i class="fa-solid fa-money-bill-transfer nav-icon"></i>
                                    <p>
                                        Transfer
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('manage-role'))
                            <li class="nav-item ">
                                <a href="{{ route('role-list') }}"
                                    class="nav-link {{ $route == 'role-list' || $route == 'role-create' ? ' active' : '' }}">
                                    <i class="fa-solid fa-person-circle-plus nav-icon"></i>
                                    <p>
                                        Manage Roles
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('message-template'))
                            <li class="nav-item ">
                                <a href="{{ route('template-index') }}"
                                    class="nav-link {{ $route == 'template-index' || $route == 'template-create' ? ' active' : '' }}">
                                    <i class="fa-regular fa-message nav-icon"></i>
                                    <p>
                                        Message Template
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('message-to-users'))
                            <li class="nav-item ">
                                <a href="{{ route('sendbox-index') }}"
                                    class="nav-link {{ $route == 'sendbox-index' ? ' active' : '' }}">
                                    <i class="fa-regular fa-comment-dots nav-icon "></i>
                                    <p>
                                        Message To Users
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('message-to-users'))
                            <li class="nav-item ">
                                <a href="{{ route('sent-message') }}"
                                    class="nav-link {{ $route == 'sent-message' ? ' active' : '' }}">
                                    <i class="fa-regular fa-comment-dots nav-icon "></i>
                                    <p>
                                        Sent Messages
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('support-message'))
                            <li class="nav-item ">
                                <a href="{{ route('message-inbox') }}"
                                    class="nav-link {{ $route == 'message-inbox' ? ' active' : '' }}">
                                    <i class="fa-solid fa-chalkboard-user nav-icon"></i>
                                    <p>
                                        Support Message
                                    </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item {{ $route == 'role-create' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Landing Page
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user-list') }}"
                                        class="nav-link {{ $route == 'user-list' ? ' active' : '' }}">
                                        <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                        <p>Index page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('role-list') }}"
                                        class="nav-link {{ $route == 'role-list' ? 'active' : '' }}">
                                        <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                        <p>Privacy page</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            {{-- <h1 class="m-0">
                                @yield('content_title')
                            </h1> --}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container-fluid">
                <div class="content">
                    @yield('main_content')
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="http://qsoft.net/">Ridoy</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer> --}}
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('ui/admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('ui/admin_assets/dist/js/adminlte.js') }}"></script>
    {{-- bootstarp js --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"> </script> --}}
    <script src="{{ asset('ui/admin_assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- datepicker --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
    <script src="{{ asset('ui/admin_assets/js/jquery-ui.min.js') }}"></script>
    {{-- datatable --}}
    <script src="{{ asset('ui/admin_assets/js/jquery.dataTables.js') }}"></script>
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script> --}}
    {{-- select2  --}}
    <script src="{{ asset('ui/admin_assets/js/select2.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.js"></script> --}}
    {{-- typeahead js --}}
    <script src="{{ asset('ui/admin_assets/js/bootstrap3-typeahead.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> --}}
    @yield('script')
</body>

</html>
