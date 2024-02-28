@extends('layouts.app')
<!-- DataTables CSS -->
@section('content')
<!-- Add Select2 CSS -->
@include('links.css.select2.select2')
<div class="wrapper">
   <div class="container-fluid">
      <!-- Page-Title -->
      <div class="row">
         <div class="col-sm-12">
            <div class="page-title-box">
               <div class="btn-group float-right">
                  <ol class="breadcrumb hide-phone p-0 m-0">
                     <li class="breadcrumb-item"><a href="{{ route('home') }}">Auromics</a></li>
                     <li class="breadcrumb-item"><a
                        href="{{ route('job_allocation.delivery_challan.index') }}">Job Allocation</a>
                     </li>
                     <li class="breadcrumb-item">Edit</li>
                  </ol>
               </div>
               <h4 class="page-title">Edit Job Received</h4>
            </div>
         </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
         <div class="col-12">
            <div class="card m-b-30">
               <div class="card-body">
                  <div class="m-b-30">
                     <form action="{{ route('job_allocation.job_received.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                    <input type="hidden" name="job_giving_id" value="{{ $id }}">
                        <div class="form-group row">
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Employee Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->employee->employee_name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Employee Code
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->employee->employee_code }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Customer Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->order_details->customer->customer_name}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Model Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->model_name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Model Code
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->model_code}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Product
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->product->name}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           R.M Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->rawMaterial->rawMaterialType->name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           R.M Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->rawMaterial->name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Wages of 1 Product
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->wages_product }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Quantity
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->order_details->quantity}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Product Size
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->product_model->productSize->name}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Product Color
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $Job_Giving->order_details->productColor->name}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Received Date
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly value="{{ $received_date }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           
                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                           Incentive Applicable
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="Incentive_status"
                                 id="Incentive_status">
                                 <option value="Yes">Yes</option>
                                 <option value="No">No</option>
                              </select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Receiving Date
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="receiving_date"
                                 id="receiving_date" required="">
                              @error('order_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Status
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="received_status"
                                 id="received_status">
                                 {{-- @foreach ($job_received_data as $item)
                                 <option value="{{ $item->id }}">{{ $item->status }}</option>
                                 @endforeach --}}
                                 {{-- {{ $job_received_data->status }} --}}
                                 <option value="Incomplete">Incomplete</option>
                                 <option value="Complete">Complete</option>
                                 <option value="Pending">Pending</option>
                              </select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="d-flex justify-content-evenly">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit
                              </button>
                              <a href="{{ route('job_allocation.job_received.index') }}"
                                 class="btn btn-secondary waves-effect m-l-5">
                              Cancel
                              </a>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('links.js.select2.select2')
<script>
   $(document).ready(function() {
       $('#with_dc').change(function() {
           if (this.checked) {
               $('#dc_number').prop('disabled', false);
           } else {
               $('#dc_number').prop('disabled', true);
           }
       });
   });
</script>
@endsection