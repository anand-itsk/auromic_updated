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
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Auromics</a></li>
                                <li class="breadcrumb-item active">Roles & Permission</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Roles & Permission</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="d-flex justify-content-between p-2 bd-highlight">
                                    <div>

                                    </div>
                                    <div>
                                        <a href="{{ route('user-management.permission.create') }}"
                                            class="icon-link common-color" title="Create New User">
                                            <i class="fa fa-user-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Roles</th>
                                                <th>Permissions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($all_roles))
                                                @foreach ($all_roles as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            @foreach ($item->permissions as $permission)
                                                                {{ $permission->name }},
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{-- @can('Role Edit') --}}
                                                            <a href="{{ route('user-management.permission.edit', $item->id) }}"
                                                                class="icon-link primary-color"><i
                                                                    class="fa fa-edit"></i></a>
                                                            {{-- @endcan --}}
                                                            {{--  <a href="{{route('role.delete',$item->id)}}" type="button"  data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal"><i class="fa-solid fa-trash-can"></i></a>  --}}

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')


    {{-- <script>
        var table;
        $(document).ready(function() {
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <button onclick="editUser(${row.id})" class="icon-button primary-color"><i class="fa fa-edit"></i></button>
                        <button onclick="deleteUser(${row.id})" class="icon-button delete-color"><i class="fa fa-trash"></i></button>
                        <button onclick="blockUser(${row.id})" class="icon-button common-color"><i class="fa fa-user-times"></i></button>
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
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
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
                        url: '/select-user-delete',
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
            window.location.href = '/user/edit/' + id;
        }



        function deleteUser(id) {
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/user/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        }

        function blockUser(id) {
            // Send an AJAX request to block the user
            $.ajax({
                url: '/user/block/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_blocked: true, // Assuming you have an 'is_blocked' attribute
                },
                success: function(result) {
                    table.ajax.reload(); // Reload the DataTable
                }
            });
        }
    </script> --}}
@endsection
