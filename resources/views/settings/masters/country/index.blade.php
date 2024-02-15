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

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">

                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-2 bd-highlight">
                                        <div>

                                        </div>
                                        <div>
                                            <a href="{{ route('common.countries.create') }}" class="icon-link common-color"
                                                title="Create New Country">
                                                <i class="fa fa-user-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($countries))
                                                @foreach ($countries as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->code }} </td>
                                                        <td>

                                                            <a href="{{ route('common.countries.edit', $item->id) }}"
                                                                class="icon-link primary-color"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <button class="icon-button delete-color"
                                                                onclick="confirmDelete({{ $item->id }})"><i
                                                                    class="fa fa-trash"></i></button>


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="pagination">
                                        {{ $countries->links('pagination::bootstrap-4') }}
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
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this country?")) {
                window.location.href = "/country-delete/" + id;
            }
        }
    </script>

@endsection
