 <div class="m-3">
     <h6>Filter</h6>
     <form method="GET" action="{{ url('appraisal/search') }}" id="report_form" autocomplete="off">
         <input type="hidden" id="employee_id" name="employee_id">
         <div class="row">
             <div class="col-md-2">
                 <div class="mb-1">
                     <label for="branch" class=" col-form-label col-form-label-md">User</label>
                     <div class="">
                         <select class="form-select-md form-select designation" id="branch" name="branch">
                         </select>
                     </div>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="mb-1">
                     <label for="category" class="col-form-label col-form-label-md">From Date</label>
                     <div>
                         <div class="">
                             <input type="text" id="year" name="year"
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
                             <input type="text" id="year" name="year"
                                 class="form-control form-control-md datepicker" />
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-2">
                 <div class="mb-1 ">
                     <label for="status" class=" col-form-label col-form-label-md">Status <span
                             class="important_field">*</span></label>
                     <div class="">
                         <select class="form-select-md form-select" id="status" name="status">
                             <option selected value="">Choose...</option>s
                             <option value="pending">Pending</option>
                             <option value="approved">Approved</option>
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
