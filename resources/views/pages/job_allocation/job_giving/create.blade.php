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
                        href="">Job Allocation</a>
                     </li>
                     <li class="breadcrumb-item"><a
                        href="">Job Giving</a>
                     </li>
                     <li class="breadcrumb-item">Create</li>
                  </ol>
               </div>
               <h4 class="page-title">Create Job Giving</h4>
            </div>
         </div>
      </div>
      <!-- end page title end breadcrumb -->
      <div class="row">
         <div class="col-12">
            <div class="card m-b-30">
               <div class="card-body">
                  <div class="m-b-30">
                     <form action="{{route('job_allocation.job_giving.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                           <label for="employee_id" class="col-sm-2 col-form-label mandatory">
                           Employee Name
                           </label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="employee_id" id="employee_id">
                                 <option value="">Select Employee</option>
                                 @foreach ($employee as $item)
                                 <option value="{{ $item->id }}" 
                                    data-company-name="{{ $item->company->company_name }}" 
                                    data-company-type="{{ $item->company->companyType->name }}">
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
                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">Order
                           ID</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="order_id" id="order_id" onchange="fetchQuantities()">
    <option value="">Select Order</option>
    @foreach ($order_details as $item)
        <option value="{{ $item->id }}">
            {{ $item->order_no }}
        </option>
    @endforeach
</select>
                              @error('order_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label ">Order
                           Date</label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="order_date" id="order_date" readonly>
                              @error('order_date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="customer_code" class="col-sm-2 col-form-label ">Customer Name</label>
                           <div class="col-sm-4 mb-4">
                              <input type="text" class="form-control" name="customer_name" id="customer_name" readonly>
                              @error('customer_name')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Total Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="total_quantity" id="total_quantity" readonly>
    @error('order_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="order_date" class="col-sm-2 col-form-label">Available Quantity</label>
<div class="col-sm-4 mb-4">
    <input class="form-control" type="text" name="available_quantity" id="available_quantity" readonly>
    @error('order_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">Model</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="product_model_id" id="product_model_id">
                                 <option value="">Select Model</option>
                                 @foreach($productModels as $productModel)
                                 <option value="{{ $productModel->id }}" >{{ $productModel->model_name }}-{{ $productModel->model_code }}</option>
                                 @endforeach
                              </select>
                              @error('product_model_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Product Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="product" id="product" readonly>
                              @error('product_id')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label ">Raw Material Name</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="raw_material_name" id="raw_material_name" readonly>
                              @error('raw_material')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Raw Material Type</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="raw_material_type" id="raw_material_type" readonly>
                              @error('raw_material_type')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">date</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="date" name="date" id="date">
                              @error('date')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                           <label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
                           <div class="col-sm-4 mb-4">
                              <input class="form-control" type="text" name="quantity" id="quantity">
                              @error('quantity')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                    <label for="customer_name" class="col-sm-2 col-form-label">DC Number</label>
<div class="col-sm-4 mb-4">
    <select class="form-control select2" name="dc_number" id="dc_number">
        <option value="">Select DC</option>
        @foreach ($delivery_challan as $item)
            <option value="{{ $item->id}}">{{ $item->dc_no }}</option>
        @endforeach
    </select>
    @error('dc_number')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

                           <label for="customer_code" class="col-sm-2 col-form-label mandatory">Status</label>
                           <div class="col-sm-4 mb-4">
                              <select class="form-control select2" name="status" id="status">
                                 <option value="">Select Status</option>
                                 <option value="Incomplete">Incomplete</option>
                                 <option value="Complete">Complete</option>
                                 <option value="Pending">Pending</option>
                                 <option value="cancelled">Cancelled</option>
                              </select>
                              @error('status')
                              <span class="error" style="color: red;">{{ $message }}</span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="d-flex justify-content-evenly">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit
                              </button>
                              <a href="{{ route('job_allocation.job_giving.create') }}"
                                 class="btn btn-warning waves-effect waves-light">
                              Reset
                              </a>
                              <a href="{{ route('job_allocation.job_giving.index') }}"
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
       $('#order_id').on('change', function() {
           var orderId = $(this).val();
           if (orderId) {
               $.ajax({
                   url: '/job_allocation/job_giving/get-order-details/' + orderId,
                   type: 'GET',
                   dataType: 'json',
                   success: function(data) {
                       if (data) {
                           $('#order_date').val(data.order_date);
                      
                           $('#customer_name').val(data.customer_name);
                       } else {
                           $('#order_date').val('');
                            
                           $('#customer_name').val('');
                       }
                   }
               });
           } else {
               $('#order_date').val('');
               $('#customer_name').val('');
           }
       });
   });
</script>
<script>
   $(document).ready(function() {
       $('#product_model_id').change(function() {
           var modelId = $(this).val();
           if (modelId) {
               $.ajax({
                   url: '/job_allocation/job_giving/get-model-details/' + modelId,
                   type: "GET",
                   dataType: "json",
                   success: function(data) {
                       $('#product').val(data.product_name);
                       $('#raw_material_name').val(data.raw_material_name);
                       $('#raw_material_type').val(data.raw_material_type);
                   }
               });
           }
       });
   });
</script>

<script>
    function fetchQuantities() {
        var orderId = document.getElementById('order_id').value;
        if (orderId !== '') {
            // Make an AJAX request to fetch quantities
            fetch(`/job_allocation/job_giving/getQuantities/${orderId}`)
            .then(response => response.json())
            .then(data => {
                // Update input fields with fetched quantities
                document.getElementById('total_quantity').value = data.total_quantity;
                document.getElementById('available_quantity').value = data.available_quantity;
            })
            .catch(error => console.error('Error:', error));
        } else {
            // Reset input fields if no order is selected
            document.getElementById('total_quantity').value = '';
            document.getElementById('available_quantity').value = '';
        }
    }
</script>

@endsection