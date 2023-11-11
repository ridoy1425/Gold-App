@php
    $route = Route::current()->getName();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YWCA-@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/ywca.png') }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/fonts.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('ui/admin_assets/css/ionicons.min.css') }}">
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
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/jquery.dataTables.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css"> --}}
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
                                            {{ auth()->user()->user_name }}
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
            <a href="index.html" class="brand-link">
                <img src="{{ asset('ui/admin_assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">HRIS</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (auth()->user()->hasPermission('designation-label') ||
                                auth()->user()->hasPermission('designation-info') ||
                                auth()->user()->hasPermission('branch-information') ||
                                auth()->user()->hasPermission('designation-label'))
                            <li
                                class="nav-item {{ $route == 'leave-type-create' || $route == 'leave-type' || $route == 'designation-label' || $route == 'designation-info' || $route == 'branch-info' || $route == 'branch-create' || $route == 'desig-label-create' || $route == 'desig-label-edit' || $route == 'designation-create' || $route == 'designation-edit' || $route == 'branch-edit' || $route == 'leave-type-edit' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        General Settings
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->hasPermission('designation-label'))
                                        <li class="nav-item">
                                            <a href="{{ route('designation-label') }}"
                                                class="nav-link {{ $route == 'designation-label' || $route == 'desig-label-create' || $route == 'desig-label-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Designation Label</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('designation-info'))
                                        <li class="nav-item">
                                            <a href="{{ route('designation-info') }}"
                                                class="nav-link {{ $route == 'designation-info' || $route == 'designation-create' || $route == 'designation-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Designation Info</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('branch-information'))
                                        <li class="nav-item">
                                            <a href="{{ route('branch-info') }}"
                                                class="nav-link {{ $route == 'branch-info' || $route == 'branch-create' || $route == 'branch-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Branch Information</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('leave-type'))
                                        <li class="nav-item">
                                            <a href="{{ route('leave-type') }}"
                                                class="nav-link {{ $route == 'leave-type' || $route == 'leave-type-create' || $route == 'leave-type-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Leave Type</p>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('employee-information'))
                            <li class="nav-item {{ $route == 'employee-info' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>
                                        Employees
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('employee-info') }}"
                                            class="nav-link {{ $route == 'employee-info' ? ' active' : '' }}">
                                            <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                            <p>Employee Information</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('employee-basic-report'))
                            <li
                                class="nav-item {{ $route == 'employee-list' || $route == 'report-search' || $route == 'staff-summary-report' || $route == 'staff-summary-result' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Employee Info Report
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->hasPermission('employee-basic-report'))
                                        <li class="nav-item">
                                            <a href="{{ route('employee-list') }}"
                                                class="nav-link {{ $route == 'employee-list' || $route == 'report-search' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Employee Basic Report</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('staff-summary-report'))
                                        <li class="nav-item">
                                            <a href="{{ route('staff-summary-report') }}"
                                                class="nav-link {{ $route == 'staff-summary-report' || $route == 'staff-summary-result' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Staff Summary Report</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('leave-entry') ||
                                auth()->user()->hasPermission('leave-approval') ||
                                auth()->user()->hasPermission('leave-application-form'))
                            <li
                                class="nav-item {{ $route == 'leave-application-form' || $route == 'leave-entry-index' || $route == 'leave-entry' || $route == 'leave-approval' || $route == 'leave-entry-edit' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        Leave Information
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->hasPermission('leave-entry'))
                                        <li class="nav-item">
                                            <a href="{{ route('leave-entry-index') }}"
                                                class="nav-link {{ $route == 'leave-entry-index' || $route == 'leave-entry' || $route == 'leave-entry-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Leave Entry</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('leave-approval'))
                                        <li class="nav-item">
                                            <a href="{{ route('leave-approval') }}"
                                                class="nav-link {{ $route == 'leave-approval' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Leave Approval</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('leave-application-form'))
                                        <li class="nav-item">
                                            <a href="{{ route('leave-application-form') }}"
                                                class="nav-link {{ $route == 'leave-application-form' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Leave Application Form</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('leave-register'))
                            <li class="nav-item {{ $route == 'leave-register' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-inbox"></i>
                                    <p>
                                        Leave Report
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('leave-register') }}"
                                            class="nav-link {{ $route == 'leave-register' ? ' active' : '' }}">
                                            <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                            <p>Leave Register</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('appraisal-category') ||
                                auth()->user()->hasPermission('appraisal-evaluator') ||
                                auth()->user()->hasPermission('duty-responsibilities') ||
                                auth()->user()->hasPermission('attitude-behavior'))
                            <li
                                class="nav-item {{ $route == 'evaluation-edit' || $route == 'category-create' || $route == 'evaluator-create' || $route == 'duty-create' || $route == 'behavior-create' || $route == 'attitude-behavior' || $route == 'appraisal-category' || $route == 'appraisal-evaluator' || $route == 'duty-responsibilities' || $route == 'evaluation-form' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-dna"></i>
                                    <p>
                                        Appraisal
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->hasPermission('appraisal-category'))
                                        <li class="nav-item">
                                            <a href="{{ route('appraisal-category') }}"
                                                class="nav-link {{ $route == 'appraisal-category' || $route == 'category-create' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Appraisal Category</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('appraisal-category'))
                                        <li class="nav-item">
                                            <a href="{{ route('appraisal-evaluator') }}"
                                                class="nav-link {{ $route == 'appraisal-evaluator' || $route == 'evaluator-create' ? 'active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Evaluator Information</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('duty-responsibilities'))
                                        <li class="nav-item">
                                            <a href="{{ route('duty-responsibilities') }}"
                                                class="nav-link {{ $route == 'duty-responsibilities' || $route == 'duty-create' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Duty & Responsibilities</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('attitude-behavior'))
                                        <li class="nav-item">
                                            <a href="{{ route('attitude-behavior') }}"
                                                class="nav-link {{ $route == 'attitude-behavior' || $route == 'behavior-create' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Attitude & Behavior</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('evaluation-form'))
                                        <li class="nav-item">
                                            <a href="{{ route('evaluation-form') }}"
                                                class="nav-link {{ $route == 'evaluation-form' || $route == 'evaluation-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Evaluation Form</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('evaluation-list') ||
                                auth()->user()->hasPermission('appraisal-summary-report'))
                            <li
                                class="nav-item {{ $route == 'evaluation-list' || $route == 'appraisal-summary-report' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Appraisal Report
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->hasPermission('evaluation-list'))
                                        <li class="nav-item">
                                            <a href="{{ route('evaluation-list') }}"
                                                class="nav-link {{ $route == 'evaluation-list' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Evaluation List</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('appraisal-summary-report'))
                                        <li class="nav-item">
                                            <a href="{{ route('appraisal-summary-report') }}"
                                                class="nav-link {{ $route == 'appraisal-summary-report' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Appraisal Summary Report</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('user-list') ||
                                auth()->user()->hasPermission('role-list'))
                            <li
                                class="nav-item {{ $route == 'role-create' || $route == 'role-edit' || $route == 'user-create' || $route == 'user-edit' || $route == 'user-list' || $route == 'role-list' || $route == 'permission-list' ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (auth()->user()->hasPermission('user-list'))
                                        <li class="nav-item">
                                            <a href="{{ route('user-list') }}"
                                                class="nav-link {{ $route == 'user-list' || $route == 'user-create' || $route == 'user-edit' ? ' active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>User List</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('role-list'))
                                        <li class="nav-item">
                                            <a href="{{ route('role-list') }}"
                                                class="nav-link {{ $route == 'role-list' || $route == 'permission-list' || $route == 'role-create' || $route == 'role-edit' ? 'active' : '' }}">
                                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                                <p>Role List</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
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
