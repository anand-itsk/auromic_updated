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
                  <li class="breadcrumb-item"><a href="{{ route('master.order_detail.index') }}">Order Detail</a>
                  </li>
                  <li class="breadcrumb-item">Create</li>
               </ol>
            </div>
            <h4 class="page-title">Create Order Detail</h4>
         </div>
      </div>
   </div>
   <!-- end page title end breadcrumb -->
   <div class="row">
      <div class="col-12">
         <div class="card m-b-30">
            <div class="card-body">
               <div class="m-b-30">
                  <form action="{{ route('master.order_detail.update',$order_details->id) }}" method="POST">
                     @csrf
                     <div class="form-group row">
                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Oder No</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="order_no" id="order_no" value="{{ $order_details->order_no}}">
                           @error('order_no')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label mandatory">Order Date</label>
                        <div class="col-sm-4 mb-4">
                           <input type="date" class="form-control" name="order_date" id="order_date" value="{{ $order_details->order_date}}">
                           @error('order_date')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label mandatory">Customer</label>
                        <div class="col-sm-4 mb-4">
                           <select class="form-control select2" name="customer_id"
                              id="customer_id" >
                              <option value="">Select Customer</option>
                              @foreach ($customer as $item)
                              <option value="{{ $item->id }}" @if ($order_details->customer_id == $item->id) selected @endif>{{ $item->customer_name }}</option>
                              @endforeach
                           </select>
                           @error('customer_id')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Product</label>
                        <div class="col-sm-4 mb-4">
                           <select class="form-control" name="product" id="product">
                              <option value="">Select Product</option>
                              @foreach($products as $product)
                              <option value="{{ $product->id }}" @if($order_details->productModel->product_id == $product->id) selected @endif>{{ $product->name }}</option>
                              @endforeach
                           </select>
                           @error('product')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Model</label>
                        <div class="col-sm-4 mb-4">
                           <select class="form-control" name="product_model" id="product_model" >
                              <option value="">Select Product Model</option>
                              @foreach($productModels as $productModel)
                              <option value="{{ $productModel->id }}" data-product-id="{{ $productModel->product_id }}" data-wage="{{ $productModel->wages_product }}" data-weight="{{ $productModel->raw_material_weight_item }}" data-raw-material-id="{{ $productModel->raw_material_id }}" data-raw-material-type="{{ $productModel->rawMaterial->rawMaterialType->name ?? '' }}" data-raw-material-name="{{ $productModel->rawMaterial->name }}" @if ($order_details->product_model_id == $productModel->id) selected @endif>{{ $productModel->model_name }}-{{ $productModel->model_code }}</option>
                              @endforeach
                           </select>
                           @error('model_id')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        
                        <label for="raw_material_type" class="col-sm-2 col-form-label">R.M Type</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="raw_material_type" id="raw_material_type" value="{{ $order_details->productModel->rawMaterial->rawMaterialType->name ?? '' }}" readonly>
                           @error('raw_material_type')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label for="raw_material_name" class="col-sm-2 col-form-label ">R.M Name</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="raw_material_name" id="raw_material_name" value="{{ $order_details->productModel->rawMaterial->name }}" readonly>
                           @error('raw_material_name')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label for="raw_material_weight_item" class="col-sm-2 col-form-label">R.M Weight/Item</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="raw_material_weight_item" id="raw_material_weight_item" value="{{ $order_details->productModel->raw_material_weight_item }}" readonly>
                           @error('raw_material_weight_item')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label for="wages_employee" class="col-sm-2 col-form-label">Wages of Employee</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="wages_employee" id="wages_employee"  value="{{ $order_details->productModel->wages_product }}" readonly>
                           @error('wages_employee')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label for="wages_employee" class="col-sm-2 col-form-label ">Quantity</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="quantity" id="quantity"value="{{ $order_details->quantity}}">
                           @error('wages_employee')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Delivery Date</label>
                        <div class="col-sm-4 mb-4">
                           <input type="date" class="form-control" name="delivery_date" id=""value="{{ $order_details->delivery_date}}">
                           @error('delivery_date')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Order Status</label>
                        <div class="col-sm-4 mb-4">
                           <select class="form-control select2" name="order_status_id"
                              id="order_status_id">
                              <option value="">Select Order Status</option>
                              @foreach ($order_status as $item)
                              <option value="{{ $item->id }}" @if ($order_details->order_status_id == $item->id) selected @endif>{{ $item->name }}</option>
                              @endforeach
                           </select>
                           @error('order_status_id')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Product Size</label>
                        <div class="col-sm-4 mb-4">
                           <select class="form-control select2" name="product_size_id"
                              id="product_size_id">
                              <option value="">Select Product Size</option>
                              @foreach ($product_size as $item)
                              <option value="{{ $item->id }}" @if ($order_details->product_size_id == $item->id) selected @endif>{{ $item->name }}</option>
                              @endforeach
                           </select>
                           @error('order_status_id')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Product Color</label>
                        <div class="col-sm-4 mb-4">
                           <select class="form-control select2" name="product_color_id"
                              id="product_color_id">
                              <option value="">Select Product Color</option>
                              @foreach ($product_color as $item)
                              <option value="{{ $item->id }}" @if ($order_details->product_color_id == $item->id) selected @endif>{{ $item->name }}</option>
                              @endforeach
                           </select>
                           @error('product_color_id')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <label for="customer_code" class="col-sm-2 col-form-label ">Total R.M</label>
                        <div class="col-sm-4 mb-4">
                           <input class="form-control" type="text" name="total_raw_material" id="model_code" value="{{ $order_details->total_raw_material}}">
                           @error('total_raw_material')
                           <span class="error" style="color: red;">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <div class="d-flex justify-content-evenly">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit
                              </button>
                              <a href="{{ route('master.product_model.create') }}"
                                 class="btn btn-warning waves-effect waves-light">
                              Reset
                              </a>
                              <a href="{{ route('master.product_model.index') }}"
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
<!-- JavaScript to handle product selection -->
<script>
   document.getElementById('product').addEventListener('change', function() {
       var productId = this.value;
       var productModels = document.getElementById('product_model').getElementsByTagName('option');
       
       for (var i = 0; i < productModels.length; i++) {
           if (productModels[i].getAttribute('data-product-id') === productId || productId === '') {
               productModels[i].style.display = '';
           } else {
               productModels[i].style.display = 'none';
           }
       }
   });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
       const productModelSelect = document.getElementById('product_model');
       const rawMaterialWeightItemInput = document.getElementById('raw_material_weight_item');
       const wagesEmployeeInput = document.getElementById('wages_employee');
        const rawMaterialTypeInput = document.getElementById('raw_material_type');
       const rawMaterialNameInput = document.getElementById('raw_material_name');
       
   
       productModelSelect.addEventListener('change', function() {
           const selectedOption = productModelSelect.options[productModelSelect.selectedIndex];
           const rawMaterialWeight = selectedOption.dataset.weight;
           const wagesEmployee = selectedOption.dataset.wage;
           const rawMaterialType = selectedOption.dataset.rawMaterialType;
           const rawMaterialName = selectedOption.dataset.rawMaterialName;
   
           rawMaterialWeightItemInput.value = rawMaterialWeight;
           wagesEmployeeInput.value = wagesEmployee;
           rawMaterialTypeInput.value = rawMaterialType;
           rawMaterialNameInput.value = rawMaterialName;
       });
   });
</script>
<script>
   $(document).ready(function(){
       $('#product').change(function(){
           $('#product_model').prop('disabled', $(this).val() == '');
       });
   });
</script>
<script>
    $(document).ready(function(){
        $('#product').on('change', function(){
            var productId = $(this).val(); // Get the selected product ID
            // Assuming you have an input field with id 'product_model'
            // You can update the value of the input field with the selected product ID
            $('#product_model').val(productId);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the select elements
        var productSelect = document.getElementById('product');
        var productModelSelect = document.getElementById('product_model');

        // Listen for change event on product model select
        productModelSelect.addEventListener('change', function() {
            // Get the selected option
            var selectedModelOption = productModelSelect.options[productModelSelect.selectedIndex];

            // Get the product id associated with the selected model
            var productId = selectedModelOption.getAttribute('data-product-id');

            // Find the corresponding product option and select it
            for (var i = 0; i < productSelect.options.length; i++) {
                if (productSelect.options[i].value === productId) {
                    productSelect.selectedIndex = i;
                    break;
                }
            }
        });
    });
</script>
@include('links.js.select2.select2')
@endsection