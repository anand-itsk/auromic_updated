@extends('layouts.app')
@section('title', 'Create Company Bank')
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
                                <li class="breadcrumb-item">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Bank</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('profile.bank_details.bank.update', $companyBankDetail->id) }}" method="POST">
                                    @csrf
                                    <!-- <h5 class="text-primary">Company Info</h5> -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label mandatory">Companies</label>
                                        <div class="col-sm-4 mb-4">
                                             <select class="form-control select2" name="company_id" id="company_id" required>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}" {{ $companyBankDetail->company_id == $company->id ? 'selected' : '' }}>
                                                {{ $company->company_name }} - {{ optional($company->authorisedPerson)->name ?? 'No Authorised Person' }}
                                            </option>
                                        @endforeach
                                    </select>
                                            @error('company_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="bank_name" class="col-sm-2 col-form-label mandatory">Bank Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="bank_name" id="bank_name" value="{{ $companyBankDetail->bankDetail->bank_name }}" required>
                                            @error('bank_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="account_number" class="col-sm-2 col-form-label mandatory">Bank A/C
                                            No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="account_number"
                                                id="account_number"value="{{ $companyBankDetail->bankDetail->account_number }}"  required>
                                                 <span class="error" style="color: red;"></span>
                                            @error('account_number')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="address" id="address" cols="10" rows="3">{{$companyBankDetail->bankDetail->address}}</textarea>

                                            @error('address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="branch_code" class="col-sm-2 col-form-label">Branch
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="branch_code" id="branch_code" value="{{ $companyBankDetail->bankDetail->branch_code }}">
                                            @error('branch_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="branch_name" class="col-sm-2 col-form-label">Branch
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="branch_name" id="branch_name" value="{{ $companyBankDetail->bankDetail->branch_name }}">
                                            @error('branch_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="ifsc_code" class="col-sm-2 col-form-label">IFSC
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="ifsc_code" id="branch_code" value="{{ $companyBankDetail->bankDetail->ifsc_code }}">
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
   <!-- <script>
   $(document).ready(function() {
    $('#ifscForm').submit(function(event) {
        event.preventDefault();
        
        var bankName = $('#bank_name').val();
        var branchName = $('#branch_name').val();
        
        // Clear previous errors
        $('#bankNameError').text('');
        $('#branchNameError').text('');
        
        // AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ route('profile.bank_details.get-ifsc-code') }}', // Assuming your route name is 'get_ifsc'
            data: {
                _token: '{{ csrf_token() }}',
                bank_name: bankName,
                branch_name: branchName
            },
            success: function(response) {
                // Check if 'ifsc_code' is defined in the response
                if (response.hasOwnProperty('ifsc_code') && response.ifsc_code !== null) {
                    // Display IFSC code
                    $('#ifscResult').html('<p>IFSC Code: ' + response.ifsc_code + '</p>');
                } else {
                    // Display error message if 'ifsc_code' is not present or null
                    $('#ifscResult').html('<p>Error: Unable to retrieve IFSC code.</p>');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle errors
                if (xhr.status == 422) {
                    // Validation error
                    var errors = xhr.responseJSON.errors;
                    if (errors.hasOwnProperty('bank_name')) {
                        $('#bankNameError').text(errors.bank_name[0]);
                    }
                    if (errors.hasOwnProperty('branch_name')) {
                        $('#branchNameError').text(errors.branch_name[0]);
                    }
                } else {
                    // Other errors
                    $('#ifscResult').text('Error: ' + xhr.responseText);
                }
            }
        });
    });
});
</script>    -->


 @include('links.js.select2.select2')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#account_number').on('blur', function() {
        var accountNumber = $(this).val();

        if (accountNumber) {
            $.ajax({
                url: "{{ route('profile.bank_details.check.bank.account') }}",
                type: 'GET',
                data: { account_number: accountNumber },
                success: function(response) {
                    if (response.exists) {
                        $('#account_number').next('.error').text('The bank account number already exists.');
                        $('#account_number').focus(); // Focus on the input field if account number exists
                    } else {
                        $('#account_number').next('.error').text(''); // Clear the error message if account number does not exist
                    }
                }
            });
        }
    });
});
</script>

@endsection
