 <div class="m-3">
     <h6>Filter</h6>
     <form method="POST" action="{{ url('user/filter') }}" id="filter" autocomplete="off">
         @csrf
         <div class="row">
             <div class="col-md-2">
                 <div class="mb-1">
                     <label for="branch" class=" col-form-label col-form-label-md">User</label>
                     <div class="">
                         <select class="form-select-md form-select selectTo" id="user_id" name="user_id">
                             <option selected value="">Select...</option>
                             @if (isset($filter_user))
                                 @foreach ($filter_user as $user)
                                     <option value="{{ $user->id }}">
                                         {{ $user->name }}({{ $user->master_id }})
                                     </option>
                                 @endforeach
                             @endif
                         </select>
                     </div>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="mb-1">
                     <label for="category" class="col-form-label col-form-label-md">From Date</label>
                     <div>
                         <div class="">
                             <input type="text" id="from_date" name="from_date"
                                 class="form-control form-control-md datepicker" />
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="mb-1">
                     <label for="category" class="col-form-label col-form-label-md">To Date</label>
                     <div>
                         <div class="">
                             <input type="text" id="to_date" name="to_date"
                                 class="form-control form-control-md datepicker" />
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="mb-1 ">
                     <label for="status" class=" col-form-label col-form-label-md">Status</label>
                     <div class="">
                         <select class="form-select-md form-select" id="status" name="status">
                             <option selected value="">Select...</option>
                             <option value="active">Active</option>
                             <option value="inactive">Inactive</option>
                             <option value="pending">Pending</option>
                         </select>
                     </div>
                 </div>
             </div>
             <div class="col-md-2 mt-3">
                 <button type="submit" class="btn btn-warning mt-4">Filter</button>
             </div>
         </div>
     </form>
 </div>
