@extends('layouts.app')
@section('title', 'Create Raw Material')
<!-- DataTables CSS -->
{{-- @include('links.css.datatable.datatable-css') --}}
@section('content')
    <link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-xl-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-2 leftsetup">
                                <h4 class="page-title">Setup</h4>
                                <input type="text" placeholder="search" class="form-control">
                                @include('settings.setup_nav')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-header pb-0 pt-0 bg-white">
                                    <h5>Create Raw Material</h5>
                                </div>
                                <div class="card-body">
                                    <div class="m-b-30">
                                        <form action="{{ route('product-models.raw_materials.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="raw_material_type_id" class="form-label">Raw
                                                                Material Type</label>
                                                            <select class="form-control" name="raw_material_type_id">
                                                                <option value="">Select Type</option>
                                                                @foreach ($raw_material_type as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('raw_material_type_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label mandatory">Name</label>
                                                            <input class="form-control" type="text" name="name"
                                                                id="name">
                                                            @error('name')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="stock" class="form-label mandatory">stock</label>

                                                            <input class="form-control" type="number" name="stock"
                                                                id="code">
                                                            @error('stock')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">
                                                                Submit
                                                            </button>

                                                            <a href="{{ route('product-models.raw_materials') }}"
                                                                class="btn btn-secondary waves-effect m-l-5">
                                                                Cancel
                                                            </a>
                                                        </div>
                                                    </div>

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
