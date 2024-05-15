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
                                <li class="breadcrumb-item"><a href="{{ route('profile.masters.index') }}">Master Company</a>
                                </li>
                                <li class="breadcrumb-item">Create</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Create Master Company</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{ route('profile.masters.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="text-primary">Company Info</h5>
                                        <button class="btn btn-secondary cancel_btn">
                                            <a href="{{ route('profile.masters.index') }}" class="text-white">
                                                Cancel
                                            </a>
                                        </button>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company_code" class="col-sm-2 col-form-label mandatory">Company
                                            Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="company_code"
                                                id="company_code" required>
                                            @error('company_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="company_name" class="col-sm-2 col-form-label mandatory">Company
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="company_name"
                                                id="company_name" required>
                                            @error('company_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Office Addresses --}}
                                    <div class="form-group row">
                                        <label for="office_address" class="col-sm-2 col-form-label">Office Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="office_address" id="office_address" cols="10" rows="3"></textarea>

                                            @error('office_address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="office_country_id"
                                                id="office_country_id">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('office_country_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">State</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2 w-100" name="office_state_id"
                                                id="office_state_id" disabled>
                                            </select>
                                            @error('office_state_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="office_pincode" class="col-sm-2 col-form-label">Pincode</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="office_pincode"
                                                id="office_pincode">
                                            @error('office_pincode')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="phone_no" class="col-sm-2 col-form-label">Phone No</label>
                                        <div class="col-sm-1 mb-4">
                                            <input class="form-control" type="std_code" name="std_code" id="std_code">
                                            @error('std_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 mb-4">
                                            <input class="form-control" type="text" name="phone" id="phone">
                                            @error('phone')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="starting_date" class="col-sm-2 col-form-label">Starting Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="starting_date"
                                                id="starting_date">
                                            @error('starting_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="business_nature" class="col-sm-2 col-form-label">Business
                                            Nature</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="business_nature" id="business_nature"
                                                onchange="showTextBox()">
                                                <option value="">Select</option>
                                                <option value="Manufacture">Manufacture</option>
                                                <option value="Job Work">Job Work</option>
                                                <option value="Traders">Traders</option>
                                                <option value="Others">Others</option>
                                            </select>

                                            @error('business_nature')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="col-sm-4 mb-4">
                                            <input type="text" name="others_buniess_nature" class="form-control"
                                                id="otherText" style="display:none;" placeholder="Please specify">
                                        </div> --}}


                                        <label for="email" class="col-sm-2 col-form-label">Email Id</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="email" name="company_email"
                                                id="email">
                                            @error('company_email')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="website" class="col-sm-2 col-form-label">Website</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="website" id="website">
                                            @error('website')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- </div> --}}











                                        {{-- Company Registration Details --}}
                                        {{-- <div class="form-group row"> --}}


                                        <label for="pf_code" class="col-sm-2 col-form-label">PF Code</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="pf_code" id="pf_code">
                                            @error('pf_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="pf_date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="pf_date" id="pf_date">
                                            @error('pf_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="esi_code" class="col-sm-2 col-form-label">ESI Code </label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="esi_code" id="esi_code">
                                            @error('esi_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="esi_date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="esi_date" id="esi_date">
                                            @error('esi_date')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="factory_act_no" class="col-sm-2 col-form-label">Factory Act No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="factory_act_no"
                                                id="factory_act_no">
                                            @error('factory_act_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="tin_no" class="col-sm-2 col-form-label">TIN No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="tin_no" id="tin_no">
                                            @error('tin_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="gst_no" class="col-sm-2 col-form-label">GST No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="gst_no" id="gst_no">
                                            @error('gst_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="ssi_no" class="col-sm-2 col-form-label">SSI No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="ssi_no" id="ssi_no">
                                            @error('ssi_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="pan_no" class="col-sm-2 col-form-label">PAN No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="pan_no" id="pan_no">
                                            @error('pan_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="tan_no" class="col-sm-2 col-form-label">TAN No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="tan_no" id="tan_no">
                                            @error('tan_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="license_no" class="col-sm-2 col-form-label">License No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="license_no"
                                                id="license_no">
                                            @error('license_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr />
                                    {{-- Authorised Person Info --}}
                                    <h5 class="text-primary">Authorised Person Info</h5>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label mandatory">Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="name" id="name" required>
                                            @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="faorhus_name" class="col-sm-2 col-form-label">Father's/Husband
                                            Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="faorhus_name"
                                                id="faorhus_name">
                                            @error('faorhus_name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="faorhus_name" class="col-sm-2 col-form-label">Profile Image</label>
                                        <div class="col-sm-4 mb-4">
                                            <input type="file" name="photo" id="imageUpload">
                                            @error('photo')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <img id="imagePreview" src="#" alt="Image Preview"
                                                style="display: none; width: 50px; height: 50px;">
                                        </div>


                                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="">Select</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>

                                            @error('gender')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Addresses --}}
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="address" id="address" cols="10" rows="3"></textarea>

                                            @error('address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="country_id" id="country_id">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">State</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2 w-100" name="state_id" id="state_id"
                                                disabled>
                                            </select>
                                            @error('state_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="pincode" class="col-sm-2 col-form-label">Pincode</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="pincode" id="pincode">
                                            @error('pincode')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="phone_no" class="col-sm-2 col-form-label">Phone No</label>
                                        <div class="col-sm-1 mb-4">
                                            <input class="form-control" type="std_code" name="std_code" id="std_code">
                                            @error('std_code')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 mb-4">
                                            <input class="form-control" type="text" name="phone" id="phone">
                                            @error('phone')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- </div> --}}

                                        {{-- Other Details --}}
                                        {{-- <div class="form-group row"> --}}
                                        <label for="blood_group" class="col-sm-2 col-form-label">Blood Group</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="blood_group" id="blood_group">
                                                <option value="">Select</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                            </select>

                                            @error('blood_group')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="dob" id="dob">
                                            @error('dob')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="email" class="col-sm-2 col-form-label mandatory">Email Id</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="email" name="person_email"
                                                id="email" required>
                                            @error('person_email')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="mobile" id="mobile">
                                            @error('mobile')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="pan_no" class="col-sm-2 col-form-label">PAN No</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="pan_no" id="pan_no">
                                            @error('pan_no')
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
                                            <a href="{{ route('profile.masters.create') }}"
                                                class="btn btn-warning waves-effect waves-light">
                                                Reset
                                            </a>
                                            <a href="{{ route('profile.masters.index') }}"
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
    <script></script>
    <script>
        document.getElementById("imageUpload").addEventListener("change", function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("imagePreview").setAttribute("src", e.target.result);
                document.getElementById("imagePreview").style.display = "block";
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    @include('links.js.select2.select2')
@endsection
