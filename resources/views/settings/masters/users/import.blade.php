@extends('layouts.app')
<!-- DataTables CSS -->
@include('links.css.datatable.datatable-css')
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
                                <li class="breadcrumb-item"><a href="#">Users</a></li>
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

                            <h4 class="mt-0 header-title">Dropzone</h4>
                            <p class="text-muted m-b-30 font-14">DropzoneJS is an open source library
                                that provides drag’n’drop file uploads with image previews.
                            </p>

                            <div class="m-b-30">
                                <form action="#" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                </form>
                            </div>

                            <div class="text-center m-t-15">
                                <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
    <!-- DataTables JS -->
    @include('links.js.datatable.datatable-js')
@endsection
