<div class="tab-pane" role="tabpanel" id="step3">
    <h4 class="text-center">Family</h4>

    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn icon-button btn-primary" data-toggle="modal" data-target=".employe-family-add"
            title="Add Famil Member"><i class="fa fa-user-plus"></i></button>
    </div>
    <table class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Aadhar No</th>
                <th>Relation With Employee</th>
                <th>DOB</th>
                <th>Is Residing</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="familyMembersTableBody">
        </tbody>
    </table>

    <ul class="list-inline pull-right mt-0">
           
            <li>
                {{-- <a href="" id="nomini-next">Next</a> --}}
                <button class="btn icon-button btn-primary"  type="button"  id="nomini-next">Next</button>
            </li>
        </ul>

    {{-- Banking Info --}}

    {{-- Add Family Member --}}
    <div class="modal fade employe-family-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Add Family Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-12">
                            {{-- <div class="card m-b-30"> --}}
                            {{-- <div class="card-body p-0"> --}}
                            <form role="form" action="{{ route('master.employees.store.family', $employee->id) }}"
                                method="post" class="login-box">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row m-2">
                                    <h5 class="text-primary w-100">Family Member Details</h5>


                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label mandatory">Name</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control " type="text" name="name"
                                                id="name">
                                                <span id="name-error" class="error" style="color: red;"></span>
                                            @error('name')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="name" class="col-sm-2 col-form-label mandatory">Aadhar Number</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control " type="text" name="aadhar_no"
                                                id="aadhar_no" maxlength="12" oninput="validateAadhar(this)">
                                                 <span id="aadhar-error" class="error" style="color: red;"></span>
                                            @error('aadhar_no')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label for="relation_with_emp" class="col-sm-2 col-form-label">Relation
                                            with employee</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="relation_with_emp"
                                                id="relation_with_emp">
                                            @error('relation_with_emp')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4 mb-4">
                                            <textarea class="form-control" name="family_address" id="family_address" cols="10" rows="3"></textarea>

                                            @error('family_address')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="area" class="col-sm-2 col-form-label">Village/Area</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="family_area"
                                                id="family_area">

                                            @error('family_area')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2" name="family_country_id"
                                                id="family_country_id">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('family_country_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">State</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2 w-100" name="family_state_id"
                                                id="family_state_id" disabled>
                                            </select>
                                            @error('family_state_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="col-sm-2 col-form-label">District</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control select2 w-100" name="family_district_id"
                                                id="family_district_id" disabled>
                                            </select>
                                            @error('family_district_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="family_pincode" class="col-sm-2 col-form-label">Pincode</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="text" name="family_pincode"
                                                id="family_pincode">
                                            @error('family_pincode')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <label for="dob" class="col-sm-2 col-form-label">Date of
                                            Birth</label>
                                        <div class="col-sm-4 mb-4">
                                            <input class="form-control" type="date" name="dob"
                                                id="dob">
                                            @error('dob')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <label class="col-sm-2 col-form-label">Whether Residing with him or
                                            Not</label>
                                        <div class="col-sm-4 mb-4">
                                            <select class="form-control" name="is_residing" id="is_residing">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('payment_mode_id')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label for="remark" class="col-sm-2 col-form-label">Remarks</label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" name="remark" id="remark" cols="10" rows="3"></textarea>

                                            @error('remark')
                                                <span class="error" style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li><button type="button"
                                            class="default-btn next-step3 m-0 bg-primary rounded text-white"
                                            id="next-step3">Save</button>
                                    </li>
                                </ul>
                            </form>
                            {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>

$('#nomini-next').click(function(e){
            e.preventDefault();
 
            var activeTab = $('.wizard .nav-tabs li.active');

activeTab.next().removeClass('disabled');
                    nextTab(activeTab);
});

        $("#next-step3").click(function(e) {
            e.preventDefault();

            var activeTab = $('.wizard .nav-tabs li.active');
            var form = $(this).closest('form');
            var formData = new FormData(form[0]);
            var url = form.attr('action'); // Set form action attribute to the appropriate Laravel route.
            // AJAX submission to Laravel
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('.employe-family-add').modal('hide');
                    familyMemberTable(response
                        .emp_id);
                      

                },
                error: function(response) {
                    if (response.status === 422) { // Unprocessable Entity (Validation Error)
                        let errors = response.responseJSON.errors;
                        let firstInvalidInput = null;

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let inputField = form.find('[name="' + key + '"]');
                                let errorMessage = errors[key][0]; // First error message for this field

                                // Append error message and add invalid input styling
                                inputField.addClass('is-invalid').after(
                                    '<span class="error-message text-danger">' + errorMessage +
                                    '</span>');

                                // Focus the first invalid input
                                if (!firstInvalidInput) {
                                    firstInvalidInput = inputField;
                                }
                            }
                        }

                        if (firstInvalidInput) {
                            firstInvalidInput.focus();
                        }
                    } else {
                        // Handle other types of errors
                        console.log('An error occurred:', response.statusText);
                    }
                }
            });
        });

        function familyMemberTable(employeeId) {
            $.ajax({
                url: '{{ route('master.employees.family-members') }}',
                type: 'GET',
                data: {
                    employee_id: employeeId
                },
                success: function(response) {

                    var tableBody = $('#familyMembersTableBody');
                    tableBody.html('');
                    if (response.length > 0) {
                        response.forEach(function(item, index) {
                            var residing = item.is_residing ? 'Yes' : 'No';
                            var row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.aadhar_no}</td>
                        <td>${item.relation_with_emp}</td>
                        <td>${item.dob}</td>
                        <td>${residing}</td>
                        <td>${item.remark}</td>
                        <td>
                        <button class="default-btn btn-primary" onclick="editFamilyMember(${item.id})">Edit</button>
                        <button class="default-btn btn-danger" onclick="deleteFamilyMember(${item.id})">Delete</button>
                        </td>
                    </tr>`;


                            tableBody.append(row);
                        });
                    } else {
                        tableBody.html('<tr><td colspan="7" class="text-center">Data not found</td></tr>');
                    }
                },
                error: function() {
                    $('#familyMembersTableBody').html(
                        '<tr><td colspan="7" class="text-center">Error loading data</td></tr>');
                }
            });
        }

        function editFamilyMember(id) {
            $.ajax({
                url: `/master/employees/family-members/edit/${id}`,
                type: 'GET',
                success: function(data) {
                    // Populate modal fields with fetched data
                    $('#name').val(data.name);
                    $('#aadhar_no').val(data.aadhar_no);
                    $('#relation_with_emp').val(data.relation_with_emp);
                    console.log();
                    $('#family_address').html(data.addresses[0].address);
                    $('#family_area').val(data.addresses[0].village_area);
                    $('#family_country_id').val(data.addresses[0].country_id);
                    $('#family_state_id').val(data.addresses[0].state_id);
                    $('#family_pincode').val(data.addresses[0].pincode);

                    $('#dob').val(data.dob);
                    $('#is_residing').val(data.is_residing);
                    $('#remark').html(data.remark);

                    // Continue for each field...

                    // Update form action for edit
                    $('.login-box').attr('action', `/master/employees/family-members/update/${id}`);

                    // Show the modal
                    $('.employe-family-add').modal('show');
                },
                error: function(error) {
                    console.log(error);
                    alert('Could not fetch the data.');
                }
            });
        }

        function deleteFamilyMember(id, employeeId) {
            if (confirm('Are you sure you want to delete this family member?')) {
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },
                    url: `/master/employees/family-members/delete/${id}`,
                    type: 'DELETE',
                    success: function(result) {
                        alert(result.success);
                        console.log(result.emp_id);
                        // Remove the row from the table or refresh the table
                        familyMemberTable(result
                            .emp_id); // Assuming this is your function to load family members
                    },
                    error: function(error) {
                        alert('Error deleting family member');
                    }
                });
            }
        }


        // For Create
        // Fetch State
        $('#family_country_id').on('change', function() {
            var countryId = this.value;
            console.log(countryId);
            $.get(`/get-states/${countryId}`, function(states) {
                var stateSelect = $('#family_state_id');
                stateSelect.empty();
                stateSelect.append(new Option('Select State', ''));
                $.each(states, function(index, state) {
                    stateSelect.append(new Option(state.name, state.id));
                });
                stateSelect.prop('disabled', false).trigger('change');
            });
        });

        // Fetch District
        $('#family_state_id').on('change', function() {
            var stateId = this.value;
            $.get(`/get-districts/${stateId}`, function(districts) {
                var districtSelect = $('#family_district_id');
                districtSelect.empty();
                districtSelect.append(new Option('Select District', ''));
                $.each(districts, function(index, district) {
                    districtSelect.append(new Option(district.name, district.id));
                });
                districtSelect.prop('disabled', false).trigger('change');
            });
        });
    </script>
    <script>
        $(".next-step2").click(function(e) {
            e.preventDefault();

            var activeTab = $('.wizard .nav-tabs li.active');
            var form = $(this).closest('form');
            var formData = new FormData(form[0]);
            var url = form.attr('action'); // Set form action attribute to the appropriate Laravel route.
            console.log(url);
            // AJAX submission to Laravel
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // If save is successful, move to the next tab
                    activeTab.next().removeClass('disabled');
                    nextTab(activeTab);
                },
                error: function(response) {
                    if (response.status === 422) { // Unprocessable Entity (Validation Error)
                        let errors = response.responseJSON.errors;
                        let firstInvalidInput = null;

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let inputField = form.find('[name="' + key + '"]');
                                let errorMessage = errors[key][0]; // First error message for this field

                                // Append error message and add invalid input styling
                                inputField.addClass('is-invalid').after(
                                    '<span class="error-message text-danger">' + errorMessage +
                                    '</span>');

                                // Focus the first invalid input
                                if (!firstInvalidInput) {
                                    firstInvalidInput = inputField;
                                }
                            }
                        }

                        if (firstInvalidInput) {
                            firstInvalidInput.focus();
                        }
                    } else {
                        // Handle other types of errors
                        console.log('An error occurred:', response.statusText);
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#next-button-family').click(function() {
                $('.employee-nominee-add').modal('show');
            });
        });
    </script>

<script>

   document.getElementById('next-step3').addEventListener('click', function(e) {
    let valid = true;

    // Name validation
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('name-error');
    if (nameInput.value.trim() === '') {
        valid = false;
        nameError.textContent = 'Name is required';
    } else {
        nameError.textContent = '';
    }

    // Aadhar Number validation
    const aadharInput = document.getElementById('aadhar_no');
    const aadharError = document.getElementById('aadhar-error');
    if (aadharInput.value.trim() === '') {
        valid = false;
        aadharError.textContent = 'Aadhar number is required';
    } else if (aadharInput.value.length !== 12 || isNaN(aadharInput.value)) {
        valid = false;
        aadharError.textContent = 'Aadhar number must be 12 digits long';
    } else {
        aadharError.textContent = '';
    }

    // Prevent further action if the form is invalid
    if (!valid) {
        e.preventDefault(); // Stops the button from proceeding if validation fails
    } else {
        // Optionally, you could trigger a form submit here if the fields are valid
        // document.querySelector('form').submit();
        alert('Form is valid. Proceeding to save...');
    }
});

    function validateAadhar(input) {
        const aadharError = document.getElementById('aadhar-error');

        // Only allow numbers in the input
        input.value = input.value.replace(/[^0-9]/g, '');

        // If input length is less than or more than 12, show error
        if (input.value.length > 0 && input.value.length !== 12) {
            aadharError.textContent = 'Aadhar number must be exactly 12 digits.';
        } else {
            aadharError.textContent = ''; // Clear the error if the input is valid
        }
    }
</script>
</div>
