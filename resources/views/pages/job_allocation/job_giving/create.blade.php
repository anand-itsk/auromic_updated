@extends('layouts.app')
@section('title', 'Create Job Giving')
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
                                <li class="breadcrumb-item"><a href="">Job Allocation</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">Job Giving</a>
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
                <div class="col-10">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.job_giving.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="employee_id" class="col-sm-2 col-form-label mandatory">
                                            Employee Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                                <option value="">Select Employee</option>
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-company-name="{{ $item->company->company_name }}"
                                                        data-company-type="{{ $item->company->companyType->name }}"
                                                        data-company-id="{{ $item->company->id }}">
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
                                            <input type="text" class="form-control" name="company_type" id="company_type"
                                                readonly>
                                            @error('company_type')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="company_name" class="col-sm-2 col-form-label ">
                                            Company Name
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="company_name" id="company_name"
                                                readonly>
                                            @error('company_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="customer_code" class="col-sm-2 col-form-label mandatory">Dc
                                            Number</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="dc_number" id="dc_number" required>
                                                <option value="">Select DC</option>
                                                @foreach ($delivery_challan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->dc_no }} /
                                                        {{ $item->orderDetails->orderNo->customer_order_no }} /
                                                        {{ $item->orderDetails->productModel->model_name }} /
                                                        {{ $item->orderDetails->productModel->model_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('order_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label">Model</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="model_name" id="model_name"
                                                readonly>
                                            @error('product_model')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="customer_code" class="col-sm-2 col-form-label ">Order
                                            Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="order_date" id="order_date"
                                                readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="customer_code" class="col-sm-2 col-form-label ">Customer Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="customer_name"
                                                id="customer_name" readonly>
                                            @error('customer_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="product_name" class="col-sm-2 col-form-label ">Product Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="product_name" id="product_name"
                                                readonly>
                                            @error('product_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="order_date" class="col-sm-2 col-form-label ">Raw Material Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_name"
                                                id="raw_material_name" readonly>
                                            @error('raw_material')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="order_date" class="col-sm-2 col-form-label">Raw Material Type</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="raw_material_type"
                                                id="raw_material_type" readonly>
                                            @error('raw_material_type')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                         <label for="customer_code" class="col-sm-2 col-form-label">
                                            Wages of 1 Product
                                        </label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="text" class="form-control" name="wages" id="wages"
                                                readonly >
                                            @error('wages')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="order_date" class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="quantity" id="quantity" required>
                                            <span id="quantity-error" class="error"
                                                style="color: red; display: none;"></span>
                                            @error('quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-2 col-form-label">Available Quantity</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="available_quantity"
                                                id="available_quantity" readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-2 col-form-label">Weight</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="weight" id="weight" required>
                                            <input class="form-control" type="hidden" name="weightPerItem"
                                                id="weightPerItem">
                                            <input class="form-control" type="hidden" name="avaWeight" id="avaWeight">
                                            <span id="weight_error" class="error" style="color: red;"></span>
                                            @error('weight')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-1 col-form-label">Excess</label>
                                        <div class="col-sm-2 mb-4">
                                            <input class="form-control" type="text" name="excess_weight"
                                                id="excess_weight" readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-sm-1.5 col-form-label">Shortage</label>
                                        <div class="col-sm-2 mb-4">
                                            <input class="form-control" type="text" name="shortage_weight"
                                                id="shortage_weight" readonly>
                                            @error('order_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="deadline_days" class="col-sm-2 col-form-label">Deadline (Days)</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="deadline_days"
                                                id="deadline_days">
                                            <span id="weight_error" class="error" style="color: red;"></span>
                                            @error('deadline_days')
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
                <div class="col-2">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('job_allocation.delivery_challan.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">

                                        <label for="order_date" class="col-form-label">Total Quantity</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="total_quantity"
                                                id="total_quantity" readonly>
                                            @error('total_quantity')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-form-label">Total Weight</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="total_weight"
                                                id="total_weight" readonly>
                                            @error('total_weight')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="order_date" class="col-form-label">Order Delivery Date</label>
                                        <div class="mb-4">
                                            <input class="form-control" type="text" name="deliveryDate"
                                                id="deliveryDate" readonly>
                                            @error('deliveryDate')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
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

            $('#dc_number').on('change', function() {
                var orderId = $(this).val();
                console.log(orderId);
                if (orderId) {
                    $.ajax({
                        url: '/job_allocation/job_giving/get-dc-details/' + orderId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.dcDetail.order_details);

                            if (data) {
                                $('#order_no').val(data.dcDetail.order_details.order_no
                                    .last_order_number);
                                $('#model_name').val(data.dcDetail.order_details.product_model
                                    .model_name);
                                $('#order_date').val(data.dcDetail.order_details.order_date);

                                $('#customer_name').val(data.dcDetail.order_details.customer
                                    .customer_name);
                                $('#product_name').val(data.dcDetail.order_details.product_model
                                    .product.name);

                                $('#total_quantity').val(data.dcDetail.quantity);

                                $('#total_weight').val(data.dcDetail.weight);
                                $('#available_quantity').val(data.dcDetail.available_quantity);

                                $('#raw_material_name').val(data.dcDetail.order_details
                                    .product_model.raw_material.name);

                                $('#raw_material_type').val(data.dcDetail.order_details
                                    .product_model.raw_material.raw_material_type.name);
                                $('#wages').val(data.dcDetail.order_details.product_model
                                    .wages_product);

                                $('#weightPerItem').val(data.dcDetail.order_details
                                    .weight_per_item);

                                $('#deliveryDate').val(data.dcDetail.order_details
                                    .delivery_date);
                                     $('#company_name').val(data.dcDetail.company
                                    .company_name);
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

            $('#weight').on('input', function() {
                var weight = parseFloat($(this).val());
                      if (isNaN(weight)) {
        $('#excess_weight').val('0.0');
        $('#shortage_weight').val('0.0');
        return; 
    }
                var weightPerQuantity = parseFloat($('#weightPerItem').val());
                var totalQuantity = parseFloat($('#total_quantity').val());
                var totalWeight = parseFloat($('#total_weight').val());
                var givenQuantity = parseFloat($('#quantity').val());
                var avaWeight = parseFloat($('#avaWeight').val());
                console.log(weightPerQuantity);
                var givenWeight = givenQuantity * weightPerQuantity;

                // Calculate excess and shortage
                var excess = weight - givenWeight;
                var shortage = 0;

                if (excess < 0) {
                    shortage = Math.abs(excess);
                    excess = 0;
                }
                $('#excess_weight').val(excess.toFixed(1));
                $('#shortage_weight').val(shortage.toFixed(1));

                // Output the results
                console.log('Excess:', excess.toFixed(1));
                console.log('Shortage:', shortage.toFixed(1));
                // Perform any actions you want here
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#product_model').change(function() {
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
            console.log(orderId);
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


    <script>
        $(document).ready(function() {
            // Initially disable the product model select dropdown
            $('#product_model').prop('disabled', true);

            // Add change event listener to the order number select dropdown
            $('#order_id').change(function() {
                var orderId = $(this).val(); // Get the selected order ID
                if (orderId !== '') {
                    // Enable the product model select dropdown
                    $('#product_model').prop('disabled', false);
                    // Send AJAX request to fetch corresponding product model data
                    $.ajax({
                        url: '/job_allocation/job_giving/get-product-model/' + orderId,
                        type: 'GET',
                        success: function(data) {
                            // Update the options of the product model select dropdown
                            $('#product_model').html(data);

                            // Now, fetch model details for the first product model
                            var firstModelId = $('#product_model option:first').val();
                            fetchModelDetails(firstModelId);
                        }
                    });
                } else {
                    // If no order is selected, disable and reset the product model select dropdown
                    $('#product_model').prop('disabled', true);
                    $('#product_model').html('<option value="">Select Model</option>');
                }
            });

            // Add change event listener to the product model select dropdown
            $('#product_model').change(function() {
                var modelId = $(this).val(); // Get the selected product model ID
                fetchModelDetails(modelId);
            });

            // Function to fetch model details based on the given model ID
            function fetchModelDetails(modelId) {
                if (modelId) {
                    // Send AJAX request to fetch model details
                    $.ajax({
                        url: '/job_allocation/job_giving/get-model-details/' + modelId,
                        type: 'GET',
                        success: function(data) {
                            // Update the details based on the received data
                            $('#product').val(data.product_name);
                            $('#raw_material_name').val(data.raw_material_name);
                            $('#raw_material_type').val(data.raw_material_type);
                        }
                    });
                }
            }
        });
    </script>



    <!-- <script>
        // Function to fetch company name based on selected employee ID
        function fetchCompanyName() {
            var employeeId = $('#employee_id').val();
            var companyId = $('#employee_id option:selected').data('company-id');

            // Set the company ID and name
            $('#company_name').val($('#employee_id option:selected').data('company-name'));

            // Fetch order IDs associated with the selected company
            $.ajax({
                url: '{{ route('job_allocation.job_giving.fetch-order-ids') }}',
                type: 'GET',
                data: {
                    company_id: companyId
                },
                success: function(response) {
                    // Populate order ID select element
                    $('#order_id').empty();
                    $('#order_id').append('<option value="">Select Order</option>');
                    console.log(response);
                    // $.each(response.order_ids, function(index, value) {

                    //     $('#order_id').append('<option value="' + value.id + '">' + value + '</option>');
                    // });

                    $.each(response.order_data, function(index, order) {
                        $.each(response.order_ids, function(index, orderId) {
                            if (order.id == orderId) {
                                $('#order_id').append('<option value="' + order.id + '">' +
                                    order.last_order_number + '</option>');
                            }
                        });
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        }

        // Event listener for employee ID select change
        $(document).ready(function() {
            $('#employee_id').change(function() {
                fetchCompanyName();
            });
        });
    </script> -->

<script>
    // Function to fetch company name based on selected employee ID
    function fetchCompanyName() {
        var companyId = $('#employee_id option:selected').data('company-id');

        // Set the company ID and name
        $('#company_name').val($('#employee_id option:selected').data('company-name'));

        $('#dc_number').prop('disabled', false);

        // Fetch order IDs associated with the selected company
        $.ajax({
            url: '{{ route('job_allocation.job_giving.fetch-order-ids') }}',
            type: 'GET',
            data: {
                company_id: companyId
            },  
            success: function(response) {
                $('#dc_number').empty();
                $('#dc_number').append('<option value="">Select DC</option>');
                $.each(response.dc_numbers, function(index, dc) {
                    $('#dc_number').append('<option value="' + dc.id + '">' + dc.dc_no + ' / ' + dc.customer_order_no + ' / ' + dc.model_name + ' / ' + dc.model_code + '</option>');
                });
            }
        });
    }

    // Event listener for employee ID select change
    $(document).ready(function() {
        // Disable dc_number initially
        $('#dc_number').prop('disabled', true);

        $('#employee_id').change(function() {
            fetchCompanyName();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#dc_number').change(function() {
            var companyName = $(this).find(':selected').data('company');
            $('#company_name').val(companyName);
        });
    });
</script>

    <script>
        $(document).ready(function() {
            // Initially disable the product_model dropdown
            $('#product_model').prop('disabled', true);

            $('#order_id').change(function() {
                var orderId = $(this).val();
                if (orderId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('job_allocation.delivery_challan.getModelsByOrderId') }}",
                        data: {
                            order_id: orderId
                        },
                        success: function(response) {
                            var options = '<option value="">Select Model</option>';
                            $.each(response, function(key, value) {
                                options += '<option value="' + value.id + '">' + value
                                    .model_name + '-' + value.model_code + '</option>';
                            });
                            $('#product_model').html(options);
                            // Enable the product_model dropdown
                            $('#product_model').prop('disabled', false);
                        }
                    });
                } else {
                    $('#product_model').html('<option value="">Select Model</option>');
                    // Disable the product_model dropdown if no order_id is selected
                    $('#product_model').prop('disabled', true);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#product_model').change(function() {
                var productModelId = $(this).val();
                if (productModelId) {
                    $.ajax({
                        url: '/job_allocation/delivery_challan/get-product-details', // Update the URL to your route
                        type: 'GET',
                        data: {
                            product_model: productModelId
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#product_name').val(response.product);
                            $('#raw_material_name').val(response.raw_material_name);
                            $('#raw_material_type').val(response.raw_material_type);
                            $('#dc_number').val(response.dc_no);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#product_name').val('');
                    $('#raw_material_name').val('');
                    $('#raw_material_type').val('');
                    $('#dc_number').val('');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#product_model').change(function() {
                var productModelId = $(this).val();
                if (productModelId) {
                    $.ajax({
                        url: '/job_allocation/delivery_challan/get-order-details', // Update the URL to your route
                        type: 'GET',
                        data: {
                            product_model: productModelId
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#order_date').val(response.order_date);
                            $('#total_quantity').val(response.total_quantity);
                            $('#available_quantity').val(response.available_quantity);
                            $('#total_weight').val(response.total_r_w_weight);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#order_date').val('');
                    $('#total_quantity').val('');
                    $('#available_quantity').val('');
                }
            });
        });
    </script>

    <script>
    $(document).ready(function () {
        $('#quantity').on('input', function () {
            var quantity = parseInt($(this).val());
            var availableQuantity = parseInt($('#available_quantity').val());

            // Check if quantity is greater than available quantity
            if (quantity > availableQuantity) {
                $('#quantity-error').text('Quantity cannot exceed Available Quantity').show();
            } else {
                $('#quantity-error').hide();
            }
        });
    });
</script>
@endsection
