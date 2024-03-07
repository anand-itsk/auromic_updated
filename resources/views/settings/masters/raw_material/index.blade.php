@extends('layouts.app')
<!-- DataTables CSS -->


@section('content')
    @include('links.css.datatable.datatable-css')
    @include('links.css.table.custom-css')
    <div class="wrapper">
        <div class="container-fluid">
            {{-- Status --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-xl-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-2 leftsetup">
                                <h4 class="page-title">Setup</h4>
                               
                                @include('settings.setup_nav')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30 rightsetup">
                                <div class="card-header pb-0 pt-0">
                                    <h5>Raw Material</h5>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12 rightsetup-details">
                                            <div class="d-flex justify-content-between p-2 bd-highlight">
                                                <div>
                                                    <button id="deleteButton" class="icon-button delete-color"
                                                    title="Delete Selected Record"><i
                                                        class="fa fa-user-times"></i></button>

                                                </div>
                                                <div>
                                                    <a href="{{ route('product-models.raw_materials.create') }}"
                                                        class="icon-link common-color" title="Create New Country">
                                                        <i class="fa fa-user-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <table id="users-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Raw Material Type</th>
                                                        <th>Name</th>
                                                        <th>Stock</th>
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
        ajax: '{{route('product-models.raw_materials.data')}}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'raw_material_type.name',
                name: 'raw_material_type.name',
                 render: function(data, type, row) {
                            return data ? data : '-';
                        }
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'stock',
                name: 'stock'
            },
           
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button onclick="editUser(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteUser(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                                              
                    `;
                }

            },
        ],
        order: [
            [0, 'asc']
        ],
        select: true,
        dom: 'lBfrtip',
        buttons: [
            'excel', 'print'
        ],
        pageLength: 8
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
                url: 'raw_materials/select-raw_materials-delete',
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

function editUser(id) {
    console.log("inside");
    // Redirect to the user edit page or open a modal for editing
    window.location.href = 'raw_materials/edit/' + id;
}



function deleteUser(id) {
    // Send an AJAX request to delete the user
    if (confirm('Are you sure you want to delete this Raw material?')) {
        $.ajax({
            url: 'raw_materials/delete/' + id,
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
</script>
@endsection
