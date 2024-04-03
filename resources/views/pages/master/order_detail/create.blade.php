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
                                <li class="breadcrumb-item"><a href="{{ route('master.order_detail.index') }}">Order
                                        Detail</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create New Order Detail</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('master.order_detail.store') }}" method="POST">
                                    @csrf

                                    <div class="d-flex justify-content-end mb-2">
                                        {{-- <h5 class="text-primary">Company Info</h5> --}}
                                        <button class="btn btn-secondary cancel_btn">
                                            <a href="{{ route('master.order_detail.index') }}" class="text-white">
                                                Cancel
                                            </a>
                                        </button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label mandatory">Order Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="date" class="form-control" name="order_date"
                                                id="order_date"required>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label mandatory">Customer Order No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="customer_order_no"
                                                id="customer_order_no"required>
                                            <div id="customer_order_noError" style="color: red;"></div>
                                            @error('customer_order_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label mandatory">Customer</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="customer_id"
                                                id="customer_id"required>
                                                <option value="">Select Customer</option>
                                                @foreach ($customer as $item)
                                                    <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label class="col-sm-2 col-form-label">Product <a class="shortcut_master"
                                                href="{{ route('product-models.products.create') }}" target="_blank">+</a>
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product" id="product">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label class="col-sm-2 col-form-label">Model <a class="shortcut_master"
                                                href="{{ route('master.product_model.create') }}"
                                                target="_blank">+</a></label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_model" id="product_model"
                                                disabled>
                                                <option value="">Select Product Model</option>
                                                @foreach ($productModels as $productModel)
                                                    <option value="{{ $productModel->id }}"
                                                        data-product-id="{{ $productModel->product_id }}"
                                                        data-wage="{{ $productModel->wages_product }}"
                                                        data-weight="{{ $productModel->raw_material_weight_item }}"
                                                        data-raw-material-id="{{ $productModel->raw_material_id }}"
                                                        data-raw-material-type="{{ $productModel->rawMaterial->rawMaterialType->name ?? '' }}"
                                                        data-raw-material-name="{{ $productModel->rawMaterial->name ?? '' }}"
                                                        data-product-size="{{ $productModel->productSize->name ?? '' }}">
                                                        {{ $productModel->model_name }}-{{ $productModel->model_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('model_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="raw_material_type" class="col-sm-2 col-form-label">R.M Type</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_type"
                                                id="raw_material_type" readonly>
                                            @error('raw_material_type')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="raw_material_name" class="col-sm-2 col-form-label ">R.M Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_name"
                                                id="raw_material_name" readonly>
                                            @error('raw_material_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="raw_material_weight_item" class="col-sm-2 col-form-label">R.M
                                            Weight/Item</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_weight_item"
                                                id="raw_material_weight_item" readonly>
                                            @error('raw_material_weight_item')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="wages_employee" class="col-sm-2 col-form-label ">Wages of
                                            Employee</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="wages_employee"
                                                id="wages_employee" readonly>
                                            @error('wages_employee')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="wages_employee" class="col-sm-2 col-form-label ">Product Size</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="product_size_code"
                                                id="product_size_code" readonly>
                                            <input class="form-control" type="hidden" name="product_size_id"
                                                id="product_size_id" readonly>
                                            @error('product_size')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="wages_employee" class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="quantity" id="quantity">
                                            @error('quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Delivery Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="date" class="form-control" name="delivery_date"
                                                id="">
                                            @error('delivery_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label class="col-sm-2 col-form-label">Product Color
                                            <a class="shortcut_master"
                                                href="{{ route('product-models.product_colors.create') }}"
                                                target="_blank">+</a>
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="product_color_id"
                                                id="product_color_id">
                                                <option value="">Select Product Color</option>
                                                @foreach ($product_color as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_color_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">Total R.M
                                            Weight</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="total_raw_material"
                                                id="total_raw_material" readonly>
                                            @error('total_raw_material')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('master.order_detail.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
                                            <a href="{{ route('master.order_detail.index') }}"
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
        $(document).ready(function() {
            $('#product').change(function() {
                $('#product_model').prop('disabled', $(this).val() == '');
            });
        });
    </script>

    <script>
        // Get the input fields
        var rawMaterialWeightItemInput = document.getElementById('raw_material_weight_item');
        var quantityInput = document.getElementById('quantity');
        var totalRawMaterialInput = document.getElementById('total_raw_material');

        // Add event listener to quantity input field
        quantityInput.addEventListener('input', function() {
            // Get the values from input fields
            var rawMaterialWeightItem = parseFloat(rawMaterialWeightItemInput.value);
            var quantity = parseFloat(quantityInput.value);

            // Calculate the total raw material
            var totalRawMaterial = rawMaterialWeightItem * quantity;

            // Update the total raw material input field with the calculated value
            totalRawMaterialInput.value = isNaN(totalRawMaterial) ? '' : totalRawMaterial.toFixed();
        });
    </script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const orderNo = urlParams.get('orderNo');
        document.getElementById('order_no').value = orderNo;
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let customerOrderField = document.getElementById('customer_order_no');
            let customerOrderError = document.getElementById('customer_order_noError');

            customerOrderField.addEventListener('input', function() {
                let customerOrderNo = this.value.trim();
                customerOrderError.textContent = ''; // Reset error message on each input change

                // Perform an AJAX request to check if the customer order number exists
                $.ajax({
                    method: 'POST',
                    url: '{{ route('master.order_detail.checkName') }}',
                    data: {
                        customer_order_no: customerOrderNo,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.exists) {
                            customerOrderError.textContent =
                                'Customer order number already exists in the database!';
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        customerOrderError.textContent =
                            'Error occurred while checking the customer order number.';
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#product_model').change(function() {
                var productModelId = $(this).val();
                if (productModelId) {
                    $.ajax({
                        url: '/master/order_detail/get-product-details', // Update the URL to your route
                        type: 'GET',
                        data: {
                            product_model: productModelId
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#product').val(response.product);
                            $('#raw_material_name').val(response.raw_material_name);
                            $('#raw_material_type').val(response.raw_material_type);
                            $('#product_size_code').val(response.product_size_code);
                            $('#product_size_id').val(response.product_size_id);
                            $('#wages_employee').val(response.wages_product);
                            $('#raw_material_weight_item').val(response
                                .raw_material_weight_item);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#product').val('');
                    $('#raw_material_name').val('');
                    $('#raw_material_type').val('');
                    $('#product_size_code').val('');
                    $('#product_size_id').val('');
                    $('#wages_employee').val('');
                    $('#raw_material_weight_item').val('');
                }
            });
        });
    </script>

    @include('links.js.select2.select2')
@endsection
