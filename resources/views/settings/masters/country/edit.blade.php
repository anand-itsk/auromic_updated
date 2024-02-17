@extends('layouts.app')

@section('content')
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
                                    <h5>Edit Country</h5>
                                </div>
                                <div class="card-body">
                                    <div class="m-b-30">
                                        <form action="{{ route('common.country.update', $country->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input class="form-control" type="text" name="name"
                                                                id="name" value="{{ $country->name }}">
                                                            @error('name')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="code" class="form-label">Code</label>

                                                            <input class="form-control" type="text" name="code"
                                                                id="code" value="{{ $country->code }}">
                                                            @error('code')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">
                                                                Update
                                                            </button>

                                                            <a href="{{ route('common.countries') }}"
                                                                class="btn btn-secondary waves-effect m-l-5">
                                                                Cancel
                                                            </a>
                                                        </div>
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
            <!-- end page title end breadcrumb -->
        </div>
    </div>
@endsection
