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
                                    <h5>Caste</h5>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12 rightsetup-details">
                                            <div class="d-flex justify-content-between p-2 bd-highlight">
                                                <div>

                                                </div>
                                                <div>
                                                    <a href="{{ route('common.castes.create') }}"
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
                                                        <th>Name</th>
                                                        <th>Code</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($caste))
                                             @foreach ($caste as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->code}} </td>
                                                        <td>
                                                            
                                                                <a href="{{ route('common.castes.edit', $item->id) }}" class="icon-link primary-color"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <button class="icon-button delete-color" onclick="confirmDelete({{ $item->id }})"><i class="fa fa-trash"></i></button>


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                                </tbody>
                                            </table>

                                            <div class="pagination">
                                                {{   $caste->links('pagination::bootstrap-4') }}
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
    </div>
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')


    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this caste?")) {
                 window.location.href = "/common/caste-delete/" + id;
            }
        }
    </script>
@endsection