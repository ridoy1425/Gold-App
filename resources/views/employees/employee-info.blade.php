@extends('ui.admin_panel.master')

@section('title', 'Employee Information')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/tabs/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/tabs/css/style.css') }}">

    <style>
        #flash_message {
            margin-left: 100px;
            padding: 2px 128px;
            background: #74c7d7;
            display: none;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>
@endsection

@section('content_title')
    <h4 class="mt-2">Employee Information</h4>
    <div id="flash_message"></div>
@endsection


@section('main_content')
    <div class=" row  page-content">
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
            <div class="wizard-form">
                <div class="form-register">
                    <div id="form-total">
                        <!-- SECTION 1 -->
                        <h2>
                            <span class="step-icon" id="tab1"><i class="fas fa-user nav-icon"></i></span>
                            <span class="step-text">Basic Info</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Basic Information</h3>
                                <form id="basicForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id" readonly>
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="mb-1 row">
                                                <label for="name"
                                                    class="col-sm-6 col-form-label col-form-label-sm font-weight-bold">Employee
                                                    ID <span class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    @if (isset($userInfo))
                                                        <input type="text" value="{{ $userInfo->employee_gid }}"
                                                            class="form-control form-control-sm" id="employee_gid"
                                                            name="employee_gid" placeholder="Double Click to Search"
                                                            readonly>
                                                    @else
                                                        <input type="text"
                                                            value="{{ old('employee_gid', $data->employee_gid ?? '') }}"
                                                            class="form-control form-control-sm" id="employee_gid"
                                                            name="employee_gid" placeholder="Double Click to Search"
                                                            readonly>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-1 row">
                                                <label for="name" class="col-sm-6 col-form-label col-form-label-sm">Full
                                                    Name(English) <span class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    @if (isset($userInfo))
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="full_name" name="full_name"
                                                            value="{{ $userInfo->full_name }}" required>
                                                    @else
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="full_name" name="full_name"
                                                            value="{{ old('full_name', $data->full_name ?? '') }}" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="mother_name"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Mother
                                                    Name(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="mother_name" name="mother_name"
                                                        value="{{ old('mother_name', $data->mother_name ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="father_name"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Father
                                                    Name(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="father_name" name="father_name"
                                                        value="{{ old('father_name', $data->father_name ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_des_label"
                                                    class="col-sm-6 col-form-label col-form-label-sm ">Present
                                                    Designation Label</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select designation"
                                                        id="present_des_label" name="present_des_label_id" runat="server">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($labels as $label)
                                                            <option value="{{ $label->id }}">
                                                                {{ $label->label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_joining_date"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Date
                                                    of Present Des Joining</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_joining_date" name="present_joining_date">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="joining_des_label"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Joining
                                                    Designation
                                                    Label</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select designation"
                                                        id="joining_des_label" name="joining_des_label_id"
                                                        runat="server">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($labels as $label)
                                                            <option value="{{ $label->id }}">
                                                                {{ $label->label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="joining_date"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Date
                                                    of Joining</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="joining_date" name="joining_date">
                                                </div>
                                            </div>

                                            <div class="mb-1 row">
                                                <label for="dob"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Date
                                                    of Birth</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm dob"
                                                        id="dob" name="dob">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="spouse_name"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Name
                                                    of Spouse(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="spouse_name" name="spouse_name"
                                                        value="{{ old('spouse_name', $data->spouse_name ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="telephone_no"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Telephone No</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="telephone_no" name="telephone_no"
                                                        value="{{ old('telephone_no', $data->telephone_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="passport_no"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Passport
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="passport_no" name="passport_no"
                                                        value="{{ old('passport_no', $data->passport_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="status"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Employee
                                                    Status <span class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="status"
                                                        name="status_id">
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'employee_status')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-1 row">
                                                <label for="full_name_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Full
                                                    Name(বাংলা) <span class="important_field"> *</span></label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="full_name_bn" name="full_name_bn"
                                                        value="{{ old('full_name_bn', $data->full_name_bn ?? '') }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="mother_name_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Mother
                                                    Name(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="mother_name_bn" name="mother_name_bn"
                                                        value="{{ old('mother_name', $data->mother_name_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="father_name_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Father
                                                    Name(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="father_name_bn" name="father_name_bn"
                                                        value="{{ old('father_name_bn', $data->father_name_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_designation"
                                                    class="col-sm-6 col-form-label col-form-label-sm ">Present
                                                    Designation</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select designation"
                                                        id="present_designation" name="present_designation_id"
                                                        runat="server">
                                                        <option selected value="">Choose...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_joining_age"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Today Present Des.
                                                    Age</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_joining_age" name="present_joining_age"
                                                        value="{{ old('present_joining_age', $data->joining_age ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="joining_designation"
                                                    class="col-sm-6 col-form-label col-form-label-sm ">Joining
                                                    Designation</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select designation"
                                                        id="joining_designation" name="joining_designation_id">
                                                        <option selected value="">Choose...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="joining_age"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Today Joining
                                                    Age</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="joining_age" name="joining_age"
                                                        value="{{ old('joining_age', $data->joining_age ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="mb-1 row">
                                                <label for="today_age"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Today Age</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm age"
                                                        id="today_age" name="today_age"
                                                        value="{{ old('today_age', $data->today_age ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="spouse_name_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Name
                                                    of Spouse(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="spouse_name_bn" name="spouse_name_bn"
                                                        value="{{ old('spouse_name', $data->spouse_name_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="mobile_no"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Mobile Number</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="mobile_no" name="mobile_no"
                                                        value="{{ old('mobile_no', $data->mobile_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="national_id"
                                                    class="col-sm-6 col-form-label col-form-label-sm">National ID</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="national_id" name="national_id"
                                                        value="{{ old('national_id', $data->national_id ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="status_date"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Status Date <span
                                                        class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm datepicker"
                                                        id="status_date" name="status_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-1 row">
                                                <label for="branch_id"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Branch Name <span
                                                        class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select designation" id="branch_id"
                                                        name="branch_id" required>
                                                        @if (auth()->user()->hasRole('super-admin') ||
                                                                auth()->user()->hasRole('admin'))
                                                            <option selected value="">Choose...</option>
                                                            @foreach ($branches as $branch)
                                                                <option value="{{ $branch->id }}">
                                                                    {{ $branch->name }}({{ $branch->code }})
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option selected
                                                                value="{{ auth()->user()->employee->branch_id }}">
                                                                {{ auth()->user()->employee->branch->name ?? '' }}({{ auth()->user()->employee->branch->code ?? '' }})
                                                            </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="appraisal_category_id"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Appraisal
                                                    Category</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="appraisal_category_id"
                                                        name="appraisal_category_id">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="gender"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Gender <span
                                                        class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="gender"
                                                        name="gender_id" required>
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'gender')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-1 row">
                                                <label for="religion"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Religion</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="religion"
                                                        name="religion_id">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'religion')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-1 row">
                                                <label for="blood_group"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Blood Group</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="blood_group"
                                                        name="blood_group_id">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'blood_group')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-1 row">
                                                <label for="nationality"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Nationality</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="nationality" name="nationality"
                                                        value="{{ old('nationality', $data->nationality ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="tin_no"
                                                    class="col-sm-6 col-form-label col-form-label-sm">E-TIN No</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="tin_no" name="tin_no"
                                                        value="{{ old('tin_no', $data->tin_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="marital_status"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Marital
                                                    Status</label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="marital_status"
                                                        name="marital_status_id">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'marital_status')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="spouse_occupation"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Occupation of
                                                    Spouse</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="spouse_occupation" name="spouse_occupation"
                                                        value="{{ old('spouse_occupation', $data->spouse_occupation ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="alt_mobile_no"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Alternative Mobile
                                                    No</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="alt_mobile_no" name="alt_mobile_no"
                                                        value="{{ old('alt_mobile_no', $data->alt_mobile_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="type"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Employee Type <span
                                                        class="important_field">*</span></label>
                                                <div class="col-sm-6">
                                                    <select class="form-select-sm form-select" id="type"
                                                        name="type_id" required>
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'type')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <button type="submit" id="basicSubmit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION 2 -->
                        <h2>
                            <span class="step-icon" id="tab2"><i class="fas fa-home nav-icon"></i></span>
                            <span class="step-text">Address</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Present Address</h3>
                                <form id="addressForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="present_house"
                                                    class="col-sm-6 col-form-label col-form-label-sm">House
                                                    No/Village(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_house" name="present_house"
                                                        value="{{ old('present_house', $data->present_house ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_post_off"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Post
                                                    Office(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_post_off" name="present_post_off"
                                                        value="{{ old('present_post_off', $data->present_post_off ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_road_no"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Road
                                                    No(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_road_no" name="present_road_no"
                                                        value="{{ old('present_road_no', $data->present_road_no ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_district"
                                                    class="col-sm-6 col-form-label col-form-label-sm">District(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_district" name="present_district"
                                                        value="{{ old('present_district', $data->present_district ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="present_house_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">House
                                                    No/Village(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_house_bn" name="present_house_bn"
                                                        value="{{ old('present_house_bn', $data->present_house_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_post_off_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Post
                                                    Office(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_post_off_bn" name="present_post_off_bn"
                                                        value="{{ old('present_post_off_bn', $data->present_post_off_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_road_no_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Road
                                                    No(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_road_no_bn" name="present_road_no_bn"
                                                        value="{{ old('present_road_no_bn', $data->present_road_no_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="present_district_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">District(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="present_district_bn" name="present_district_bn"
                                                        value="{{ old('present_district_bn', $data->present_district_bn ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Permanent Address</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="permanent_village"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Village(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_village" name="permanent_village"
                                                        value="{{ old('permanent_village', $data->permanent_village ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="permanent_post_off"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Post
                                                    Office(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_post_off" name="permanent_post_off"
                                                        value="{{ old('permanent_post_off', $data->permanent_post_off ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="permanent_police_station"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Police
                                                    Station(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_police_station" name="permanent_police_station"
                                                        value="{{ old('permanent_police_station', $data->permanent_police_station ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="permanent_district"
                                                    class="col-sm-6 col-form-label col-form-label-sm">District(English)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_district" name="permanent_district"
                                                        value="{{ old('permanent_district', $data->permanent_district ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="permanent_village_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Village(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_village_bn" name="permanent_village_bn"
                                                        value="{{ old('permanent_village_bn', $data->permanent_village_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="permanent_post_off_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Post
                                                    Office(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_post_off_bn" name="permanent_post_off_bn"
                                                        value="{{ old('permanent_post_off_bn', $data->permanent_post_off_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="permanent_police_station_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Police
                                                    Station(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_police_station_bn"
                                                        name="permanent_police_station_bn"
                                                        value="{{ old('permanent_police_station_bn', $data->permanent_police_station_bn ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="permanent_district_bn"
                                                    class="col-sm-6 col-form-label col-form-label-sm">District(বাংলা)</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="permanent_district_bn" name="permanent_district_bn"
                                                        value="{{ old('permanent_district_bn', $data->permanent_district_bn ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="addressSubmit"
                                        class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION EXTRA  -->
                        <h2>
                            <span class="step-icon" id="tab2"><i class="fas fa-image nav-icon"></i></span>
                            <span class="step-text">Photo</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Profile Picture</h3>
                                <form id="imageForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Select Image</label>
                                                <input type="file" class="form-control" id="profile_image"
                                                    name="profile_image"
                                                    onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <img height="200px" width="180px" id="output" src=""
                                                alt="">
                                        </div>
                                    </div>
                                    <button type="submit" id="addressSubmit"
                                        class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION 3 -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-graduation-cap nav-icon"></i></span>
                            <span class="step-text">Academic</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Academic Information</h3>
                                <div class="float-right"><button type="button" name="add" id="add"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="academicForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="academic_form_count" value="">
                                    <table class="table table-bordered" id="dynamicTable">
                                        <thead>
                                            <tr>
                                                <th>Name of Degree</th>
                                                <th>Educational Institute</th>
                                                <th>Passing Year</th>
                                                <th>CGPA/Grade</th>
                                                <th>Discipline</th>
                                                <th>Attachment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-select-sm form-select" id="degree"
                                                        name="addmore[0][degree_id]">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($payloads as $payload)
                                                            @if ($payload->type == 'degree')
                                                                <option value="{{ $payload->id }}">
                                                                    {{ $payload->value }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="addmore[0][institute]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][pass_yr]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][grade]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][discipline]"
                                                        class="form-control form-control-sm" /></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="addmore[0][attachment][]" multiple
                                                                onchange="displayImages(this)">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="image-preview"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" id="academicSubmit"
                                        class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION 4 -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-briefcase nav-icon"></i></i></span>
                            <span class="step-text">Employment</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Employment History</h3>
                                <div class="float-right"><button type="button" name="add" id="add_employment"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="employmentForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="employment_form_count" value="">
                                    <table class="table table-bordered" id="employmentTable">
                                        <thead>
                                            <tr>
                                                <th>Organization Name</th>
                                                <th>Organization Adress</th>
                                                <th>Position Last Held</th>
                                                <th>Service From</th>
                                                <th>Service To</th>
                                                <th>Mode of Separation</th>
                                                <th>Attachment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="addmore[0][org_name]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][org_address]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][last_position]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][service_from]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][service_to]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][separation]"
                                                        class="form-control form-control-sm" /></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="addmore[0][attachment][]" multiple
                                                                onchange="displayImages(this)">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="image-preview"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION 5 -->
                        <h2>
                            <span class="step-icon"><i class="nav-icon fas fa-copy"></i></span>
                            <span class="step-text">Professional</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Professional Degrees</h3>
                                <div class="float-right"><button type="button" name="add" id="add_profession"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="professionalForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="professional_form_count" value="">
                                    <table class="table table-bordered" id="professionTable">
                                        <thead>
                                            <tr>
                                                <th>Name of Degree</th>
                                                <th>Educational Institute</th>
                                                <th>Duration From</th>
                                                <th>Duration To</th>
                                                <th>Class/Grade</th>
                                                <th>Major/Area</th>
                                                <th>Attachment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="addmore[0][degree]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][institute]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][duration_from]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][duration_to]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][grade]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][area]"
                                                        class="form-control form-control-sm" /></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="addmore[0][attachment][]" multiple
                                                                onchange="displayImages(this)">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="image-preview"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION 6 -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-pen nav-icon"></i></span>
                            <span class="step-text">Training</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Training</h3>
                                <div class="float-right"><button type="button" name="add" id="add_training"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="trainingForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="training_form_count" value="">
                                    <table class="table table-bordered" id="trainingTable">
                                        <thead>
                                            <tr>
                                                <th>Training/Workshop</th>
                                                <th>Institute</th>
                                                <th>Organized By</th>
                                                <th>Major Topic</th>
                                                <th>Duration From</th>
                                                <th>Duration To</th>
                                                <th>Attachment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="addmore[0][training]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][institute]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][org_by]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][topic]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][duration_from]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][duration_to]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control form-control-sm"
                                                                name="addmore[0][attachment][]" multiple
                                                                onchange="displayImages(this)">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="image-preview"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION others -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-laptop-house nav-icon"></i></span>
                            <span class="step-text">Others</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Others Information</h3>
                                <form id="othersForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="mother_tongue"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Mother Tongue</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="mother_tongue" name="mother_tongue">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="language"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Language
                                                    Known</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="language" name="language">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="skill"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Other
                                                    Experience/Technical Skills</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="skill" name="skill">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION family -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-users nav-icon"></i></span>
                            <span class="step-text">Family</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Dependent Family Members</h3>
                                <div class="float-right"><button type="button" name="add" id="add_family"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="familyForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="family_form_count" value="">
                                    <table class="table table-bordered" id="familyTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date of Birth</th>
                                                <th>Present Age</th>
                                                <th>Relation</th>
                                                <th>Occupation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="addmore[0][name]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][dob]"
                                                        class="form-control form-control-sm family_dob" /></td>
                                                <td><input type="text" name="addmore[0][age]"
                                                        class="form-control form-control-sm family_age" /></td>
                                                <td><input type="text" name="addmore[0][relation]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][occupation]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION nominee -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-check-double nav-icon"></i></span>
                            <span class="step-text">Nominee</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Official Nominee</h3>
                                <div class="float-right"><button type="button" name="add" id="add_nominee"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="nomineeForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="nominee_form_count" value="">
                                    <table class="table table-bordered" id="nomineeTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date of Birth</th>
                                                <th>Relation</th>
                                                <th>Occupation</th>
                                                <th>Address</th>
                                                <th>% of amount to be given</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="addmore[0][name]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][dob]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][relation]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][occupation]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][address]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][amount]"
                                                        class="form-control form-control-sm" multiple /></td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION Salary -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-dollar-sign nav-icon"></i></span>
                            <span class="step-text">Salary</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Salary Information</h3>
                                <form id="salaryForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="salary_grade"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Salary Grade</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="salary_grade" name="salary_grade">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="basic_salary"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Basic Salary</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="basic_salary" name="basic_salary">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="conveyance"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Conveynace</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="conveyance" name="conveyance">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="arban_allowance"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Arban
                                                    Allowance</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="arban_allowance" name="arban_allowance">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="contractual_salary"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Contractual Employeee
                                                    Salary</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="contractual_salary" name="contractual_salary">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1 row">
                                                <label for="pay_step"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Pay step</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="pay_step" name="pay_step">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="house_rent"
                                                    class="col-sm-6 col-form-label col-form-label-sm">House Rent</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="house_rent" name="house_rent">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="medical_allowance"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Medical
                                                    Allowance</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="medical_allowance" name="medical_allowance">
                                                </div>
                                            </div>
                                            <div class="mb-1 row">
                                                <label for="note"
                                                    class="col-sm-6 col-form-label col-form-label-sm">Note</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="note" name="note">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                        <!-- SECTION promotion -->
                        <h2>
                            <span class="step-icon"><i class="fas fa-layer-group nav-icon"></i></span>
                            <span class="step-text">Promotion</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Employee Promotion</h3>
                                <div class="float-right"><button type="button" name="add" id="add_promotion"
                                        class="btn btn-success mb-1">Add More</button>
                                </div>
                                <form id="promotionForm" autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="employee_id" value="" name="employee_id"
                                        readonly>
                                    <input type="hidden" id="promotion_form_count" value="">
                                    <table class="table table-bordered" id="promotionTable">
                                        <thead>
                                            <tr>
                                                <th>Designation</th>
                                                <th>Effective Date</th>
                                                <th>Salary</th>
                                                <th>Grade</th>
                                                <th>Step</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-select-sm form-select" id="designation_id"
                                                        name="addmore[0][designation_id]">
                                                        <option selected value="">Choose...</option>
                                                        @foreach ($designations as $designation)
                                                            <option value="{{ $designation->id }}">
                                                                {{ $designation->designation }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="addmore[0][effective_date]"
                                                        class="form-control form-control-sm datepicker" /></td>
                                                <td><input type="text" name="addmore[0][salary]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][salary_grade]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><input type="text" name="addmore[0][pay_step]"
                                                        class="form-control form-control-sm" /></td>
                                                <td><button type="button" class="btn btn-danger remove-tr"
                                                        style="line-height:0.5"><i
                                                            class="fas fa-trash nav-icon"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-warning mt-3">Submit</button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        @include('employees.employee-search-modal')
    </div>
@endsection

@section('script')
    <script>
        var appConfig = {
            getLaravelUrl: '{{ url('/') }}'
        };
    </script>
    <script src="{{ asset('ui/tabs/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('ui/tabs/js/main.js') }}"></script>
    <script>
        var fnAction;
        var baseUrl = "{{ asset('storage/') }}";

        function generateImagePreviewAndDownloadLinks(attachments, rowIndex) {
            let previewHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="file" class="form-control form-control-sm"
                    name="attachment[${rowIndex}][]"
                    onchange="displayImages(this)" multiple>
            </div>
            <div class="col-md-8">
                <div class="image-preview">`;

            attachments.forEach((attachment, index) => {
                const filePath = attachment.file_path;

                previewHTML += `<a href="${baseUrl}/${filePath}" download>
                <img src="${baseUrl}/${filePath}" alt="Attachment ${index + 1}" height="35" width="35">
            </a>`;
            });

            previewHTML += `
                </div>
            </div>
        </div>`;

            return previewHTML;
        }

        function getDegreeData(data, callback) {
            $.ajax({
                url: "{{ url('/employee/get-degrees') }}",
                type: 'GET',
                success: function(response) {
                    var degrees = response.degrees;
                    var selectOptions = '';
                    degrees.forEach(function(degree) {
                        const isSelected = (data.degree_id == degree.id) ? 'selected' : '';
                        selectOptions +=
                            '<option value="' + degree.id + '" ' + isSelected +
                            '>' + degree.value + '</option>';
                    });
                    callback(selectOptions);
                }
            });
        }

        function getDesignation(data, callback) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('/designation/get-designation') }}",
                type: 'post',
                success: function(response) {
                    var selectOptions = '';
                    response.forEach(function(designation) {
                        const isSelected = (data.designation_id == designation.id) ? 'selected' : '';
                        selectOptions +=
                            '<option value="' + designation.id + '" ' + isSelected +
                            '>' + designation.designation + '</option>';
                    });
                    callback(selectOptions);
                }
            });
        }

        $(document).ready(function() {
            // form submit ajax call function ----------------------------8888888888888888---------------------
            function handleFormSubmission(formId, url) {
                $(formId).on("submit", function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.employee_id) {
                                $('.employee_id').val(response.employee_id);
                            }
                            $("#flash_message").fadeIn();
                            $('#flash_message').html(response.message);
                            setTimeout(function() {
                                $("#flash_message").fadeOut();
                            }, 3000);
                        },
                        error: function(response) {
                            console.log(response);
                        },
                    });
                });
            }
            // call function for submission data of every form -------------------8888888888888888----------------
            handleFormSubmission("#basicForm", "{{ url('employee/store') }}");
            handleFormSubmission("#addressForm", "{{ url('employee/address') }}");
            handleFormSubmission("#imageForm", "{{ url('employee/profile-image') }}");
            handleFormSubmission("#academicForm", "{{ url('employee/academic-info') }}");
            handleFormSubmission("#employmentForm", "{{ url('employee/employment-info') }}");
            handleFormSubmission("#professionalForm", "{{ url('employee/professional-info') }}");
            handleFormSubmission("#trainingForm", "{{ url('employee/training-info') }}");
            handleFormSubmission("#othersForm", "{{ url('employee/others-info') }}");
            handleFormSubmission("#familyForm", "{{ url('employee/family-info') }}");
            handleFormSubmission("#nomineeForm", "{{ url('employee/nominee-info') }}");
            handleFormSubmission("#salaryForm", "{{ url('employee/salary-info') }}");
            handleFormSubmission("#promotionForm", "{{ url('employee/promotion-info') }}");


            function updateDesignationSelect(selectElement, label_id) {
                if (label_id != '') {
                    $.ajax({
                        url: "{{ url('designation/get-designation') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            label: label_id,
                        },
                        success: function(data) {
                            selectElement.empty();
                            $(`<option value="">Choose...</option>`).appendTo(selectElement);
                            $.each(data, function(key, value) {
                                selectElement.append(
                                    `<option value="${value.id}">${value.designation}</option>`
                                );
                            });
                        }
                    });
                }
            }

            $('#present_des_label').on('change', function() {
                var label_id = $(this).val();
                updateDesignationSelect($("#present_designation"), label_id);
            });

            $('#joining_des_label').on('change', function() {
                var label_id = $(this).val();
                updateDesignationSelect($("#joining_designation"), label_id);
            });

            // dropdown value search -----------------888888888888---------------
            $('.designation').select2();

            // calculation date age---------------------888888888888888888888888888--------------------------------------------------
            function calculateAndDisplayAge(dateFieldId, ageFieldId) {
                $(dateFieldId).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0",
                    maxDate: new Date(),
                    inline: true,

                    onSelect: function() {
                        var Day = $(dateFieldId).val();
                        var date = new Date(Day);
                        var today = new Date();
                        const ageInMillis = today - date;
                        const ageDate = new Date(ageInMillis);
                        const years = ageDate.getUTCFullYear() - 1970;
                        const months = ageDate.getUTCMonth();
                        const days = ageDate.getUTCDate() - 1;
                        var ageTotal = years + " Y," + months + " M," + days + " D";
                        $(ageFieldId).val(ageTotal);
                    }
                });
            }
            calculateAndDisplayAge("#joining_date", "#joining_age");
            calculateAndDisplayAge(".dob", ".age");
            calculateAndDisplayAge("#present_joining_date", "#present_joining_age");
            calculateAndDisplayAge(".family_dob", ".family_age");

            function initializeDatepicker() {
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-70:+50",
                });
            }
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-70:+50",
            });

            // double click to open employe search modal ---------------------------888888888888888------------------
            $("#employee_gid").on("dblclick", function() {
                document.querySelector('#reject_modal').style.display = 'block';
            });

            $('.close').on('click', function() {
                document.querySelector('#reject_modal').style.display = 'none';
            });

            function dataInsertInForm(response) {
                console.log(response);
                $("#employee_gid").val(response.employee_gid);
                $("#full_name").val(response.full_name);
                $("#full_name_bn").val(response.full_name_bn);
                $("#father_name").val(response.father_name);
                $("#father_name_bn").val(response.father_name_bn);
                $("#salary_grade").val(response.salary_grade);
                $("#pay_step").val(response.pay_step);
                if (response.joining_des_label)
                    $("#joining_des_label").val(response.joining_des_label.id).change();
                $("#joining_date").val(response.joining_date);
                $("#joining_age").val(response.joining_age);
                $("#present_joining_date").val(response.present_joining_date);
                $("#present_joining_age").val(response.present_joining_age);
                $("#appraisal_category_id").val(response.appraisal_category_id).change();
                $("#dob").val(response.dob);
                $("#today_age").val(response.today_age);
                $("#spouse_name").val(response.spouse_name);
                $("#spouse_name_bn").val(response.spouse_name_bn);
                $("#telephone_no").val(response.telephone_no);
                $("#national_id").val(response.national_id);
                $("#tin_no").val(response.tin_no);
                $("#gender").val(response.gender_id);
                $("#type").val(response.type_id).change();
                $("#status").val(response.status_id).change();
                $("#status_date").val(response.status_date);
                if (response.branch)
                    $("#branch_id").val(response.branch.id).change();
                if (response.present_des_label) {
                    $("#present_des_label").val(response.present_des_label.id).change();
                }
                if (response.joining_designation) {
                    $.ajax({
                        url: "{{ url('designation/get-designation') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            label: response.joining_des_label.id,
                        },
                        success: function(data) {
                            $("#joining_designation").empty();
                            setTimeout(function() {
                                $.each(data, function(index, item) {
                                    var option = '<option value="' + item.id + '"';
                                    if (item.id === response.joining_designation.id) {
                                        option += 'selected';
                                    }
                                    option += '>' + item.designation + '</option>';
                                    $("#joining_designation").append(option);
                                });
                            }, 1000);

                        }
                    });
                }
                $("#joining_age").val(response.joining_age);
                $("#today_age").val(response.today_age);
                $("#spouse_occupation").val(response.spouse_occupation);
                $("#mobile_no").val(response.mobile_no);
                $("#passport_no").val(response.passport_no);
                $("#mother_name").val(response.mother_name);
                $("#mother_name_bn").val(response.mother_name_bn);
                if (response.present_designation) {
                    $.ajax({
                        url: "{{ url('designation/get-designation') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            label: response.present_des_label.id,
                        },
                        success: function(data) {
                            $("#present_designation").empty();
                            setTimeout(function() {
                                $.each(data, function(index, item) {
                                    var option = '<option value="' + item.id + '"';
                                    if (item.id === response.present_designation.id) {
                                        option += 'selected';
                                    }
                                    option += '>' + item.designation + '</option>';
                                    $("#present_designation").append(option);
                                });
                            }, 1000);
                        }
                    });
                }
                $("#nationality").val(response.nationality);
                if (response.religion)
                    $("#religion").val(response.religion.id).change();
                if (response.marital_status)
                    $("#marital_status").val(response.marital_status.id).change();
                // $("#spouse_nationality").val(response.spouse_nationality);
                $("#alt_mobile_no").val(response.alt_mobile_no);
                if (response.blood_group)
                    $("#blood_group").val(response.blood_group.id);
                // address
                $(".employee_id").val(response.id);
                if (response.address) {
                    $("#present_house").val(response.address.present_house);
                    $("#present_house_bn").val(response.address.present_house_bn);
                    $("#present_post_off").val(response.address.present_post_off);
                    $("#present_post_off_bn").val(response.address.present_post_off_bn);
                    $("#present_road_no").val(response.address.present_road_no);
                    $("#present_road_no_bn").val(response.address.present_road_no_bn);
                    $("#present_district").val(response.address.present_district);
                    $("#present_district_bn").val(response.address.present_district_bn);
                    $("#permanent_village").val(response.address.permanent_village);
                    $("#permanent_village_bn").val(response.address.permanent_village_bn);
                    $("#permanent_post_off").val(response.address.permanent_post_off);
                    $("#permanent_post_off_bn").val(response.address.permanent_post_off_bn);
                    $("#permanent_police_station").val(response.address.permanent_police_station);
                    $("#permanent_police_station_bn").val(response.address.permanent_police_station_bn);
                    $("#permanent_district").val(response.address.permanent_district);
                    $("#permanent_district_bn").val(response.address.permanent_district_bn);
                }
                // image
                if (response.attachment) {
                    var imagePath = baseUrl + '/' + response.attachment.file_path;
                    $('#output').attr('src', imagePath);
                    $('#output').on('error', function() {
                        $('#output').replaceWith(
                            '<p>Image not available</p>'); // Replace with an error message
                    });
                }
                // others
                if (response.others) {
                    $("#language").val(response.others.language);
                    $("#mother_tongue").val(response.others.mother_tongue);
                    $("#skill").val(response.others.skill);
                }
                // academy
                let academydata;
                response.academy.forEach((data, index) => {
                    $('#academic_form_count').val(index);
                    const attachmentHTML = generateImagePreviewAndDownloadLinks(data.attachments, index);
                    getDegreeData(data, function(selectOptions) {
                        var selectOptions = `
                                            <td>
                                                <select class="form-select-sm form-select degree" name="addmore[${index}][degree_id]">
                                                    ${selectOptions}
                                                </select>
                                            </td>`;


                        academydata += `<tr>
                                            ` + selectOptions + `
                                            <td><input type="text" name="addmore[` + index + `][institute]"
                                                    class="form-control form-control-sm"  value="` + data.institute + `" /></td>
                                            <td><input type="text" name="addmore[` + index + `][pass_yr]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                            .pass_yr + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][grade]"
                                                    class="form-control form-control-sm" value="` + data.grade + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][discipline]"
                                                    class="form-control form-control-sm" value="` + data.discipline + `"/></td>
                                            <td>${attachmentHTML}
                                                <input type="hidden" name="addmore[${index}][id]" value="${data.id}" />
                                                </td>
                                            <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;
                        // Check if this is the last iteration before updating the table
                        if (index === response.academy.length - 1) {
                            $('#dynamicTable tbody').html(academydata);
                        }
                    });
                });

                let employmentdata = '';
                response.employment.forEach((data, index) => {
                    $('#employment_form_count').val(index);
                    const attachmentHTML = generateImagePreviewAndDownloadLinks(data.attachments, index);
                    employmentdata += ` <tr>
                                            <td><input type="text" name="addmore[` + index + `][org_name]"
                                                    class="form-control form-control-sm" value="` + data.org_name + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][org_address]"
                                                    class="form-control form-control-sm" value="` + data.org_address + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][last_position]"
                                                    class="form-control form-control-sm" value="` + data
                        .last_position + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][service_from]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .service_from + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][service_to]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .service_to + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][separation]"
                                                    class="form-control form-control-sm" value="` + data.separation + `"/></td>
                                            <td>${attachmentHTML}
                                                <input type="hidden" name="addmore[${index}][id]" value="${data.id}" />
                                                </td>
                                            <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;
                })
                $('#employmentTable tbody').html(employmentdata);
                // profession
                let professiondata = '';
                response.profession.forEach((data, index) => {
                    $('#professional_form_count').val(index);
                    const attachmentHTML = generateImagePreviewAndDownloadLinks(data.attachments, index);
                    professiondata += `<tr>
                                            <td><input type="text" name="addmore[` + index + `][degree]"
                                                    class="form-control form-control-sm" value="` + data.degree + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][institute]"
                                                    class="form-control form-control-sm" value="` + data.institute + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][duration_from]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .duration_from + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][duration_to]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .duration_to + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][grade]"
                                                    class="form-control form-control-sm" value="` + data.grade + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][area]"
                                                    class="form-control form-control-sm" value="` + data.area + `"/></td>
                                            <td>${attachmentHTML}
                                                <input type="hidden" name="addmore[${index}][id]" value="${data.id}" />
                                                </td>
                                            <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;
                })
                $('#professionalForm tbody').html(professiondata);
                // training
                let trainingdata = '';
                response.training.forEach((data, index) => {
                    $('#training_form_count').val(index);
                    const attachmentHTML = generateImagePreviewAndDownloadLinks(data.attachments, index);
                    trainingdata += `<tr>
                                            <td><input type="text" name="addmore[` + index + `][training]"
                                                    class="form-control form-control-sm" value="` + data.training + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][institute]"
                                                    class="form-control form-control-sm" value="` + data.institute + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][org_by]"
                                                    class="form-control form-control-sm" value="` + data.org_by + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][topic]"
                                                    class="form-control form-control-sm" value="` + data.topic + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][duration_from]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .duration_from + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][duration_to]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .duration_to + `"/></td>
                        <td>${attachmentHTML}
                                                <input type="hidden" name="addmore[${index}][id]" value="${data.id}" />
                                                </td>
                                            <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;
                })
                $('#trainingTable tbody').html(trainingdata);
                // family
                let familydata = '';
                response.family.forEach((data, index) => {
                    $('#family_form_count').val(index);
                    const attachmentHTML = generateImagePreviewAndDownloadLinks(data.attachments, index);
                    familydata += `<tr>
                                            <td><input type="text" name="addmore[` + index + `][name]"
                                                    class="form-control form-control-sm" value="` + data.name + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][dob]"
                                                    class="form-control form-control-sm dob" value="` + data.dob + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][age]"
                                                    class="form-control form-control-sm age" value="` + data.age + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][relation]"
                                                    class="form-control form-control-sm" value="` + data.relation + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][occupation]"
                                                    class="form-control form-control-sm" value="` + data.occupation + `"/></td>
                                            <td>
                                                <input type="hidden" name="addmore[${index}][id]" value="${data.id}" />
                                                </td>
                                        <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;
                })
                $('#familyTable tbody').html(familydata);
                // nominee
                let nomineedata = '';
                response.nominee.forEach((data, index) => {
                    $('#nominee_form_count').val(index);
                    nomineedata += `<tr>
                                            <td><input type="text" name="addmore[` + index + `][name]"
                                                    class="form-control form-control-sm" value="` + data.name + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][dob]"
                                                    class="form-control form-control-sm datepicker" value="` + data
                        .dob + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][relation]"
                                                    class="form-control form-control-sm" value="` + data.relation + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][occupation]"
                                                    class="form-control form-control-sm" value="` + data.occupation + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][address]"
                                                    class="form-control form-control-sm" value="` + data.address + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][amount]"
                                                    class="form-control form-control-sm" multiple value="` + data
                        .amount + `"/></td>
                                            <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;
                })
                $('#nomineeTable tbody').html(nomineedata);

                // salary
                if (response.salary) {
                    $("#salary_grade").val(response.salary.salary_grade);
                    $("#basic_salary").val(response.salary.basic_salary);
                    $("#conveyance").val(response.salary.conveyance);
                    $("#arban_allowance").val(response.salary.arban_allowance);
                    $("#pay_step").val(response.salary.pay_step);
                    $("#house_rent").val(response.salary.house_rent);
                    $("#medical_allowance").val(response.salary.medical_allowance);
                    $("#note").val(response.salary.note);
                }

                // promotion
                let promotion;
                response.promotions.forEach((data, index) => {
                    $('#promotion_form_count').val(index);
                    getDesignation(data, function(selectOptions) {
                        var selectOptions = `
                                            <td>
                                                <select class="form-select-sm form-select degree" name="addmore[${index}][designation_id]">
                                                    ${selectOptions}
                                                </select>
                                            </td>`;


                        promotion += `<tr>
                                            ` + selectOptions + `
                                            <td><input type="text" name="addmore[` + index + `][effective_date]"
                                                    class="form-control form-control-sm datepicker"  value="` + data
                            .effective_date + `" /></td>
                                            <td><input type="text" name="addmore[` + index + `][salary]"
                                                    class="form-control form-control-sm" value="` + data
                            .salary + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][salary_grade]"
                                                    class="form-control form-control-sm" value="` + data.salary_grade + `"/></td>
                                            <td><input type="text" name="addmore[` + index + `][pay_step]"
                                                    class="form-control form-control-sm" value="` + data.pay_step + `"/>
                                                    <input type="hidden" name="addmore[${index}][id]" value="${data.id}" /></td>
                                            <td><button type="button" class="btn btn-danger remove-tr" style="line-height:0.5"><i
                                                        class="fas fa-trash nav-icon"></i></button></td>
                                        </tr>`;

                        // Check if this is the last iteration before updating the table
                        if (index === response.promotions.length - 1) {
                            $('#promotionTable tbody').html(promotion);
                        }
                        initializeDatepicker();
                    });
                });
            }
            // edit employe function--------------------88888888888888878888888888-----------------
            function editEmployee(employeeId) {
                $.ajax({
                    url: "{{ url('employee/edit') }}/" + employeeId,
                    type: "GET",
                    success: function(response) {
                        document.querySelector('#reject_modal').style.display = 'none';
                        dataInsertInForm(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while processing the request:", error);
                    }
                });
            }
            $(document).on('click', '.edit-button', function() {
                const employeeId = $(this).data('employee-id');
                editEmployee(employeeId);
            });

            function fill_datatable(search_by = '', search_value = '', branch_id = '', category = '') {
                $.ajax({
                    url: "{{ url('employee/search') }}",
                    data: {
                        search_by: search_by,
                        search_value: search_value,
                        branch_id: branch_id,
                        category: category,
                    },
                    success: function(data) {
                        var res = '';
                        $.each(data, function(key, value) {
                            console.log(value);
                            res +=
                                '<tr>' +
                                '<td>' + (key + 1) + '</td>' +
                                '<td>' + value.branch.name + '(' + value.branch.code + ')' +
                                '</td>' +
                                '<td>' + value.employee_gid + '</td>' +
                                '<td>' + value.full_name + '</td>' +
                                '<td>' + (value.appraisal_category ? value.appraisal_category
                                    .name : '') + '</td>' +
                                '<td>' + (value.mobile_no ? value.mobile_no : '') + '</td>' +
                                '<td>' +
                                '<button style="background:green;margin-right:5px; padding: 0 10px;" class="edit-button" data-employee-id="' +
                                value.id +
                                '">Edit</button><a href="{{ url('employee/delete') }}/' + value
                                .id +
                                '" style="background:red;margin-right:5px; color:white; padding: 2px 10px;" class="delete-button" data-employee-id="">Separate</a>' +
                                '</td>' +
                                '</tr>';
                        });

                        $('#myTable tbody').html(res);
                    },
                });
            }
            fill_datatable(); //call search function----------

            // search employee data----------------------88888888888888888888888888----------------
            $('#search').click(function() {
                event.preventDefault();
                var search_by = $('#searchBy').val();
                var search_value = $('#search_value').val();
                var branch_id = $('#branch_modal').val();
                var category = $('#category_modal').val();
                if (search_by == "null") {
                    $('#myTable').DataTable().destroy();
                    fill_datatable();
                } else {
                    $('#myTable').DataTable().destroy();
                    fill_datatable(search_by, search_value, branch_id, category);
                }
            });
        });

        // image preview work--------------------888888888888888888888888--------------------------
        function displayImages(input) {
            const imagePreviewContainer = input.parentElement.nextElementSibling.querySelector(
                '.image-preview');
            imagePreviewContainer.innerHTML = ''; // Clear previous previews

            const files = input.files;
            for (let i = 0; i < files.length; i++) {
                const image = document.createElement('img');
                image.height = 30;
                image.width = 30;
                image.height = 30;
                image.src = window.URL.createObjectURL(files[i]);

                const downloadLink = document.createElement('a');
                downloadLink.href = image.src;
                downloadLink.download = `image_${i + 1}.jpg`;
                downloadLink.appendChild(image);

                imagePreviewContainer.appendChild(downloadLink);
            }
        }
    </script>
@endsection
