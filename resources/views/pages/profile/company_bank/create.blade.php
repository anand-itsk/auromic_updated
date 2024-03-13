@extends('layouts.app')
<!-- DataTables CSS -->
@section('content')
    <!-- Add Select2 CSS -->
    @include('links.css.select2.select2')

    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Auromics</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('profile.bank_details.index') }}">Company Bank
                                        Details</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Bank</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('profile.bank_details.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- <h5 class="text-primary">Company Info</h5> -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Companies</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="company_id" id="company_id">
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">
                                                        {{ $company->company_name }} -
                                                        {{ optional($company->authorisedPerson)->name ?? 'No Authorised Person' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="bank_name" class="col-sm-2 col-form-label mandatory">Bank Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="bank_name" id="bank_name">
                                            @error('bank_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="account_number" class="col-sm-2 col-form-label mandatory">Bank A/C
                                            No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="account_number"
                                                id="account_number">
                                            @error('account_number')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="address" id="address" cols="10" rows="3"></textarea>

                                            @error('address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="branch_code" class="col-sm-2 col-form-label">Branch
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="branch_code" id="branch_code">
                                            @error('branch_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="branch_name" class="col-sm-2 col-form-label">Branch
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="branch_name" id="branch_name">
                                            @error('branch_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="ifsc_code" class="col-sm-2 col-form-label">IFSC
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="ifsc_code" id="branch_code">
                                            @error('ifsc_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="form-group">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                Submit
                                            </button>
                                            <a href="{{ route('profile.bank_details.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
                                            <a href="{{ route('profile.bank_details.index') }}"
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
    <script>
        function fetchIFSCFromAPI(bankName, branchName) {
    const url = '/get-ifsc-code';

    return axios.get(url, {
        params: {
            bank_name: bankName,
            branch_name: branchName
        }
    })
    .then(response => {
        return response.data.ifsc_code;
    })
    .catch(error => {
        console.error('Error fetching IFSC:', error);
        return null;
    });
}

// Example usage
const bankName = 'State Bank of India';
const branchName = 'Main Branch';

fetchIFSCFromAPI(bankName, branchName)
    .then(ifscCode => {
        if (ifscCode) {
            console.log('IFSC Code:', ifscCode);
        } else {
            console.log('IFSC code not found.');
        }
    });
    </script>


    @include('links.js.select2.select2')
@endsection
