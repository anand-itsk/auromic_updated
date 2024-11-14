@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Given Outstanding Report')

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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="#">Report</a></li>
                                <li class="breadcrumb-item active">Outstanding Report</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Outstanding Report</h4>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-group row mb-0">

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Employee
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="employee" id="employee">
                                        <option value="">Select Type</option>
                                        @foreach ($employee as $type)
                                            <option value="{{ $type->id }}">{{ $type->employee_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('company_type')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Master Company
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="master_company" id="master_company">
                                        <option value="">Master Company</option>
                                        @foreach ($masterCompany as $type)
                                            <option value="{{ $type->id }}">{{ $type->company_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('company_type')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>


                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Client Company
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="client_company" id="client_company">
                                        <option value="">Client Company</option>
                                        @foreach ($clientCompany as $type)
                                            <option value="{{ $type->id }}">{{ $type->company_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('company_type')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>



                                <label for="customer_code" class="col-sm-2 col-form-label ">
                                    Sub Client Company
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <select class="form-control select2" name="sub_client_company" id="sub_client_company">
                                        <option value="">Sub Client Company</option>
                                        @foreach ($subClientCompany as $type)
                                            <option value="{{ $type->id }}">{{ $type->company_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('company_type')
                                        <span class="error" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>



                                <label for="customer_code" class="col-sm-2 col-form-label">
                                    Received Date
                                </label>
                                <div class="col-sm-2 mb-2">
                                    <input type="date" class="form-control" name="received_date" id="received_date">
                                    @error('received_date')
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
                                                                <form action="" method="POST"
                                                                    enctype="multipart/form-data">
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
                                                    <a href="" download>Click
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
                                                <th>Employee Code</th>
                                                <th>Employee Name</th>
                                                <th>Order No</th>
                                                <th>Model Name</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Given Qty</th>
                                                <th>Given Date</th>
                                                <th>Received Qty</th>
                                                <th>Received Date</th>
                                                <th>Dec</th>
                                                <th>Conv</th>
                                                <th>INC</th>
                                                <th>Weight</th>



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
        $(document).ready(function() {
            var table;

            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('report.outstanding_report.data') }}',
                    data: function(d) {
                        d.employee = $('#employee').val();
                        d.master_company = $('#master_company').val();
                        d.client_company = $('#client_company').val();
                        d.sub_client_company = $('#sub_client_company').val();
                        d.received_date = $('#received_date').val();
                    }

                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'employee_code',
                        name: 'employee_code'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'order_no',
                        name: 'order_no'
                    },
                    {
                        data: 'model_name',
                        name: 'model_name'
                    },
                    {
                        data: 'size',
                        name: 'size'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'given_qty',
                        name: 'given_qty'
                    },
                    {
                        data: 'given_date',
                        name: 'given_date'
                    },
                    {
                        data: 'received_qty',
                        name: 'received_qty'
                    },
                    {
                        data: 'received_date',
                        name: 'received_date'
                    },
                    {
                        data: 'deducation_fee',
                        name: 'deducation_fee'
                    },
                    {
                        data: 'conveyance_fee',
                        name: 'conveyance_fee'
                    },
                    {
                        data: 'incentive_fee',
                        name: 'incentive_fee'
                    },
                    {
                        data: 'current_weight',
                        name: 'deducation_fee'
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                select: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'print',
                        text: 'Print',
                        customize: function(win) {
                            // Initialize an empty title string


                            var title = "";


                            $('#employee').on('change', function() {
                                table.ajax.reload();
                            });

                            // Trigger DataTable reload when received_date is selected
                            $('#received_date').on('change', function() {
                                table.ajax.reload();
                            });

                            // Set the constructed title to the <h1> element in the print view
                            var h1Element = $(win.document.body).find('h1');
                            h1Element.text(title);

                            // Decrease font size of company name in print view
                            h1Element.css('font-size', '18px');

                            var currentDate = new Date().toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric'
                            });
                            var dateElement = $('<div>').css({
                                'position': 'absolute',
                                'top': '20px',
                                'right': '20px',
                                'font-weight': 'bold',
                                'font-size': '16px'
                            }).text(currentDate);
                            $(win.document.body).append(dateElement);


                            var reportName =
                                "Given OutStanding Report"; // Change this to the desired report name
                            var reportElement = $('<h2>').css({
                                'text-align': 'center',
                                'font-weight': 'bold',
                                'font-size': '24px',
                                'margin-top': '30px'
                            }).text(reportName);
                            $(win.document.body).prepend(reportElement);



                            $(win.document.body).find('table.dataTable').css('border-collapse',
                                'collapse');
                            $(win.document.body).find('table.dataTable th, table.dataTable td').css(
                                'text-align', 'center');

                            $(win.document.head).append('<style>@page {size: landscape; }</style>');

                            // Add other customization as needed
                            $(win.document.body).find('table').addClass('compact');
                        }
                    },
                    {
                        text: 'Export All',
                        action: function(e, dt, node, config) {
                            window.location.href = '/report/job_received_report/export?' + $.param(
                                dt.ajax
                                .params());
                        }
                    }
                ]

            });




            $('#employee').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });


            $('#master_company').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#client_company').on('change', function() {
                // Reload DataTable with updated parameters
                table.ajax.reload();
            });

            $('#sub_client_company').on('change', function() {
                table.ajax.reload();
            });

             $('#received_date').on('change', function() {
                table.ajax.reload();
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


        function updateSelectedFilters() {
            var selectedFilters = '';

            var employee = $('#employee option:selected').text();
            var masterCompany = $('#master_company option:selected').text();
            var clientCompany = $('#client_company option:selected').text();
            var subClientCompany = $('#sub_client_company option:selected').text();
            var receivedDate = $('#received_date').val();

            selectedFilters += 'Employee: ' + employee + ', ';
            selectedFilters += 'Master Company: ' + masterCompany + ', ';
            selectedFilters += 'Client Company: ' + clientCompany + ', ';
            selectedFilters += 'Sub Client Company: ' + subClientCompany + ', ';
            selectedFilters += 'Received Date: ' + receivedDate;

            $('#selectedFilters').text(selectedFilters);
        }


        function edit(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/job_allocation/delivery_challan/edit/' + id;
        }

        function deleteCustomer(id) {
            console.log("inside")
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Delivery challan?')) {
                $.ajax({
                    url: '/job_allocation/delivery_challan/delete/' + id,
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
    $(document).ready(function() {
        // Initialize Select2 on the customer dropdown
     
         $('#employee').select2({
            placeholder: "Select Employee",
            allowClear: true
        });
         $('#master_company').select2({
            placeholder: "Select Master Company",
            allowClear: true
        });
       
          $('#client_company').select2({
            placeholder: "Select Client Compant",
            allowClear: true
        });

          
          $('#sub_client_company').select2({
            placeholder: "Select SubClient Company",
            allowClear: true
        });


        
    });
</script>
@endsection
