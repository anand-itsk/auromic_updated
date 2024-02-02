<div class="row text-center">
    <div class="col-md-6 ">
        <h6>Company Code</h6>
        <p>{{ $company->company_code }}</p>
        <!-- More fields... -->
    </div>
    <div class="col-md-6">
        <h6>Company Name</h6>
        <p>{{ $company->company_name }}</p>
        <!-- More fields... -->
    </div>
    <!-- Repeat for all fields as per the modal layout -->
</div>
<hr>


<h6 class="font-weight-lighter">Company Info</h6>

<div class="row">

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Address</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->addresses->first()->address ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Country</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->addresses->first()->country->name ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">State</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->addresses->first()->state->name ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Pincode</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->addresses->first()->pincode ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Phone no</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->phone ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Starting Date</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->starting_date ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Business Nature</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->business_nature ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Email Id</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->email ?? '-' }}</span>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Website</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->website ?? '-' }}</span>
            </div>
        </div>
    </div>


    <!-- new adding -->


    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">PF Code</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->pf_code ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">PF Date</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->pf_date ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">ESI Code</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->esi_code ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">ESI Date</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->esi_date ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Factory Act No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->factory_act_no ?? '-' }}</span>
            </div>
        </div>
    </div>



    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">TIN No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->tin_no ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">CST No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->cst_no ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">SSI No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->ssi_no ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">PAN No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->pan_no ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">License No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->companyRegistrationDetail->license_no ?? '-' }}</span>
            </div>
        </div>
    </div>

</div>

<hr />
<!-- Addition Info -->
<h6 class="font-weight-lighter"> Authorised Person Info</h6>

<div class="row">

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Name</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->name ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Father's/Husband Name</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->faorhus_name ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Gender</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->gender ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Address</span>
            </div>
            <div class="col-md-8 ">
                <span>
                    @php
                    $address = $company->addresses->where('address_type_id', 3)->first();
                    @endphp
                    {{ $address ? $address->address : '-' }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Country</span>
            </div>
            <div class="col-md-8 ">
                <span>
                    @php
                    $address = $company->addresses->where('address_type_id', 3)->first();
                    @endphp
                    {{ $address ? $address->country->name : '-' }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">State</span>
            </div>
            <span>
                @php
                $address = $company->addresses->where('address_type_id', 3)->first();
                @endphp
                {{ $address ? $address->state->name : '-' }}
            </span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Pincode</span>
            </div>
            <div class="col-md-8 ">
                <span>
                    @php
                    $address = $company->addresses->where('address_type_id', 3)->first();
                    @endphp
                    {{ $address ? $address->pincode : '-' }}
                </span>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Phone No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->phone ?? '-' }}</span>
            </div>
        </div>
    </div>


    <!-- new adding -->


    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Blood Group</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->blood_group ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Date of Birth</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->dob ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Email Id</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->email ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Mobile</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->mobile ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">PAN No</span>
            </div>
            <div class="col-md-8 ">
                <span>{{ $company->authorisedPerson->pan_no ?? '-' }}</span>
            </div>
        </div>
    </div>

</div>