@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Order Allocation')

@section('content')
    @include('links.css.datatable.datatable-css')
    @include('links.css.table.custom-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="wrapper">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="#">Job Allocation</a></li>
                                <li class="breadcrumb-item active">Order Allocation</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Order Allocation</h4>
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
                                    <select class="form-control select2" name="company_type" id="company_type">
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
                                    Customer Order No
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="customer_order_no" id="customer_order_no">
                                        <option value="">Select Customer code</option>
                                        @foreach ($order_nos as $item)
                                            <option value="{{ $item->id }}">{{ $item->customer_order_no }}</option>
                                        @endforeach

                                    </select>
                                    @error('order_id')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>


                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    DC No
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="dc_no" id="dc_no">
                                        <option value="">Select DC </option>
                                        @foreach ($delivery_challan as $item)
                                            <option value="{{ $item->id }}">{{ $item->dc_no }}</option>
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

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Product Color
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="product_color" id="product_color">
                                        <option value="">Select Color</option>
                                        @foreach ($product_color as $item)
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

                                    <div>
                                        <button id="deleteButton" class="icon-button delete-color"
                                            title="Delete Selected Record"><i class="fa fa-user-times"></i></button>
                                    </div>
                                    @error('file')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                    <div>
                                        <!-- <button type="button" class="icon-button common-color" data-toggle="modal"
                                                                data-target=".bs-example-modal-center" title=" Delivery challan"><i
                                                                    class="fa fa-upload"></i></button> -->

                                        <a href="{{ route('job_allocation.delivery_challan.create') }}"
                                            class="icon-link common-color" title="Create Delivery challan">
                                            <i class="fa fa-user-plus"></i>
                                        </a>
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
                                                                <form
                                                                    action="{{ route('job_allocation.delivery_challan.import') }}"
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
                                                    <a href="{{ asset('assets/sample_excels/delivery_challan_import.xlsx') }}"
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
                                                <th>Company ID</th>
                                                <th>Order Number</th>
                                                <th>DC NO</th>
                                                <th>DC Date</th>
                                                <th>Quantity</th>
                                                <th>Avl.Quantity</th>
                                                <th>Model Code</th>
                                                <th>Model Name</th>
                                                <th>Product Color</th>
                                                <th>Product Size</th>
                                                <th>Wages of product</th>
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
                    url: '{{ route('job_allocation.delivery_challan.data') }}',
                    data: function(d) {
                        // Add additional parameters here if needed
                        d.company_type = $('#company_type').val();
                        d.companies = $('#companies').val();
                        d.from_date = $('#from_date').val();
                        d.last_date = $('#last_date').val();
                        d.date_filter = $('input[name="date_filter"]:checked').val();
                        d.customer_order_no = $('#customer_order_no').val(); // New filter
                        d.dc_no = $('#dc_no').val(); // New filter
                        d.product_color = $('#product_color').val(); // New filter
                        d.product_size = $('#product_size').val(); // New filter
                        d.product_model = $('#product_model').val();
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
                        data: 'company.company_name',
                        name: 'company.company_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },


                    {
                        data: 'order_number',
                        name: 'order_number',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'dc_no',
                        name: 'dc_no',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'dc_date',
                        name: 'dc_date',
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
                        data: 'model_code',
                        name: 'model_code',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'model_name',
                        name: 'model_name',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'product_color',
                        name: 'product_color',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'product_size',
                        name: 'product_size',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'wages_product',
                        name: 'wages_product',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },


                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let buttons = `
            <button onclick="edit(${row.id})" class="icon-button primary-color">
                <i class="fa fa-edit"></i>
            </button>
        `;

                            if (row.can_delete) {
                                buttons += `
                <button onclick="deleteCustomer(${row.id})" class="icon-button delete-color">
                    <i class="fa fa-trash"></i>
                </button>
            `;
                            }

                            return buttons;
                        }
                    }

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
                            window.location.href = '/job_allocation/delivery_challan/export?' + $
                                .param(dt.ajax
                                    .params());
                        }
                    }
                ]

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

            $('#customer_order_no').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#product_color').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });
            $('#product_size').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

             $('#product_model').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#dc_no').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#from_date, #last_date').on('change', function() {
                table.ajax.reload();
            });

            $('input[name="date_filter"]').on('change', function() {
                table.ajax.reload();
            });



            function updateSelectedFilters() {
                var selectedFilters = '';
                var companyType = $('#company_type option:selected').text();
                var companies = $('#companies option:selected').text();
                var fromDate = $('#from_date').val();
                var lastDate = $('#last_date').val();
                var customerOrderNo = $('#customer_order_no').val();
                var dcNo = $('#dc_no').val();
                var productColor = $('#product_color').val();
                var productSize = $('#product_size').val();

                selectedFilters += `Company Type: ${companyType}, `;
                selectedFilters += `Companies: ${companies}, `;
                selectedFilters += `From Date: ${fromDate}, `;
                selectedFilters += `Last Date: ${lastDate}, `;
                selectedFilters += `Customer Order No: ${customerOrderNo}, `;
                selectedFilters += `DC No: ${dcNo}, `;
                selectedFilters += `Product Color: ${productColor}, `;
                selectedFilters += `Product Size: ${productSize}`;

                $('#selectedFilters').text(selectedFilters);
            }



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
                        url: '/job_allocation/delivery_challan/delete/selected',
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
            window.location.href = '/job_allocation/delivery_challan/edit/' + id;
        }

        function deleteCustomer(id) {
            if (confirm('Are you sure you want to delete this Delivery Challan?')) {
                $.ajax({
                    url: '/job_allocation/delivery_challan/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        if (result.status === 'success') {
                            toastr.success(result.message); // Show success toast
                            table.ajax.reload();
                        } else {
                            toastr.error(result.message); // Show error toast
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred while attempting to delete the Delivery Challan.');
                    }
                });
            }
        }

        function showDetails(userId) {
            // Fetch user details using AJAX
            $.ajax({
                url: '/master/customers/show/' + userId,
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
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right", // Position of the toast
            "timeOut": "3000" // Duration in milliseconds
        };
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
        document.querySelectorAll('input[name="date_filter"]').forEach(function(element) {
            element.addEventListener('change', function() {
                document.getElementById('filterForm').submit(); // Submit the form on selection
            });
        });
    </script>


<script>
        $(document).ready(function() {
            // Initialize Select2 on the customer dropdown
            $('#customer_order_no').select2({
                placeholder: "Select customer order no",
                allowClear: true
            });
            $('#dc_no').select2({
                placeholder: "Select dc_no",
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
             $('#product_color').select2({
                placeholder: "Select Product color",
                allowClear: true
            });
            
        });
    </script>


@endsection
