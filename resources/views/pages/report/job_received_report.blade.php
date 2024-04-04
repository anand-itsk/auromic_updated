@extends('layouts.app')
<!-- DataTables CSS -->


@section('content')
    @include('links.css.datatable.datatable-css')
    @include('links.css.table.custom-css')
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
                                <li class="breadcrumb-item active">Job Received Report</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Job Received Report</h4>
                    </div>
                       <div class="card mb-2">
                           <div class="card-body">
                <div class="form-group row mb-0">
                                
                               <label for="customer_code" class="col-sm-2 col-form-label ">
                           Status
                           </label>
                           <div class="col-sm-2 mb-2">
                                 <select class="form-control select2" name="status" id="statuses">
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
                           <label for="customer_code" class="col-sm-2 col-form-label ">
                                            Incentive Applicable
                                        </label>
                                        <div class="col-sm-2 mb-2">
                                            <select class="form-control select2" name="Incentive_status"
                                                id="Incentive_status">

                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            @error('Incentive_status')
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
                                                                <form action=""
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
                                                    <a href=""
                                                        download>Click
                                                        to download sample document</a>
                                                </p>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                <div class="card-body">
                                    <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Company code</th>
                                                 <th>Employee Name</th>
                                                  <th>Incentive Applicable</th>
                                                  <th>Incentive fee</th>
                                                  <th>Conveyance fee</th>
                                                  <th>Deducation fee</th>
                                                   <th>Total amount</th>
                                                    <th>Net amount</th>
                                                    <th>status</th>
                                               
                                                        
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
            $('#companies').prop('disabled', true);
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                    ajax: {
            url: '{{ route('report.job_received_report.data') }}',
            data: function(d) {
                // Add additional parameters here if needed
               d.status = $('#statuses').val();
                
            }
            
        },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'company_code',
                        name: 'company_code',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                        
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                        
                    },
                     {
                        data: 'incentive_applicable',
                        name: 'incentive_applicable',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'incentive_fee',
                        name: 'incentive_fee',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                        
                    },
                    {
                        data: 'conveyance_fee',
                        name: 'conveyance_fee',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                        
                    },
                    {
                        data: 'deducation_fee',
                        name: 'deducation_fee',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                        
                    },
                    
                     
                    {
                        data: 'total_amount',
                        name: 'total_amount',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                        
                    },
                     {
                        data: 'net_amount',
                        name: 'net_amount',
                        render: function(data, type, row) {
                            return data ? data : '-';
                        }
                    },

                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return data ? data : '-';
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
                            window.location.href = '/job_allocation/delivery_challan/export?' + $.param(dt.ajax
                                .params());
                        }
                    }
                ]

            });

    $('#statuses').on('change', function() {
        // Reload DataTable with updated parameters
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
        
    document.addEventListener("DOMContentLoaded", function () {
        var companyTypeSelect = document.getElementById('company_type');
        var companiesSelect = document.getElementById('companies');

        companyTypeSelect.addEventListener('change', function () {
            var selectedTypeId = this.value;

            // Reset options
            companiesSelect.innerHTML = '<option value="">Select Company</option>';

            // Filter and populate options based on selected type
            var companies = @json($company);
            companies.forEach(function (company) {
                if (company.company_type_id == selectedTypeId) {
                    var option = document.createElement('option');
                    option.value = company.id;
                    option.textContent = company.company_name;
                    companiesSelect.appendChild(option);
                }
            });
        });
    });

    </script>
    
@endsection
