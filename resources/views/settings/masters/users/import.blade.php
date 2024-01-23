@extends('layouts.app')
<!-- DataTables CSS -->
{{-- @include('links.css.datatable.datatable-css') --}}
<link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">
@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Aurmics</a></li>
                                <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
                                <li class="breadcrumb-item"><a href="#">Import</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Form Uploads</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Note:</h4>
                            <p class="text-muted font-14">Supported documents (.xls, .xlsx or .csv)</p>
                            <p class="text-muted font-14">To upload sample document, it must have concern fields.
                                Click to download sample document</p>
                            <div class="m-b-30">
                                <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" required>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')
    <script src="assets/plugins/dropzone/dist/dropzone.js"></script>
@endsection
