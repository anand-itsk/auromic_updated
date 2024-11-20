@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Order Details')

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
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active">Order Detail</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Order Detail</h4>
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
                                    Company Type
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control 3" name="company_type" id="company_type">
                                        <option value="">Select Type</option>
                                        @foreach ($companyType as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('company_type')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Companies
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="companies" id="companies" disabled>
                                        <option value="">Select Company</option>
                                        @foreach ($company as $c)
                                            <option value="{{ $c->id }}" data-type-id="{{ $c->company_type_id }}">
                                                {{ $c->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Companies')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Customer
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="customer" id="customer">
                                        <option value="">Select Type</option>
                                        @foreach ($customer as $type)
                                            <option value="{{ $type->id }}">{{ $type->customer_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('customer')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                   Customer Order No
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="order_id" id="order_id">
                                        <option value="">Select Type</option>
                                        @foreach ($order_nos as $type)
                                            <option value="{{ $type->id }}">{{ $type->customer_order_no }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
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
                                    Order No
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="order_no" id="order_no">
                                        <option value="">Select Type</option>
                                        @foreach ($order_nos as $type)
                                            <option value="{{ $type->id }}">{{ $type->last_order_number }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>




                                {{-- Order Status Starts --}}
                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Order Status
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="order_status" id="order_status">
                                        <option value="">Select Type</option>
                                        @foreach ($order_status as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('order_status')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- Order Status Ends --}}


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
                                                            title="Import file"><i class="fa fa-upload text-white"></i></button> -->

                                        <button class="icon-button  bg-primary rounded">
                                            <a href="{{ route('master.order_detail.create') }}"
                                                class="icon-link common-color" title="Create Order Detail">
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
                                                                <form action="{{ route('master.order_detail.import') }}"
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
                                                    <a href="{{ asset('assets/sample_excels/order_detail_import.xlsx') }}"
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
                                                <th>Order No</th>
                                                <th>Order Date</th>
                                                <th>customer Code</th>
                                                <th>Total Quantity</th>
                                                <th>Available Quantity</th>
                                                <th>Wages of Product</th>
                                                <th>Product Color</th>
                                                <th>Product Size</th>
                                                <th>Order Status</th>
                                                <th>Model Name</th>
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
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')

    <script>
        var table;
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('master.order_detail.data') }}',
                    data: function(d) {

                        console.log(d);

                        // Add additional parameters here if needed
                        d.company_type = $('#company_type').val();
                        d.companies = $('#companies').val();
                        d.customer = $('#customer').val();
                        d.order_status = $('#order_status').val();
                        d.from_date = $('#from_date').val();
                        d.last_date = $('#last_date').val();
                        d.orderNoId = $('#order_id').val();
                         d.order_no = $('#order_no').val();
                        d.product = $('#product').val(); // New filter
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
                        data: 'order_no.last_order_number',
                        name: 'order_no.last_order_number',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'order_date',
                        name: 'order_date',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'order_no.customer_order_no',
                        name: 'order_no.customer_order_no',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },

                    {
                        data: 'quantity',
                        name: 'quantity',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'available_quantity',
                        name: 'available_quantity',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'product_model.wages_product',
                        name: 'product_model.wages_product',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },

                    {
                        data: 'product_color.name',
                        name: 'product_color.name',
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
                        data: 'order_status.name',
                        name: 'order_status.name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'product_model.model_name',
                        name: 'product_model.model_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <button onclick="edit(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        

                       <button onclick="addOrder(${row.id})" class="icon-button common-color"><i class="fa fa-plus"></i></button>


                    `;
                            // <button onclick="deleteCustomer(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
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
                            window.location.href = '/master/order_detail/export?' + $.param(dt.ajax
                                .params());
                        }
                    }
                ],
            });

            $('#company_type').on('change', function() {
                var selectedCompanyType = $(this).val();
                if (selectedCompanyType) {
                    $('#companies').prop('disabled', false);
                } else {
                    $('#companies').prop('disabled', true).val('');
                }
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#companies').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });


            $('#customer').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
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


            $('#order_status').on('change', function() {
                table.ajax.reload();
            });

             $('#order_no').on('change', function() {
                table.ajax.reload();
            });


            $('input[name="date_filter"]').on('change', function() {
                // Reload DataTable with new filter
                table.ajax.reload();
            });





        });

        function updateSelectedFilters() {
            var selectedFilters = '';
            // Get selected values from filter elements
            var companyType = $('#company_type option:selected').text();
            var companies = $('#companies option:selected').text();
            var customer = $('#customer option:selected').text();
            var fromDate = $('#from_date').val();
            var lastDate = $('#last_date').val();
            var product = $('#product option:selected').text(); // New filter
            var orderNoId = $('#order_id option:selected').text();

             var orderNo = $('#order_no option:selected').text();

            // Construct the string with selected filter values
            selectedFilters += 'Company Type: ' + companyType + ', ';
            selectedFilters += 'Companies: ' + companies + ', ';
            selectedFilters += 'Customer: ' + customer + ', ';
            selectedFilters += 'From Date: ' + fromDate + ', ';
            selectedFilters += 'Last Date: ' + lastDate;
            selectedFilters += 'Product: ' + product + ', '; // New filter
            selectedFilters += 'Order No: ' + orderNoId; // New filter
             selectedFilters += 'Order : ' + orderNo;


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
                url: '/master/order_detail/delete/selected',
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
        

        function redirectToCreatePage(rowId, orderNo) {
            window.location.href = '/master/order_detail/create?rowId=' + rowId + '&orderNo=' + encodeURIComponent(orderNo);
        }


        function edit(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/master/order_detail/edit/' + id;
        }

        function addOrder(id) {
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/master/order_detail/add_order/' + id;
        }


        function deleteCustomer(id) {
            console.log("inside")
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Order Detail?')) {
                $.ajax({
                    url: '/master/order_detail/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        }

        function showDetails(userId) {
            // Fetch user details using AJAX
            $.ajax({
                url: '/master/order_detail/show/' + userId,
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
        // Retrieve the value of the orderNo parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const orderNo = urlParams.get('orderNo');

        // Populate the input field with the retrieved orderNo value
        document.getElementById('order_no').value = orderNo;
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
            // Initialize Select2 on both dropdowns
            $('#company_type, #companies').select2({
                placeholder: "Select an option",
                allowClear: true
            });

            // Company Type select change event
            $('#company_type').on('change', function() {
                var selectedTypeId = $(this).val(); // Get the selected company type

                // Reset the companies dropdown
                var $companiesSelect = $('#companies');
                $companiesSelect.empty().append(
                    '<option value="">Select Company</option>'); // Reset options

                // Filter and append companies based on selected company type
                var companies = @json($company); // Get all companies
                companies.forEach(function(company) {
                    if (company.company_type_id == selectedTypeId) {
                        var option = new Option(company.company_name, company.id);
                        $companiesSelect.append(option);
                    }
                });

                // Re-initialize Select2 after appending new options
                $companiesSelect.trigger('change');
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // Initialize Select2 on the customer dropdown
            $('#customer').select2({
                placeholder: "Select Customer",
                allowClear: true
            });
            $('#order_id').select2({
                placeholder: "Select Customer Order_no",
                allowClear: true
            });
            $('#product').select2({
                placeholder: "Select Product",
                allowClear: true
            });

            $('#order_status').select2({
                placeholder: "Select Order Status",
                allowClear: true
            });
             $('#order_no').select2({
                placeholder: "Select Order No",
                allowClear: true
            });
            
        });
    </script>
@endsection
