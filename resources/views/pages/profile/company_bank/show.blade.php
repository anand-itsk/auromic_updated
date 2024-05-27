<div class="card-body">
    <table class="table table-striped table-bordered dt-responsive nowrap"
           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Bank name</th>
            <th>Bank A/C No</th>
            <th>Branch Code</th>
            <th>Branch Name</th>
            <th>IFSC Code</th>
        </tr>
        </thead>
       <tbody>
    @php
        $dataFound = false;
    @endphp

    @if (!empty($bank_details))
        @foreach($bank_details as $index => $bank_detail)
            @php
                $dataFound = true;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $company->company_name }}</td> <!-- Assuming 'name' is the company name attribute -->
                <td>{{ $bank_detail->bankDetail->bank_name }}</td>
                <td>{{ $bank_detail->bankDetail->account_number }}</td>
                <td>{{ $bank_detail->bankDetail->branch_code }}</td>
                <td>{{ $bank_detail->bankDetail->branch_name }}</td>
                <td>{{ $bank_detail->bankDetail->ifsc_code }}</td>
                <!-- <td>{{ $bank_detail->bankDetail->created_at}}</td> -->
            </tr>
        @endforeach
    @endif

    @if (!$dataFound)
        <tr>
            <td colspan="7" class="text-center">Data not found</td>
        </tr>
    @endif
</tbody>


    
</div>


