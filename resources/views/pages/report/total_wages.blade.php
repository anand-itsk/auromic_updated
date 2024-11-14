@extends('layouts.app')
<!-- DataTables CSS -->
@section('title', 'Total Wages Report')

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
                                <li class="breadcrumb-item active">Total Wages Report</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Total Wages Report</h4>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-group row mb-0">

                               
                                <label for="client_company" class="col-sm-2 col-form-label ">
    Client Company
</label>
<div class="col-sm-2 mb-2">
    <select class="form-control select2" name="client_company_id" id="client_company">
        <option value="">Client Company</option>
        @foreach ($clientCompany as $type)
            <option value="{{ $type->id }}">{{ $type->company_name }}</option>
        @endforeach
    </select>
    @error('client_company_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="sub_client_company" class="col-sm-2 col-form-label ">
    Sub Client Company
</label>
<div class="col-sm-2 mb-2">
    <select class="form-control select2" name="sub_client_company_id" id="sub_client_company">
        <option value="">Sub Client Company</option>
        @foreach ($subClientCompany as $type)
            <option value="{{ $type->id }}">{{ $type->company_name }}</option>
        @endforeach
    </select>
    @error('sub_client_company_id')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="form_date" class="col-sm-2 col-form-label">
    Form Date
</label>
<div class="col-sm-2 mb-2">
    <input type="date" class="form-control" name="form_date" id="form_date">
    @error('form_date')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
</div>

<label for="last_date" class="col-sm-2 col-form-label">
    Last Date
</label>
<div class="col-sm-2 mb-2">
    <input type="date" class="form-control" name="last_date" id="last_date">
    @error('last_date')
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
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Company</th>
                                                <th>Recev Qty</th>
                                                <th>Amount</th>
                                                <th>Ded</th>
                                                <th>Total</th>
                                                <th>Conv</th>
                                                <th>INC</th>
                                                <th>Total Earned</th>
                                                <th>10 % Comission</th>
                                                <th>Total to pay</th>
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
                        url: '{{ route('report.total_wages.data') }}',
                        data: function(d) {
                            d.client_company_id = $('#client_company').val();  // Add client_company_id
                    d.sub_client_company_id = $('#sub_client_company').val();  // Add sub_client_company_id
                    d.form_date = $('#form_date').val();  // Add form_date
                    d.last_date = $('#last_date').val();  // Add last_date
                        }

                    },
                    columns: [{
                            data: 'job_giving_id',
                            name: 'job_giving_id'
                        },
                        { data: 'company_name', name: 'company_name' },
                        { data: 'total_complete_quantity', name: 'total_complete_quantity' },
                        {
                            data: 'net_amount',
                            name: 'net_amount'
                        },
                        {
                            data: 'deducation_fee',
                            name: 'deducation_fee'
                        },
                        {
                            data: 'total_amount',
                            name: 'total_amount'
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
                            data: 'total_earned',
                            name: 'total_earned'
                        },
                        {
                            data: 'commission',
                            name: 'commission'
                        },
                        {
                            data: 'total_pay',
                            name: 'total_pay'
                        },

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


                                $('#client_company').on('change', function() {
                                    table.ajax.reload();
                                });

                                // Trigger DataTable reload when received_date is selected
                                $('#sub_client_company').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#form_date').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#last_date').on('change', function() {
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
                                    "Total Wages Report"; // Change this to the desired report name
                                var reportElement = $('<h2>').css({
                                    'text-align': 'center',
                                    'font-weight': 'bold',
                                    'font-size': '24px',
                                    'margin-top': '30px'
                                }).text(reportName);
                                $(win.document.body).prepend(reportElement);



                              $(win.document.body).find('table.dataTable').css({
    'border-collapse': 'collapse',
    'width': '100%' // Ensures table stretches horizontally
});

// Center text inside table cells
$(win.document.body).find('table.dataTable th, table.dataTable td').css({
    'text-align': 'center',
    'padding': '8px', // Add padding for better readability
    'border': '1px solid black' // Optional: add borders for clarity
});

// Add compact class to the table for tighter layout if needed
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




            $('#client_company').on('change', function() {
                                    table.ajax.reload();
                                });

                                // Trigger DataTable reload when received_date is selected
                                $('#sub_client_company').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#form_date').on('change', function() {
                                    table.ajax.reload();
                                });

                                $('#last_date').on('change', function() {
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

            
    
                var clientCompany = $('#client_company option:selected').text();
                var subClientCompany = $('#sub_client_company option:selected').text();
                var formDate = $('#from_date').val();
                var lastDate = $('#last_date').val();

    
                selectedFilters += 'Client Company: ' + clientCompany + ', ';
                selectedFilters += 'Sub Client Company: ' + subClientCompany + ', ';
                selectedFilters += 'From Date: ' + formDate;
                selectedFilters += 'Last Date: ' + lastDate;

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
     
        
       
          $('#client_company').select2({
            placeholder: "Select Client Company",
            allowClear: true
        });

          
          $('#sub_client_company').select2({
            placeholder: "Select Subclient company",
            allowClear: true
        });


        
    });
</script>

@endsection
