@extends('layouts.app')

@section('title', 'Product Model')
<!-- DataTables CSS -->
@section('content')
    @include('links.css.datatable.datatable-css')
    @include('links.css.table.custom-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="wrapper">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong></strong> Product Model deleted successfully.
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active">Product Model</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Product Model</h4>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-group row mb-0">

                                {{-- date Starts --}}
                                <div class="form-group col-sm-4 mb-2 d-flex align-item-center"
                                    style="position: relative;top:8px">

                                    <div class="">
                                        <label class="mx-0"><input type="radio" name="date_filter" value="today">
                                            Today</label>
                                        <label class="ml-4"><input type="radio" name="date_filter" value="this_month">
                                            This
                                            Month</label>
                                        <label class="ml-4"><input type="radio" name="date_filter" value="last_month">
                                            Last
                                            Month</label>
                                    </div>
                                </div>
                                {{-- date Ends --}}
                                {{-- From Date starts --}}
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    From Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="from_date" id="from_date">
                                    @error('from_date')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- From Date Ends --}}
                                {{-- To Date Starts --}}
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    To Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="last_date" id="last_date">
                                    @error('last_date')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- To Date Ends --}}

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Product
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="product" id="product">
                                        <option value="">Select Type</option>
                                        @foreach ($product as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>


                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Model Code
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="product_model" id="product_model">
                                        <option value="">Select Model code</option>
                                        @foreach ($product_model as $item)
                                            <option value="{{ $item->id }}">{{ $item->model_code }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>


                                 <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Product size
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="product_size" id="product_size">
                                        <option value="">Select Size</option>
                                        @foreach ($product_size as $item)
                                            <option value="{{ $item->id }}">{{ $item->code }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>





                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="d-flex justify-content-between p-2 bd-highlight">
                                    {{-- <div>
                                        <button id="deleteButton" class="icon-button delete-color"
                                            title="Delete Selected Record"><i class="fa fa-user-times"></i></button>
                                    </div> --}}

                                    @error('file')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <div>
                                        <button id="deleteButton" style="display: none;"
                                            class="icon-button text-white bg-danger rounded fs-14"
                                            title="Delete Selected Record">
                                            Delete Selected Record</button>
                                    </div>
                                    <div>
                                        <!-- <button type="button" class="icon-button common-color bg-secondary rounded"
                                                                data-toggle="modal" data-target=".bs-example-modal-center"
                                                                title="Import file"><i class="fa fa-upload  text-white"></i></button> -->

                                        <button class="icon-button  bg-primary rounded">
                                            <a href="{{ route('master.product_model.create') }}"
                                                class="icon-link common-color" title="Create Product model">
                                                <i class="fa fa-user-plus text-white"></i>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                                {{-- Import Modal --}}
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">Import</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card m-b-30">
                                                            <div class="card-body">
                                                                <form action="{{ route('master.product_model.import') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="file" name="file" required>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Import</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <h4 class="mt-0 header-title mb-0">Note:</h4>
                                                <p class="text-muted font-14">Supported documents (.xls,
                                                    .xlsx or .csv)</p>
                                                <p class="text-muted font-14">To upload sample document, it
                                                    must have concern fields.
                                                    <a href="{{ asset('assets/sample_excels/product_model_import.xlsx') }}"
                                                        download>Click
                                                        to download sample document</a>
                                                </p>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                <div class="card-body">
                                    <table id="users-table"
                                        class="table table-striped table-bordered table-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Model Code</th>
                                                <th>Model Name</th>
                                                <th>Product Size</th>
                                                <th>Wages of one Product</th>
                                                <th>R.M</th>
                                                <th>R.M Weight/item</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel">Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="detailsContent">
                                <!-- Content loaded via AJAX -->
                            </div>
                        </div>

                        <div class="modal-footer">

                            <div class="row w-100">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Created By</span>
                                            <span id="created_by"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Created at</span>
                                            <span id="created_at"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <span class="font-weight-bold mr-2">Updated By</span>
                                            <span id="updated_by"></span>
                                        </div>
                                        <div class="col-md-6 ">
                                            <span class="font-weight-bold mr-2">Updated at</span>
                                            <span id="updated_at"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- price model --}}
    <!-- Modal HTML -->
    <!-- Modal Structure -->
    <div class="modal fade price-create-modal-center" id="updateModal" tabindex="-1" role="dialog"
        aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form id="priceForm" method="POST">
                        @csrf
                        <input type="text" name="id" id="id">
                        <div class="row">
                            <label for="wages_product" class="col-sm-12 col-form-label">Wages of Product</label>
                            <div class="col-sm-12 mb-4">
                                <input class="form-control" type="text" name="wages_product" id="wages_product"
                                    required>
                            </div>

                            <label for="date" class="col-sm-12 col-form-label">Date</label>
                            <div class="col-sm-12 mb-4">
                                <input class="form-control" type="date" name="date" id="date" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="submitUpdate()">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    {{--  --}}

    {{-- table show --}}
    <div class="modal fade price-create-modal-center" id="updateModal1" tabindex="-1" role="dialog"
        aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <!-- Table inside the modal body -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Model Code</th>
                                <th scope="col">Model Name</th>
                                <th scope="col">Wages Product</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be injected here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')


    <script>
        var table;
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('master.product_model.data') }}',
                    data: function(d) {

                        console.log(d);
                        d.from_date = $('#from_date').val();
                        d.last_date = $('#last_date').val();
                        d.product = $('#product').val(); // New filter
                        d.product_model = $('#product_model').val(); // New filter
                        d.product_size = $('#product_size').val(); // New filter
                        d.date_filter = $('input[name="date_filter"]:checked').val();
                    }

                },

                columns: [{

                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {


                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'product.name',
                        name: 'product.name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'model_code',
                        name: 'model_code',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'model_name',
                        name: 'model_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'product_size.code',
                        name: 'product_size.code',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'wages_product',
                        name: 'wages_product',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'raw_material.name',
                        name: 'raw_material.name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'raw_material_weight_item',
                        name: 'raw_material_weight_item',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },


                    {
                        data: 'date',
                        name: 'date',
                        render: function(data, type, row) {
                            if (data) {
                                // Create a new Date object and format it
                                const date = new Date(data);
                                const day = ('0' + date.getDate()).slice(-2);
                                const month = ('0' + (date.getMonth() + 1)).slice(-2);
                                const year = date.getFullYear();
                                return `${day}/${month}/${year}`;
                            }
                            return '-';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <button onclick="edit(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteCustomer(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                         <button onclick="openModal(${row.id})" class="icon-button modal-color"><i class="fa fa-info-circle"></i></button>
                          <button onclick="openModal1(${row.id})" class="icon-button modal-color"><i class="fa fa-eye"></i></button>
                    `;
                        }

                    },
                ],
                order: [
                    [0, 'desc']
                ],
                select: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'print',
                    {
                        text: 'Export All',
                        action: function(e, dt, node, config) {
                            window.location.href = '/master/product_model/export?' + $.param(dt.ajax
                                .params());
                        }
                    }
                ],


            });

            $('#from_date').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#last_date').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#order_id').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#product').on('change', function() {
                table.ajax.reload();
            });

             $('#product_model').on('change', function() {
                table.ajax.reload();
            });
             $('#product_size').on('change', function() {
                table.ajax.reload();
            });
             $('input[name="date_filter"]').on('change', function() {
                // Reload DataTable with new filter
                table.ajax.reload();
            });

            function updateSelectedFilters() {
                var selectedFilters = '';
                var fromDate = $('#from_date').val();
                var lastDate = $('#last_date').val();
                var product = $('#product option:selected').text();
                var productModel = $('#product_model option:selected').text();
                var productSize = $('#product_size option:selected').text();


                // Construct the string with selected filter values

                selectedFilters += 'From Date: ' + fromDate + ', ';
                selectedFilters += 'Last Date: ' + lastDate;
                selectedFilters += 'Product: ' + product + ', '; 
                 selectedFilters += 'Product Model: ' + productModel + ', '; 
                  selectedFilters += 'Product Size: ' + productSize + ', '; 



                // Update the HTML content with selected filter values
                $('#selectedFilters').text(selectedFilters);

            }
            // Listen for row selection event
            $('#users-table').on('select.dt deselect.dt', function() {
                var selectedRows = table.rows({
                    selected: true
                }).count();

                if (selectedRows > 0) {
                    $('#deleteButton').show(); // Show delete button if rows are selected
                } else {
                    $('#deleteButton').hide(); // Hide delete button if no rows are selected
                }
            });

            $('#deleteButton').click(function() {
                var ids = $.map(table.rows('.selected').data(), function(item) {
                    return item.id;
                });

                if (ids.length === 0) {
                    alert('No rows selected!');
                    return;
                }

                if (confirm("Are you sure you want to delete these rows?")) {
                    // Send AJAX request to delete the selected rows
                    $.ajax({
                        url: '/master/product_model/delete/selected',
                        type: 'POST',
                        data: {
                            ids: ids,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Handle response here
                            table.ajax.reload(); // Reload the DataTable
                        }
                    });
                }
            });
        });

        function edit(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/master/product_model/edit/' + id;
        }



        function deleteCustomer(id) {
            console.log("inside")
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Product Model?')) {
                $.ajax({
                    url: '/master/product_model/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        // Show success message
                        $('.alert-success').show();

                        // Hide success message after 5 seconds
                        setTimeout(function() {
                            $('.alert-success').alert('close');
                        }, 5000);

                        // Reload the DataTable after success message is shown
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        }

        function showDetails(userId) {
            // Fetch user details using AJAX
            $.ajax({
                url: '/master/product_model/show/' + userId,
                type: 'GET',
                success: function(response) {

                    const createdAt = response.data.created_at;
                    const formattedCreatedAt = formatTimestamp(createdAt);
                    const updatedAt = response.data.updated_at;
                    const formattedUpdatedAt = formatTimestamp(updatedAt);
                    $('#detailsContent').html(response.html);
                    $('#created_by').html(response.data.created_by);
                    $('#updated_by').html(response.data.updated_by);
                    $('#created_at').html(formattedCreatedAt);
                    $('#updated_at').html(formattedUpdatedAt);

                    console.log(formattedCreatedAt);
                    $('#detailsModal').modal('show');
                }
            });
        }

        function openModal(id) {
            // Show the modal
            $('#updateModal').modal('show');

            // Fetch product model data using AJAX
            $.ajax({
                url: `/master/product_model/product-model/${id}`, // Update with your route
                type: 'GET',
                success: function(response) {
                    // Populate the input fields with data
                    $('#id').val(response.id);

                    $('#wages_product').val(response.wages_product);
                    $('#date').val(response.date);
                },
                error: function() {
                    alert('Error fetching data');
                }
            });
        }

        function openModal1(id) {
            // Show the modal
            $('#updateModal1').modal('show');

            // Fetch product model history data using AJAX
            $.ajax({
                url: '/master/product_model/product-model-history/' + id, // Adjust the URL to your route
                type: 'GET',
                success: function(response) {
                    // Update the table with the fetched data
                    var tableBody = $('#updateModal1 .modal-body table tbody');
                    tableBody.empty(); // Clear any existing rows

                    if (response.success && response.data.length > 0) {
                        // Loop through the response data and add rows to the table
                        response.data.forEach(function(item) {
                            var row = `<tr>
                        <td>${item.model_code}</td>  <!-- Display model_code -->
                        <td>${item.model_name}</td>  <!-- Display model_name -->
                        <td>${item.wages_product}</td>  <!-- Display wages_product -->
                        <td>${item.formatted_created_at}</td>  <!-- Display formatted created_at -->
                    </tr>`;
                            tableBody.append(row);
                        });
                    } else {
                        // Show "no data found" message in the table
                        var noDataRow = `<tr>
                    <td colspan="4" class="text-center">No data found for the selected product model.</td>
                </tr>`;
                        tableBody.append(noDataRow);
                    }
                },
                error: function() {
                    // Handle AJAX error
                    var tableBody = $('#updateModal1 .modal-body table tbody');
                    tableBody.empty(); // Clear any existing rows
                    var errorRow = `<tr>
                <td colspan="4" class="text-center">Error fetching data. Please try again later.</td>
            </tr>`;
                    tableBody.append(errorRow);
                }
            });
        }




        function submitUpdate() {
            // Ensure the ID is passed correctly
            const productModelId = $('#id').val();

            if (!productModelId) {
                alert('Product model ID is missing');
                return;
            }

            // Serialize form data to send all form fields
            $.ajax({
                url: '{{ route('master.product_model.product-model.update') }}',
                type: 'POST',
                data: $('#priceForm').serialize(), // Serialize the form data automatically
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#updateModal').modal('hide');
                        // Optionally, refresh data on the page or update the table row
                        location.reload(); // You can reload the page to reflect changes
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error updating data');
                }
            });
        }




        function formatTimestamp(timestamp) {
            const date = new Date(timestamp);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
            const year = date.getFullYear();
            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            const strTime = hours.toString().padStart(2, '0') + ':' + minutes + ' ' + ampm;

            return `${day}-${month}-${year} ${strTime}`;
        }
    </script>
 <script>
        document.querySelectorAll('input[name="date_filter"]').forEach(function(element) {
            element.addEventListener('change', function() {
                document.getElementById('filterForm').submit(); // Submit the form on selection
            });
        });
    </script>
     <script>
        $(document).ready(function() {
            // Initialize Select2 on the customer dropdown
            $('#product').select2({
                placeholder: "Select Product",
                allowClear: true
            });
            $('#product_model').select2({
                placeholder: "Select Product Model",
                allowClear: true
            });
            $('#product_size').select2({
                placeholder: "Select Product Size",
                allowClear: true
            });
            
        });
    </script>
@endsection
