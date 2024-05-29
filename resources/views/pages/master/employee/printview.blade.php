<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Employee View</title>
      <style>
         @media print {
         /* Add styles specific for printing */
         body {
         font-size: 12pt;
         }
         }
      </style>
   </head>
   <body>
    
      <div class="row">
         <div class="col-lg-9" style="position: relative;">
            <table class="table table-borderless">
               <thead>
                  <tr>
                     <th scope="col" style="padding-right: 28px;">Employee Code</th>
                     <th scope="col"style="padding-right: 28px;">Employee Name</th>
                     <th scope="col"style="padding-right: 28px;">Company Name</th>
                     <th scope="col"style="padding-right: 28px;">Company Code</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>{{ $employee->employee_code }}</td>
                     <td>{{ $employee->employee_name }}</td>
                     <td>{{ $employee->company->company_name }}</td>
                     <td>{{ $employee->company->company_code }}</td>
                  </tr>
               </tbody>
            </table>
            <div class="profile-frame" style="position: absolute; top: 0; right: 0;">
               @if (!empty($employee->photo))
               <img src="{{ asset('/storage/' . $employee->photo) }}" alt="Profile Image" style="max-width: 50px;">
               @else
               <img src="{{ asset('assets/images/no-profile.png') }}" alt="No Profile Image" style="max-width: 50px;">
               @endif
            </div>
         </div>
         <div class="col-lg-3">
            <!-- Empty div for spacing -->
         </div>
      </div>
      <hr class="my-1">
      <h4 class="font-weight-lighter text-center text-primary"style="text-align-last: center">Personal Details
      </h4>
      <table class="table table-striped table-bordered dt-responsive nowrap"
         style="border-collapse: collapse; border-spacing: 0; width: 100%;">
         <thead style="text-align:justify">
            <tr>
               <th>
                  <h4 class="font-weight-lighter text-primary " style="padding-right: 45px; margin-bottom:5px">Permanent Address</h4>
               </th>
               <th >
                  <h4 class="font-weight-lighter text-primary " style="padding-right: 45px;margin-bottom:5px">Correspondence Address</h4>
               </th>
               <th >
                  <h4 class="font-weight-lighter text-primary" style="padding-right: 45px;margin-bottom:5px">Identity Proof</h4>
               </th>
            </tr>
         </thead>
         <tbody>
             @php
                                                            $permanentAddress = $employee->addresses
                                                                ->where('address_type_id', 3)
                                                                ->first();
                                                        @endphp
                                                         @php
                                                            $address = $employee->addresses
                                                                ->where('address_type_id', 4)
                                                                ->first();
                                                        @endphp
            <tr>
               <td><span class="font-weight-bold">Address:</span> {{ $permanentAddress->address ?? '-' }}</td>
               <td><span class="font-weight-bold">Address:</span> {{ $address->address ?? '-' }}</td>
               <td><span class="font-weight-bold">Aadhar Number:</span> {{ $employee->identityProof->aadhar_number ?? '-' }} / {{ $employee->identityProof->aadhar_name ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">City:</span> {{ $permanentAddress->village_area ?? '-' }}</td>
               <td><span class="font-weight-bold">City:</span> {{ $address->village_area ?? '-' }}</td>
               <td><span class="font-weight-bold">Voter ID No:</span> {{ $employee->identityProof->voter_id_number ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">District:</span>  {{ $permanentAddress->district->name ?? '-' }}</td>
               <td><span class="font-weight-bold">District:</span> {{ $address->district->name ?? '-' }}</td>
               <td><span class="font-weight-bold">Driving Licence No:</span> {{ $employee->identityProof->driving_license_number ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">State:</span> {{ $permanentAddress->state->name ?? '-' }}</td>
               <td><span class="font-weight-bold">State:</span>  {{ $address->state->name ?? '-' }}</td>
               <td><span class="font-weight-bold">PAN No:</span>{{ $employee->identityProof->pan_number ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Pin Code:</span>{{ $permanentAddress->pincode ?? '-' }}</td>
               <td><span class="font-weight-bold">Pin Code:</span>{{ $address->pincode ?? '-' }}</td>
               <td><span class="font-weight-bold">Passport No:</span>{{ $employee->identityProof->passport_number ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Country:</span> {{ $permanentAddress->country->name ?? '-' }}</td>
               <td><span class="font-weight-bold">Country:</span> {{ $address->country->name ?? '-' }}</td>
               <td><span class="font-weight-bold">Identity Mark:</span> {{ $employee->identityProof->identity_mark ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Phone:</span> {{ $employee->std_code ?? '' }} {{ $employee->phone ?? '-' }}</td>
               <td><span class="font-weight-bold">Mobile:</span> {{ $employee->mobile ?? '-' }}</td>
               <td></td>
            </tr>
         </tbody>
      </table>
      <!-----end--->
      <hr class="my-1" />
      <table class="table table-striped table-bordered dt-responsive nowrap"
         style="border-collapse: collapse; border-spacing: 0; width: 100%;">
         <thead>
            <tr>
               <th >
                  <h4 class="font-weight-lighter text-primary" style="text-align: justify">Other Details</h4>
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td><span class="font-weight-bold" >DOB:</span> {{ $employee->dob ? date('d/M/Y', strtotime($employee->dob)) : '-' }}</td>
               <td><span class="font-weight-bold">Gender:</span> {{ $employee->gender ?? '-' }}</td>
               <td><span class="font-weight-bold">Blood Group:</span> {{ $employee->blood_group ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Email:</span> {{ $employee->email ?? '-' }}</td>
               <td><span class="font-weight-bold">Mobile:</span> {{ $employee->mobile ?? '-' }}</td>
               <td><span class="font-weight-bold">Father's/Husband Name:</span> {{ $employee->faorhus_name ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Martial status:</span> {{ $employee->marital_status ?? '-' }}</td>
               <td><span class="font-weight-bold">Phone:</span> {{ $employee->std_code ?? '' }} -{{ $employee->phone ?? '' }}</td>
               <td><span class="font-weight-bold">Religion:</span> {{ $employee->religion->name ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">caste:</span> {{ $employee->caste->name ?? '-' }}</td>
               <td><span class="font-weight-bold">Nationality:</span> {{ $employee->nationality->name ?? '-' }}</td>
               <td><span class="font-weight-bold">Joining Date:</span> {{ $employee->joining_date ? date('d/M/Y', strtotime($employee->joining_date)) : '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Prob Period in Month:</span> {{ $employee->prob_period ?? '-' }}</td>
               <td><span class="font-weight-bold">Confirm Date:</span> {{ $employee->confirm_date ?? '-' }}</td>
               <td><span class="font-weight-bold">Resigning Date:</span> {{ $employee->resigning_date ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Resigning Reason:</span> {{ $employee->resigningReason->name ?? '-' }}</td>
            </tr>
         </tbody>
      </table>
      <hr class="my-1" />
      <h4 class="font-weight-lighter text-center text-primary" style="text-align-last: center">Finance
         Details
      </h4>
      <table class="table table-striped table-bordered dt-responsive nowrap"
         style="border-collapse: collapse; border-spacing: 0; width: 100%;">
         <thead style="text-align:justify">
            <tr>
               <th >
                  <h4 class="font-weight-lighter text-primary" style="text-align: justify;margin-bottom:5px">Banking Info</h4>
               </th>
               <th >
                  <h4 class="font-weight-lighter text-primary" style="text-align: justify;margin-bottom:5px">LIC Info</h4>
               </th>
               <th >
                  <h4 class="font-weight-lighter text-primary"style="text-align: justify;margin-bottom:5px">PF Info</h4>
               </th>
               <th >
                  <h4 class="font-weight-lighter text-primary"style="text-align: justify;margin-bottom:5px">ESI Info</h4>
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td><span class="font-weight-bold">Bank Name:</span> {{ $employee->financeDetail->bank_name ?? '-' }}</td>
               <td><span class="font-weight-bold">Policy No:</span> {{ $employee->licInfo->policy_no ?? '-' }}</td>
               <td><span class="font-weight-bold">PF Applicable:</span> {{ isset($employee->pfInfo->pf_applicable) ? ($employee->pfInfo->pf_applicable == 1 ? 'Yes' : ($employee->pfInfo->pf_applicable === 0 ? 'No' : '-')) : '-' }}</td>
               <td><span class="font-weight-bold">ESI Applicable:</span> {{ isset($employee->esiInfo->esi_applicable) ? ($employee->esiInfo->esi_applicable == 1 ? 'Yes' : ($employee->esiInfo->esi_applicable === 0 ? 'No' : '-')) : '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Acconut No:</span> {{ $employee->financeDetail->account_number ?? '-' }}</td>
               <td><span class="font-weight-bold">Policy Term:</span> {{ $employee->licInfo->policy_term ?? '-' }}</td>
               <td><span class="font-weight-bold">PF No:</span> {{ $employee->pfInfo->pf_no ?? '-' }}</td>
               <td><span class="font-weight-bold">ESI No:</span> {{ $employee->esiInfo->esi_no ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">IFSC Code:</span>  {{ $employee->financeDetail->ifsc_code ?? '-' }}</td>
               <td><span class="font-weight-bold">LIC ID:</span> {{ $employee->licInfo->lic_id ?? '-' }}</td>
               <td><span class="font-weight-bold">PF Joining Date:</span> {{ $employee->pfInfo->pf_joining_date ?? '-' }}</td>
               <td><span class="font-weight-bold">ESI Joining Date:</span> {{ $employee->esiInfo->esi_joining_date ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Name as per Bank:</span> {{ $employee->financeDetail->name_as_per_bank ?? '-' }}</td>
               <td><span class="font-weight-bold">Annual Renewable Date:</span>  {{ $employee->licInfo->annual_renewable_date ?? '-' }}</td>
               <td><span class="font-weight-bold">PF Last Date:</span> {{ $employee->pfInfo->pf_last_date ?? '-' }}</td>
               <td><span class="font-weight-bold">ESI Last Date:</span> {{ $employee->esiInfo->esi_last_date ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Address:</span> {{ $employee->financeDetail->address ?? '-' }}</td>
               <td></td>
               <td><span class="font-weight-bold">Pension Applicable:</span> {{ isset($employee->pfInfo->pension_applicable) ? ($employee->pfInfo->pension_applicable == 1 ? 'Yes' : ($employee->pfInfo->pension_applicable === 0 ? 'No' : '-')) : '-' }}</td>
               <td><span class="font-weight-bold">Local Office:</span> {{ $employee->esiInfo->localOffice->name ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Payment Mode:</span> {{ $employee->financeDetail->paymentMode->name ?? '-' }}</td>
               <td></td>
               <td><span class="font-weight-bold">Pension Joining Date:</span> {{ $employee->pfInfo->pension_joining_date ?? '-' }}</td>
               <td><span class="font-weight-bold">ESI Dispensary:</span> {{ $employee->esiInfo->esiDispensary->name ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Account Type:</span> {{ $employee->financeDetail->account_type ?? '-' }}</td>
               <td></td>
               <td><span class="font-weight-bold">UAN:</span> {{ $employee->pfInfo->uan_number ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Bank Ref.no:</span> {{ $employee->financeDetail->bank_ref_no ?? '-' }}</td>
            </tr>
            <tr>
               <td><span class="font-weight-bold">Ward/Circle/Range:</span> {{ $employee->financeDetail->range ?? '-' }}</td>
            </tr>
         </tbody>
      </table>
      <hr class="my-1" />
      {{-- Family Members --}}
      <h4 class="font-weight-lighter mt-4 text-center text-primary" style="text-align-last: center">Family Member
         Details
      </h4>
      <table class="table table-striped table-bordered dt-responsive nowrap"
         style="border-collapse: collapse; border-spacing: 0; width: 100%;">
         <thead style="text-align:justify">
            <tr>
               <th>Name</th>
               <th>Relation</th>
               <th>Date of Birth</th>
               <th>Residing</th>
               <th>Remark</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($employee->familyMembers as $familyMember)
            <tr>
               <td>{{ $familyMember->name }}</td>
               <td>{{ $familyMember->relation_with_emp }}</td>
               <td>{{ $familyMember->dob }}</td>
               <td>{{ $familyMember->is_residing ? 'Yes' : 'No' }}</td>
               <td>{{ $familyMember->remark }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
      <hr class="my-1" />
      {{-- Nominess Members --}}
      <h4 class="font-weight-lighter mt-4 text-center text-primary" style="text-align-last: center">Nominee
         Details
      </h4>
      <table class="table table-striped table-bordered dt-responsive nowrap"
         style="border-collapse: collapse; border-spacing: 0; width: 100%;">
         <thead style="text-align:justify">
            <tr>
               <th>Family Member</th>
               <th>Gratuity Sharing</th>
               <th>Marital Status</th>
               <th>Religion ID</th>
               <th>Forhus Name</th>
               <th>Guardian Name</th>
               <th>Guardian Address</th>
               <th>Guardian Relation with Emp</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($employee->nominee as $nominees)
            <tr>
               <td>{{ $nominees->familyMember->name }}</td>
               <td>{{ $nominees->gratuity_sharing }}</td>
               <td>{{ $nominees->marital_status }}</td>
               <td>{{ $nominees->religion_id }}</td>
               <td>{{ $nominees->faorhus_name }}</td>
               <td>{{ $nominees->guardian_name }}</td>
               <td>{{ $nominees->guardian_address }}</td>
               <td>{{ $nominees->guardian_relation_with_emp }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </body>
</html>