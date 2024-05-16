@extends('layouts.app')

@section('title', 'Edit State')
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
                                    <h5>Edit State</h5>
                                </div>
                                <div class="card-body">
                                <form action="{{ route('common.states.update', $state->id) }}" method="POST">
                                    @csrf
                                 <div class="form-group row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                          <label for="firstNameinput" class="form-label">Country</label>
                                           <select class="form-control" name="country_id">
                                                <option value="">Select Country</option>
                                                @foreach ($country as $key => $value)
                                             <option value="{{ $value->id }}"
                                             @selected($state->country_id == $value->id)>{{ $value->name }}
                                             </option>
                                             @endforeach
                                            </select>
                                            @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
</div>
                                         <div class="col-md-12">
                                                        <div class="mb-3">
                                          <label for="firstNameinput" class="form-label">Name</label>
                                            <input class="form-control" type="text" name="name" id="name" value="{{ $state->name }}">
                                            @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
</div>
                                     <div class="col-md-12">
                                                        <div class="mb-3">
                                          <label for="firstNameinput" class="form-label">Code</label>
                                        
                                            <input class="form-control" type="text" name="code" id="code" value="{{ $state->code}}">
                                            @error('code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                   

                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Update
                                            </button>
                                
                                            <a href="{{ route('common.countries') }}"
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
