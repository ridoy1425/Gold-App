<div id="reject_modal" class="modal">
    <div class="modal-content">
        <div>
            <span class="close">&times;</span>
        </div>
        <div>
            <h6>Employee Search</h6>
            <form id="#" autocomplete="off">
                <div class="row">
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label for="name" class=" col-form-label col-form-label-sm">Search
                                By</label>
                            <div class="">
                                <select class="form-select-sm form-select" id="searchBy" name="searchBy">
                                    <option selected value="all">Choose...</option>
                                    <option value="employee_gid">Employee ID</option>
                                    <option value="full_name">Employee Name</option>
                                    <option value="mobile_no">Employee Phone</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1 ">
                            <label for="name" class=" col-form-label col-form-label-sm">Search Value</label>
                            <div class="">
                                <input type="text" class="form-control form-control-sm" id="search_value"
                                    name="search_value">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="branch_id" class=" col-form-label col-form-label-sm">Select Branch</label>
                        <div class="">
                            <select class="form-select-sm form-select designation" id="branch_modal" name="branch_id">
                                @if (auth()->user()->hasRole('super-admin') ||
                                        auth()->user()->hasRole('admin'))
                                    <option selected value="">Choose...</option>
                                    @if (isset($branches))
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                                @if (isset($evaluator)) {{ $branch->id == $evaluator->branch_id ? 'selected' : '' }} @endif>
                                                {{ $branch->name }}({{ $branch->code }})
                                            </option>
                                        @endforeach
                                    @endif
                                @else
                                    <option selected value="{{ auth()->user()->role->branch_id }}">
                                        {{ auth()->user()->role->branch->name ?? '' }}({{ auth()->user()->role->branch->code ?? '' }})
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1 ">
                            <label for="category" class=" col-form-label col-form-label-sm">Appraisal
                                Category</label>
                            <div class="">
                                <select class="form-select-sm form-select" id="category_modal" name="category">
                                    <option selected value="">Choose...</option>
                                    @if (isset($categories))
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" id="search" class="btn btn-warning mt-4">Search</button>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </form>
        </div>
        <div class="mt-2">
            <input type="hidden" value="" id="double_click_value">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr class="">
                        <th>SL</th>
                        <th>Branch</th>
                        <th>Employe ID</th>
                        <th>Employee Name</th>
                        <th>Apprisal Category</th>
                        <th>Employee Phone</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
