@extends('layouts.app')
<!-- DataTables CSS -->
{{-- @include('links.css.datatable.datatable-css') --}}
@section('content')
    <link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Aurmics</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('states') }}">State</a></li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create State</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

           <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('states.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">   
                                       <div class="mb-3">
                                          <label for="firstNameinput" class="form-label">Country</label>
                                           <select class="form-control" name="country_id">
                                                <option value="">Select Country</option>
                                                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
</div>
                                        <div class="col-md-6">   
                                       <div class="mb-3">
                                          <label for="firstNameinput" class="form-label">Name</label>
                                            <input class="form-control" type="text" name="name" id="name">
                                            @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
</div>
                                     <div class="col-md-6">   
                                       <div class="mb-3">
                                          <label for="firstNameinput" class="form-label">Code</label>
                                        
                                            <input class="form-control" type="text" name="code" id="code">
                                            @error('code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                   

                                    <div class="form-group">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                
                                            <a href="{{ route('states') }}"
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
