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
                                <li class="breadcrumb-item active">ESI Dispensary</li>
                            </ol>
                        </div>
                        <h4 class="page-title">ESI Dispensary</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="d-flex justify-content-between p-2 bd-highlight">
                                    <div>

                                    </div>
                                    <div>
                                        <a href="{{ route('esi_dispensaries.create') }}" class="icon-link common-color"
                                            title="Create New ESI Dispensary">
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
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               @if (!empty($esi_dispensary))
                                             @foreach ($esi_dispensary as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->code}} </td>
                                                        <td>
                                                            
                                                                <a href="{{ route('esi_dispensaries.edit', $item->id) }}" class="icon-link primary-color"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <button class="icon-button delete-color" onclick="confirmDelete({{ $item->id }})"><i class="fa fa-trash"></i></button>


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                             {{ $esi_dispensary->links('pagination::bootstrap-4')}}
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
        if (confirm("Are you sure you want to delete this ESI Dispensary?")) {
            window.location.href = "/esi_dispensary-delete/" + id;
        }
    }
</script>

@endsection
