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
                     <li class="breadcrumb-item"><a href="{{ route('job_allocation.direct_job_giving.index') }}">Direct Job Giving</a>
                     </li>
                     <li class="breadcrumb-item">Edit</li>
                  </ol>
               </div>
               <h4 class="page-title">Edit Direct Job received</h4>
            </div>
         </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
         <div class="col-12">
            <div class="card m-b-30">
               <div class="card-body">
                  <div class="m-b-30">
                     <form action="{{ route('job_allocation.direct_job_received.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="direct_job_giving_id" value="{{$id}}">
                        <div class="form-group row">
                           <label for="employee_id" class="col-sm-2 col-form-label">
                           Employee Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="employees" id="employees" disabled>
                              @foreach ($employee as $item)
                              <option value="{{ $item->id }}" 
                              data-company-names="{{ $item->company->company_name }}" 
                              data-company-types="{{ $item->company->companyType->name }}"
                              {{ $item->id == $direct_job_giving->employee_id ? 'selected' : '' }}>
                              {{ $item->employee_code }}/{{ $item->employee_name }}
                              </option>
                              @endforeach
                              </select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_type" class="col-sm-2 col-form-label ">
                           Company Type
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_types" id="company_types" readonly>
                              @error('company_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="company_name" class="col-sm-2 col-form-label ">
                           Company Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="company_names" id="company_names" readonly>
                              @error('company_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label class="col-sm-2 col-form-label">Model</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control" name="finishing_product_models_id" id="finishing_product_models_id" disabled>
                              @foreach ($finishingProduct as $finishingProducts)
                              <option value="{{ $finishingProducts->id }}" @if ($finishingProducts->id == $direct_job_giving->finishing_product_models_id) selected @endif>{{ $finishingProducts->model_code }}</option>
                              @endforeach
                              </select>
                              @error('finishing_product_models_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product" id="product" readonly value="{{$finishingProducts->product->name}}">
                              @error('product_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">Product Size</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="product_size_id" id="product_size_id" disabled>
                                 <option value="">Select Product Size</option>
                                 @foreach ($product_size as $item)
                                 <option value="{{ $item->id }}" {{ $item->id == $direct_job_giving->product_size_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                 @endforeach
                              </select>
                              @error('product_size_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label">Product Color</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="product_color_id" id="product_color_id" disabled>
                                 <option value="">Select Product color</option>
                                 @foreach ($product_color as $item)
                                 <option value="{{ $item->id }}" {{ $item->id == $direct_job_giving->product_color_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                 @endforeach
                              </select>
                              @error('product_color_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="quantity" id="quantity" readonly value="{{$direct_job_giving->quantity}}">
                              @error('quantity')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Weight</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="weight" id="weight" readonly value="{{$direct_job_giving->weight}}">
                              @error('weight')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">
                           Employee
                           </label>
                           <div class="col-sm-4 mb-4">
                             <select class="form-control select2" name="employee_id" id="employee_id">
                                 <option value="">Select Employee</option>
                                 @foreach ($employee as $item)
                                 <option value="{{ $item->id }}" 
                                    data-company-name="{{ $item->company->company_name}}/{{ $item->company->authorisedPerson->name}}" 
                                    data-company-type="{{ $item->company->companyType->name}}">
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
                           <label for="company_name" class="col-sm-2 col-form-label ">
                           Company Name
                           </label>
                           <div class="col-sm-4 mb-4">
                             <input type="text" class="form-control" name="company_name" id="company_name" readonly>
                              @error('company_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model</label>
                           <div class="col-sm-4 mb-4">
                                <select class="form-control" name="finishing_product_models_id" id="finishing_product_models">
        <option value="">Select Finishing Model</option>
        @foreach ($finishingProduct as $finishingProducts)
            <option value="{{ $finishingProducts->id}}">{{ $finishingProducts->model_code }}</option>
        @endforeach
    </select>
    @error('finishing_product_models_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product_name" id="products" readonly>

                              @error('product_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Size</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product_size" id="product_sizes" readonly >
                              @error('product_size')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Wages of Product</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="wages_product" id="wages_one_products" readonly >
                              @error('wages_product')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Receiving Date</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="receiving_date"
                                 id="receiving_date" required="">
                              @error('order_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">  Incentive Applicable</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="incentive_applicable"
                                 id="Incentive_status" disabled>
                                  <option value="">Select</option>
                                 <option value="Yes">Yes</option>
                                 <option value="No">No</option>
                              </select>
                              @error('employee_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Color</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="product_color_id" id="product_color_id">
                                 <option value="">Select Product color</option>
                                 @foreach ($product_color as $item)
                                 <option value="{{ $item->id }}">{{ $item->name}}</option>
                                 @endforeach
                              </select>
                              @error('product_color_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>

                           <label for="order_date" id="amount_label" class="col-sm-2 col-form-label ">Amount</label>
                           <div class="col-sm-4 mb-4">
                          <input class="form-control" type="text" name="amount" id="amount">
                              @error('amount')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                        <label for="order_date" id="" class="col-sm-2 col-form-label ">Complete Quantity</label>
                           <div class="col-sm-4 mb-4">
                          <input class="form-control" type="text" name="complete_quantity" id="complete_quantity">
                              @error('complete_quantity')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                          <label for="order_date" class="col-sm-2 col-form-label">Available Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="available_quantity" id="available_quantity">
    @error('available_quantity')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
<label for="order_date" class="col-sm-2 col-form-label">Assign Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="assign_quantity" id="assign_quantity">
    <span id="assign_quantity_error" class="error" style="color: red;"></span>
    @error('assign_quantity')
    <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>
</div>
                        <div class="ml-3 d-flex flex-wrap px-4">
                           <label>
                           <input class="form-check-input" name="Direct_Job_Received_Without_Giving" type="checkbox"
                              value="1" id="Direct_Job_Received_Without_Giving">
                           Direct Job Received Without Giving</label>
                        </div>
                        
                  </div>
                  <div class="form-group">
                  <div class="d-flex justify-content-evenly">
                  <button type="submit" class="btn btn-primary waves-effect waves-light">
                  Submit
                  </button>
                  <a href="{{ route('job_allocation.direct_job_giving.index') }}" class="btn btn-secondary waves-effect m-l-5">
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

<script>
   $('#Direct_Job_Received_Without_Giving').change(function() {
              if (this.checked) {
                
                  $('#Incentive_status').prop('disabled', false);
              } else {
                  
                  $('#Incentive_status').prop('disabled', true);
              }
          });
</script>
<script>
   $(document).ready(function() {
       var companyNames = $('#employees').find(':selected').data('company-names');
       var companyTypes = $('#employees').find(':selected').data('company-types');
       $('#company_names').val(companyNames);
       $('#company_types').val(companyTypes);
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
    $(document).ready(function() {
        $('#finishing_product_models').change(function() {
            var modelId = $(this).val();
            if(modelId) {
                $.ajax({
                    url: '/job_allocation/direct_job_received/get-finishing-product-details/' + modelId,
                    type: 'GET',
                    dataType: 'json',
                    success:function(data) {
                       
                        $('#products').val(data.product_name);
                        $('#product_sizes').val(data.product_size);
                        $('#wages_one_products').val(data.wages_one_product);
                        
                    }
                });
            }
        });
    });
</script>
<script>
   $(document).ready(function() {
      // Initially hide the Amount label and input field
      $('#amount_label, #amount').hide();

      // Listen for changes on the Incentive status dropdown
      $('#Incentive_status').change(function() {
          if ($(this).val() === 'Yes') {
              // If Yes is selected, show the Amount label and input field
              $('#amount_label, #amount').show();
          } else {
              // If any other option is selected, hide the Amount label and input field
              $('#amount_label, #amount').hide();
          }
      });
   });
</script>


<script>
$(document).ready(function(){
    $('#complete_quantity').on('input', function(){
        var completeQuantity = $(this).val();
        var totalQuantity = {{$direct_job_giving->quantity}};
        var availableQuantity = totalQuantity - completeQuantity;
        
        // Update available_quantity value
        $('#available_quantity').val(availableQuantity);

        // Clear available_quantity if complete_quantity is empty
        if (completeQuantity === '') {
            $('#available_quantity').val('');
        }
    });

    $('#available_quantity').on('input', function(){
        var availableQuantity = $(this).val();
        var totalQuantity = {{$direct_job_giving->quantity}};
        var completeQuantity = totalQuantity - availableQuantity;

        // Update complete_quantity value
        $('#complete_quantity').val(completeQuantity);

        // Clear complete_quantity if available_quantity is empty
        if (availableQuantity === '') {
            $('#complete_quantity').val('');
        }
    });
});
</script>

<script>
    $(document).ready(function () {
        $('#assign_quantity').on('input', function () {
            var availableQuantity = parseInt($('#available_quantity').val());
            var assignQuantity = parseInt($(this).val());
            var errorSpan = $('#assign_quantity_error');
            
            if (assignQuantity > availableQuantity) {
                errorSpan.text('Assign quantity cannot exceed available quantity');
            } else {
                errorSpan.text('');
            }
        });
    });
</script>

@include('links.js.select2.select2')
@endsection