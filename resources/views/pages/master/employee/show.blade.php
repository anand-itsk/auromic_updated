<div class="row text-center">
    <div class="col-md-6 ">
        <h6>Customer Code</h6>
        <p>{{ $customer->customer_code }}</p>
        <!-- More fields... -->
    </div>
    <div class="col-md-6">
        <h6>Customer Name</h6>
        <p>{{ $customer->customer_name }}</p>
        <!-- More fields... -->
    </div>
    <!-- Repeat for all fields as per the modal layout -->
</div>

<hr>

<div class="row">
    @php
        $officeAddress = $customer->addresses->where('address_type_id', 2)->first();
    @endphp
    <div class="col-md-6">
        <h6 class="font-weight-lighter">Office Address</h6>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Address</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $officeAddress->address ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Country</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $officeAddress->country->name ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">State</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $officeAddress->state->name ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Pin Code</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $officeAddress->pincode ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Phone</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->std_code ?? '' }}</span>
                <span> {{ $customer->phone ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @php
            $address = $customer->addresses->where('address_type_id', 3)->first();
        @endphp
        <h6 class="font-weight-lighter">Residential Address</h6>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Address</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $address->address ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Country</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $address->country->name ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">State</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $address->state->name ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Pin Code</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $address->pincode ?? '-' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Mobile</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->mobile ?? '-' }}</span>
            </div>
        </div>
    </div>
    <!-- Repeat for all fields as per the modal layout -->
</div>
<h6 class="font-weight-lighter">Other Details</h6>

<div class="row">

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Email</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->email ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Website</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->website ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">TIN No</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->tin_no ?? "-" }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">TIN Date</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->tin_date ?? "-" }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">CST No</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->cst_no ?? "-" }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">CST Date</span>
            </div>
            <div class="col-md-8 ">
                <span> {{ $customer->cst_date ?? "-" }}</span>
            </div>
        </div>
    </div>
</div>
