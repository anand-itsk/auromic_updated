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
               <h4 class="page-title">Edit Job Reallocation</h4>
            </div>
         </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
         <div class="col-12">
            <div class="card m-b-30">
               <div class="card-body">
                  <div class="m-b-30">
                     <form action="{{ route('job_allocation.job_reallocation.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_giving_id" value="{{ $id }}">
                        <h5 class="text-primary">Job Received Pending Data</h5>
                        
                        <div class="form-group row">
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Employee Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->employee->employee_name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Employee Code
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->employee->employee_code }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Customer Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->order_details->customer->customer_name}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Model Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->model_name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Model Code
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->model_code}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Product
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->product->name}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           R.M Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->rawMaterial->rawMaterialType->name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           R.M Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->rawMaterial->name }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Wages of 1 Product
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->wages_product }}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
    Total Quantity
</label>
<div class="col-sm-4 mb-4">
    <input type="text" class="form-control" name="total_quantity" id="total_quantity" readonly value="{{ $Job_Giving->quantity }}">
    @error('employee_id')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="customer_code" class="col-sm-2 col-form-label">
    Complete Quantity
</label>
<div class="col-sm-4 mb-4">
    <input type="text" class="form-control" name="complete_quantity" id="complete_quantity" readonly value="{{ $jobReceivedData->complete_quantity ?? '' }}">
    @error('employee_id')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="customer_code" class="col-sm-2 col-form-label">
    Balance Quantity
</label>
<div class="col-sm-4 mb-4">
    <input type="text" class="form-control" name="available_quantity" id="available_quantity" readonly value="">
    @error('employee_id')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Product Size
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->product_model->productSize->name ?? ''}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Product Color
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{ $Job_Giving->order_details->productColor->name ??''}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">
                           Received Date
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="" id="" readonly value="{{$jobReceivedData->receving_date??''}}">
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           
                           
                        </div>

                        <!-- reallocation Starts -->
                                             <hr />
                                    
                                    <h5 class="text-primary">Job Reallocation</h5>
                                     <div class="form-group row">
                                       <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                           Employee
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="employee_id" id="employee_id">
                                 <option value="">Select Employee</option>
                                 @foreach ($employee as $item)
                                 <option value="{{ $item->id }}" 
                                    data-company-name="{{ $item->company->company_name ??''}}/{{ $item->company->authorisedPerson->name ??''}}" 
                                    data-company-type="{{ $item->company->companyType->name ?? ''}}">
                                    {{ $item->employee_code }}/{{ $item->employee_name }}
                                 </option>
                                 @endforeach
                              </select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_type" class="col-sm-2 col-form-label">
                           Company Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_type" id="company_type" readonly>
                              @error('company_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_name" class="col-sm-2 col-form-label">
                           Company Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_name" id="company_name" readonly>
                              @error('company_name')
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
                           Quantity
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="quantity" id="quantity">
                              <span id="quantity-error" class="error" style="color: red; display: none;"></span>
    @error('quantity')
                              
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>

</div>
                        <!-- reallocation Ends -->
                        <div class="form-group">
                           <div class="d-flex justify-content-evenly">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit
                              </button>
                              <a href="{{ route('job_allocation.job_reallocation.index') }}"
                                 class="btn btn-secondary waves-effect m-l-5">
                              Back
                              </a>

                              <a href="{{ route('job_allocation.job_reallocation.cancel_job_giving', ['id' => $id]) }}" class="btn btn-danger waves-effect m-l-5">
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
<script>
   $(document).ready(function() {
       $('#employee_id').change(function() {
           var companyName = $(this).find(':selected').data('company-name');
           var companyType = $(this).find(':selected').data('company-type');
           $('#company_name').val(companyName);
           $('#company_type').val(companyType);
       });
   });
</script>

<script>
    // Get references to the input elements
    const totalQuantityInput = document.getElementById('total_quantity');
    const completeQuantityInput = document.getElementById('complete_quantity');
    const balanceQuantityInput = document.getElementById('available_quantity');

    // Function to calculate and update balance quantity
    function updateBalanceQuantity() {
        const totalQuantity = parseFloat(totalQuantityInput.value) || 0;
        const completeQuantity = parseFloat(completeQuantityInput.value) || 0;
        const balanceQuantity = totalQuantity - completeQuantity;
        balanceQuantityInput.value = balanceQuantity;
    }

    // Add event listeners to update balance quantity when inputs change
    totalQuantityInput.addEventListener('input', updateBalanceQuantity);
    completeQuantityInput.addEventListener('input', updateBalanceQuantity);

    // Initial calculation on page load
    updateBalanceQuantity();
</script>

<script>
    $(document).ready(function() {
        $('#quantity').on('input', function() {
            var quantity = $(this).val();
            var availableQuantity = $('#available_quantity').val();
            
            if (parseInt(quantity) > parseInt(availableQuantity)) {
                $('#quantity-error').text('Quantity cannot exceed available balance quantity.');
                $('#quantity-error').show();
               //  $(this).val(''); // Clear the input field
            } else {
                $('#quantity-error').hide();
            }
        });
    });
</script>
@endsection