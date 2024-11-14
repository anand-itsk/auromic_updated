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
            <th>Action</th>
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
              
                <td>
                     <button class="icon-button" onclick="window.location.href='{{ route('profile.bank_details.bank.edit', $bank_detail->id) }}'">
    <i class="fa fa-edit"></i>
</button>


                    <button class="icon-button delete-bank" data-id="{{ $bank_detail->id }}"><i class="fa fa-trash"></i></button>
</td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).on('click', '.delete-bank', function() {
        var bankId = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr('content'); // Assuming you have CSRF token in meta tag

        if (confirm('Are you sure you want to delete this bank detail?')) {
            $.ajax({
                url: '/profile/bank_details/company-bank-detail/' + bankId,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                        location.reload(); // Refresh the page or remove the row dynamically
                    } else {
                        alert(response.error);
                    }
                }
            });
        }
    });
</script>



